<?php

namespace App\Http\Controllers\Api\V1\Common;

use App\Models\Master\CarMake;
use App\Models\Master\CarModel;
use App\Http\Controllers\Api\V1\BaseController;
use Carbon\Carbon;
use Sk\Geohash\Geohash;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;

/**
 * @group Vehicle Management
 *
 * APIs for vehilce management apis. i.e types,car makes,models apis
 */
class CarMakeAndModelController extends BaseController
{
    protected $car_make;
    protected $car_model;

    public function __construct(CarMake $car_make, CarModel $car_model,Database $database)
    {
        $this->car_make = $car_make;
        $this->car_model = $car_model;
        $this->database = $database;

    }

    /**
    * Get All Car makes
    *
    */
    public function getCarMakes()
    { 
         $transport_type = request()->transport_type;

        // return $this->respondSuccess($this->car_make->active()->where('transport_type',$transport_type)->where('vehicle_make_for',request()->vehicle_type)->orderBy('name')->get());
        if(request()->has('transport_type')){

        return $this->respondSuccess($this->car_make->active()->where('transport_type',$transport_type)->where('vehicle_make_for',request()->vehicle_type)->orderBy('name')->get());

        }else{
            return $this->respondSuccess($this->car_make->active()->orderBy('name')->get());
        }
    }

   

    /**
    * Get Car models by make id
    * @urlParam make_id  required integer, make_id provided by user
    */
    public function getCarModels($make_id)
    {
        return $this->respondSuccess($this->car_model->where('make_id', $make_id)->active()->orderBy('name')->get());
    }

    public function getAppModule()
    {

        $enable_owner_login =  get_settings('shoW_owner_module_feature_on_mobile_app');

        $enable_email_otp =  get_settings('shoW_email_otp_feature_on_mobile_app');


        return response()->json(['success'=>true,"message"=>'success','enable_owner_login'=>$enable_owner_login,'enable_email_otp'=>$enable_email_otp]);

    }
    /**
     * Test Api
     * 
     * */
    public function testApi(Request $request){

        $pick_lat =11.0589937;
        $pick_lng =76.9939081;

        $drop_lat=10.9147655;
        $drop_lng=76.9308607;

        $type_id="d44802f3-5123-4c4b-b3f4-aea6d42a898a";


        return $this->fetchDriversFromFirebase($pick_lat,$pick_lng,$drop_lat,$drop_lng,$type_id);
        
    }
}
