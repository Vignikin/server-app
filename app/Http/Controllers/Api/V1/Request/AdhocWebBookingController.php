<?php

namespace App\Http\Controllers\Api\V1\Request;

use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use App\Jobs\NotifyViaMqtt;
use App\Models\Admin\Driver;
use App\Jobs\NotifyViaSocket;
use App\Models\Admin\ZoneType;
use App\Models\Request\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Request\RequestMeta;
use Illuminate\Support\Facades\Log;
use App\Base\Constants\Masters\PushEnums;
use App\Http\Controllers\Api\V1\BaseController;
use App\Http\Requests\Request\CreateTripRequest;
use App\Jobs\Notifications\AndroidPushNotification;
use App\Transformers\Requests\TripRequestTransformer;
use App\Jobs\Notifications\FcmPushNotification;
use App\Base\Constants\Setting\Settings;
use Sk\Geohash\Geohash;
use Kreait\Firebase\Contract\Database;
use App\Jobs\Notifications\SendPushNotification;
use Illuminate\Http\Request as ValidatorRequest;
use App\Helpers\Rides\FetchDriversFromFirebaseHelpers;
use App\Transformers\User\EtaTransformer;
use App\Models\User;
use App\Models\Country;
use App\Transformers\Requests\PackagesTransformer;
use App\Models\Master\PackageType;


/**
 * @group User-trips-apis
 *
 * APIs for User-trips apis
 */
class AdhocWebBookingController extends BaseController
{
    use FetchDriversFromFirebaseHelpers;

    protected $request;

    public function __construct(Request $request,Database $database)
    {
        $this->request = $request;
        $this->database = $database;
    }


    /**
     * ETA for web booking
     * @bodyParam pick_lat double required pikup lat of the user
     * @bodyParam pick_lng double required pikup lng of the user
     * @bodyParam drop_lat double required drop lat of the user
     * @bodyParam drop_lng double required drop lng of the user
     * @bodyParam transport_type required transport type of ride
     * @bodyParam promo_code string optional promo code that the user provided 
     * 
     * */
    public function Eta(ValidatorRequest $request){

        // Validate Request id
        $request->validate([
            'pick_lat'  => 'required',
            'pick_lng'  => 'required',
            'drop_lat'  =>'sometimes|required',
            'drop_lng'  =>'sometimes|required',
        ]);

        $zone_detail = find_zone($request->input('pick_lat'), $request->input('pick_lng'));
        if (!$zone_detail) {
            $this->throwCustomException('service not available with this location');
        }

        if($request->has('transport_type')){      

                $type = $zone_detail->zoneType()->where(function($query)use($request){
                    $query->where('transport_type',$request->transport_type)->orWhere('transport_type','both');
                })->active()->get();


        }else{

                $type = $zone_detail->zoneType()->active()->get();

        }

        
        if ($request->has('vehicle_type')) {

            if($request->has('transport_type')){      

                $type = $zone_detail->zoneType()->where(function($query)use($request){
                    $query->where('transport_type',$request->transport_type)->orWhere('transport_type','both');
                })->where('id', $request->input('vehicle_type'))->active()->get();


        }else{

                $type = $zone_detail->zoneType()->where('id', $request->input('vehicle_type'))->active()->get();

        }

        }

        $result = fractal($type, new EtaTransformer);

        return $this->respondSuccess($result);

    }

    /**
    * Create Request
    * @bodyParam country_code country code required country code of the user
    * @bodyParam mobile integer required mobile of the user
    * @bodyParam pick_lat double required pikup lat of the user
    * @bodyParam pick_lng double required pikup lng of the user
    * @bodyParam drop_lat double required drop lat of the user
    * @bodyParam drop_lng double required drop lng of the user
    * @bodyParam vehicle_type string required id of zone_type_id
    * @bodyParam payment_opt tinyInteger required type of ride whther cash or card, wallet('0 => card,1 => cash,2 => wallet)
    * @bodyParam pick_address string required pickup address of the trip request
    * @bodyParam drop_address string required drop address of the trip request
    * @bodyParam is_later tinyInteger sometimes it represent the schedule rides param must be 1.
    * @bodyParam trip_start_time timestamp sometimes it represent the schedule rides param must be datetime format:Y-m-d H:i:s.
    * @bodyParam promocode_id uuid optional id of promo table
    * @bodyParam rental_pack_id integer optional id of package type
    * @responseFile responses/requests/create-request.json
    *
    */
    public function createRequest(CreateTripRequest $request)
    {

        $zone_type_detail = ZoneType::where('id', $request->vehicle_type)->first();
        $type_id = $zone_type_detail->type_id;
         // Get currency code of Request
        $service_location = $zone_type_detail->zone->serviceLocation;
        $currency_code = $service_location->currency_code;
        $currency_symbol = $service_location->currency_symbol;

        // $currency_code = get_settings('currency_code');
        //Find the zone using the pickup coordinates & get the nearest drivers


        // fetch unit from zone
        $unit = $zone_type_detail->zone->unit;

        $user_detail = User::belongsTorole('user')->where('mobile', $mobile)->first();

        $country_id =  Country::where('dial_code', $request->input('country_code'))->pluck('id')->first();

        if(!$user_detail){

            $user_detail = User::create([
                'country'=>$country_id,
                'refferal_code'=>str_random(6),
                'mobile' => $mobile,
                'timezone'=>$service_location->timezone
            ]);
        }

        $user_detail->timezone = $service_location->timezone;
        $user_detail->save();

        // Get last request's request_number
        $request_number = $this->request->orderBy('created_at', 'DESC')->pluck('request_number')->first();
        if ($request_number) {
            $request_number = explode('_', $request_number);
            $request_number = $request_number[1]?:000000;
        } else {
            $request_number = 000000;
        }
        // Generate request number
        $request_number = 'REQ_'.sprintf("%06d", $request_number+1);

        $request_params = [
            'request_number'=>$request_number,
            'user_id'=>$user_detail->id,
            'zone_type_id'=>$request->vehicle_type,
            'unit'=>(string)$unit,
            'promo_id'=>$request->promocode_id,
            'requested_currency_code'=>$currency_code,
            'requested_currency_symbol'=>$currency_symbol,
            'service_location_id'=>$service_location->id,
            'ride_otp'=>rand(1111, 9999),
            'payment_opt'=>'1',
            'goods_type_id'=>$request->goods_type_id,
            'goods_type_quantity'=>$request->goods_type_quantity,
            'transport_type'=>$request->transport_type
        ];

        if($request->has('is_bid_ride') && $request->input('is_bid_ride')==1){

            $request_params['is_bid_ride']=1;
            $request_params['offerred_ride_fare']=$request->offerred_ride_fare;
        }

        if($request->input('is_later')&&$request->has('trip_start_time')){

            $request_params['trip_start_time'] = Carbon::parse($request->trip_start_time, $timezone)->setTimezone('UTC')->toDateTimeString();
    
        }
        if($request->has('rental_package_id') && $request->rental_package_id){

            $request_params['is_rental'] = true;
            
            $request_params['rental_package_id'] = $request->rental_package_id;
        }

        if($request->has('request_eta_amount') && $request->request_eta_amount){

           $request_params['request_eta_amount'] = $request->request_eta_amount;

        }

        $request_detail = $this->request->create($request_params);

        // To Store Request stops along with poc details
        if ($request->has('stops')) {

            // Log::info($request->stops);

            foreach (json_decode($request->stops) as $key => $stop) {
                $request_detail->requestStops()->create([
                'address'=>$stop->address,
                'latitude'=>$stop->latitude,
                'longitude'=>$stop->longitude,
                'order'=>$stop->order]);

            }
        }

        // request place detail params
        $request_place_params = [
            'pick_lat'=>$request->pick_lat,
            'pick_lng'=>$request->pick_lng,
            'drop_lat'=>$request->drop_lat,
            'drop_lng'=>$request->drop_lng,
            'pick_address'=>$request->pick_address,
            'drop_address'=>$request->drop_address,
            'drop_poc_instruction'=>$request->drop_poc_instruction,
            'drop_poc_name'=>$request->drop_poc_name,
            'drop_poc_mobile'=>$request->drop_poc_mobile];
        // store request place details
        $request_detail->requestPlace()->create($request_place_params);

        // Add Request detail to firebase database
         $this->database->getReference('requests/'.$request_detail->id)->update(['request_id'=>$request_detail->id,'request_number'=>$request_detail->request_number,'service_location_id'=>$service_location->id,'user_id'=>$request_detail->user_id,'pick_address'=>$request->pick_address,'active'=>1,'date'=>$request_detail->converted_created_at,'updated_at'=> Database::SERVER_TIMESTAMP]);

         if($request->is_later){

            goto no_drivers_available;
         }
        $request_result =  fractal($request_detail, new TripRequestTransformer)->parseIncludes('userDetail');


        if ($request->has('is_bid_ride') && $request->input('is_bid_ride')==1) {
                goto no_drivers_available;
        }

        $nearest_drivers =  $this->fetchDriversFromFirebase($request_detail);

        // Send Request to the nearest Drivers
         if ($nearest_drivers==null) {
                goto no_drivers_available;
        }

        no_drivers_available:

         return $this->respondSuccess($request_result, 'created_request_successfully');


    }


    /**
    * List Packages
    * @bodyParam pick_lat double required pikup lat of the user
    * @bodyParam pick_lng double required pikup lng of the user
    *
    */
    public function listPackages(Request $request){

        $request->validate([
            'pick_lat'  => 'required',
            'pick_lng'  => 'required',
        ]);

        
        $type = PackageType::where('transport_type',$request->transport_type)->orWhere('transport_type', 'both')->active()->get();

        $result = fractal($type, new PackagesTransformer);

        return $this->respondSuccess($result);         

    }
}
