<?php

namespace App\Helpers\Rides;

use Kreait\Firebase\Contract\Database;
use Sk\Geohash\Geohash;
use Carbon\Carbon;
use App\Models\Request\RequestMeta;
use Illuminate\Support\Facades\DB;
use App\Models\Request\Request;
use Illuminate\Support\Facades\Log;
use App\Base\Constants\Setting\Settings;
use App\Models\Admin\Driver;

trait CreateMetaAndSendRideRequestHelpers
{


    public function __construct(Database $database)
    {
        
        $this->database = $database;

    }

    /**
     * Respond with drivers data.
     * Status code = 200
     *
     * @param mixed|null $data
     * @param string|null $message
     * @return \Illuminate\Http\JsonResponse
     */
    //
    protected function createMetaAndSendRideRequest($request_detail,$nearest_drivers,$user_detail)
    {

         $selected_drivers = [];
        $i = 0;
        foreach ($nearest_drivers as $driver) {
            
            $selected_drivers[$i]["user_id"] = $user_detail->id;
            $selected_drivers[$i]["driver_id"] = $driver->id;
            $selected_drivers[$i]["active"] = 0;
            $selected_drivers[$i]["assign_method"] = 1;
            $selected_drivers[$i]["created_at"] = date('Y-m-d H:i:s');
            $selected_drivers[$i]["updated_at"] = date('Y-m-d H:i:s');

        if(get_settings('trip_dispatch_type')==0){
            $selected_drivers[$i]["active"] = 1;
           
        // Add Driver into Firebase Request Meta
        $this->database->getReference('request-meta/'.$request_detail->id)->set(['driver_id'=>$driver->id,'request_id'=>$request_detail->id,'user_id'=>$request_detail->user_id,'active'=>1,'updated_at'=> Database::SERVER_TIMESTAMP]);

        
        $driver = Driver::find($driver->id);

        $notifable_driver = $driver->user;

        $title = trans('push_notifications.new_request_title',[],$notifable_driver->lang);
        $body = trans('push_notifications.new_request_body',[],$notifable_driver->lang);

        dispatch(new SendPushNotification($notifable_driver,$title,$body));


        }

            $i++;
        }

        if(get_settings('trip_dispatch_type')==0){

            goto create_meta_request;
        }

        usort($selected_drivers, function($a, $b) {
        
        return $a['distance_to_pickup'] <=> $b['distance_to_pickup'];
    
        });

        // Send notification to the very first driver
        $first_meta_driver = $selected_drivers[0]['driver_id'];
        $selected_drivers[0]["active"] = 1;

        // Add first Driver into Firebase Request Meta
        $this->database->getReference('request-meta/'.$request_detail->id)->set(['driver_id'=>$first_meta_driver,'request_id'=>$request_detail->id,'user_id'=>$request_detail->user_id,'active'=>1,'updated_at'=> Database::SERVER_TIMESTAMP]);

        $pus_request_detail = $request_result->toJson();
        $push_data = ['notification_enum'=>PushEnums::REQUEST_CREATED,'result'=>$pus_request_detail];
        $title = trans('push_notifications.new_request_title');
        $body = trans('push_notifications.new_request_body');

        $socket_data = new \stdClass();
        $socket_data->success = true;
        $socket_data->success_message  = PushEnums::REQUEST_CREATED;
        $socket_data->result = $request_result;

        $driver = Driver::find($first_meta_driver);

        $notifable_driver = $driver->user;

        dispatch(new SendPushNotification($notifable_driver,$title,$body));

        $device_token = $notifable_driver->fcm_token;
        
        create_meta_request:
        
        foreach ($selected_drivers as $key => $selected_driver) {
            $request_detail->requestMeta()->create($selected_driver);
        }
       
    }

 
    
}
