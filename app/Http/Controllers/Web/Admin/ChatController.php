<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Base\Filters\Master\CommonMasterFilter;
use App\Base\Libraries\QueryFilter\QueryFilterContract;
use Illuminate\Support\Facades\Validator; 
use DB;
use App\Models\Chat; 
use App\Models\ChatMessage; 
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class ChatController extends Controller
{
      //
      public function index()
      {    
            $page = trans('pages_names.chat'); 
            $main_menu = 'chat_module';
            $sub_menu = 'chat';    
            $user = Auth::user();  
            $latestMessages = ChatMessage::select(DB::raw('MAX(created_at) as latest_message_date'))->groupBy('chat_id');  
           
            $user_details = Chat::with('user_detail')->join('chat_messages', function ($join) use ($latestMessages) {
               $join->on('chat.id', '=', 'chat_messages.chat_id')
                    ->whereIn('chat_messages.created_at', $latestMessages);
           }) 
           ->select('chat.*', 'chat_messages.message','chat_messages.created_at as created_date',DB::raw('(SELECT COUNT(*) FROM chat_messages WHERE chat.id = chat_messages.chat_id and chat_messages.unseen_count = 0) as count'))
           ->orderBy('chat_messages.created_at', 'desc')
           ->get();    
         return view('admin.master.chat',compact('main_menu','sub_menu','page','user_details'));
      }  
    public function send_message(Request $request)
    {  
        $validate_array = [
         'chat_id' => 'required',
         'from_id' => 'required',
         'to_id' => 'required',
        ];
       
        $image_status = 0;
        if($request->file('files'))
        {
         $validate_array['files.*'] = 'required|file|mimes:jpg,png,pdf|max:2048';
            $image_status = 1; 
        }
       
        
        $validator = Validator::make($request->all(),$validate_array );
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect('chat')->with('warning', $errors->all()); 
        }   
        $images = array();
        if($request->file('files'))
        {  
         foreach($request->file('files')  as $file)
         {
         $file_path = "uploads/chat/images/1";

            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs($file_path, $fileName); 
            $fileUrl = Storage::url($filePath);
            $images[] = $fileUrl;
         }
         } 
        $image_data = $images;  
        $chat_messages = new ChatMessage();
        $chat_messages->chat_id = $request->chat_id;
        $chat_messages->from_id = $request->from_id;
        $chat_messages->to_id = $request->to_id;
        $chat_messages->message = $request->data_text;
        $chat_messages->unseen_count = 0;
        $chat_messages->image_status = $image_status;
        $chat_messages->image_url = json_encode($image_data); 
        $chat_messages->save();    
        $response_array = array("status"=>"success","data"=>$chat_messages);
       
       return response()->json($response_array);
    } 
    public function get_chat_messages(Request $request){
      $get_messages = ChatMessage::where('chat_id',$request->chat_id)->get();
      $user = Auth::user(); 
      $get_chat_details =Chat::select('chat.*')->where('id',$request->chat_id)->first();  
      $user_data = User::where('id','=',$get_chat_details->user_id)->first(); 
      return view('admin.master.chat_messages',compact('get_messages','user_data','get_chat_details'));

    }
    public function get_notication_count(Request $request)
    {
      if($request->message_id)
      {  
         $chat_messages = ChatMessage::find($request->message_id);
         $chat_data = Chat::find($chat_messages->chat_id); 
         $user = Auth::user(); 
         if($chat_messages->chat_id == $request->active_chat)
         {    
            ChatMessage::where('chat_id',$chat_messages->chat_id)->where('to_id',$chat_messages->to_id)->update(['unseen_count'=>1]);
         }    
         $latestMessages = DB::table('chat_messages')->select(DB::raw('MAX(created_at) as latest_message_date'))->groupBy('chat_id');
         $user_details = Chat::with('user_detail') 
                        ->join('chat_messages', function ($join) use ($latestMessages) {
                                                                  $join->on('chat.id', '=', 'chat_messages.chat_id')
                                                                     ->whereIn('chat_messages.created_at', $latestMessages);
                                                            }) 
                        ->select('chat.*', 'chat_messages.message','chat_messages.created_at as created_date',DB::raw('(SELECT COUNT(*) FROM chat_messages WHERE chat.id = chat_messages.chat_id and chat_messages.unseen_count = 0) as count'))  
                        ->orderBy('chat_messages.created_at', 'desc') 
                        ->get(); 
        if(count($user_details) > 0)
        {
         $user_data = User::where('id','=',$chat_data->user_id)->first();
         $html_data = "";
            foreach($user_details as $k=>$v)
            {
            $startDate = strtotime($v->created_date); 
            $current_date = time(); 
            $secs = $current_date - $startDate; 
            $days = $secs / 86400; 
            $minutes = $secs/60;  
            $hours = $secs / 3600;  
            if($days >= 1)
            {
                $time = intval($days)." days ago";
                if(intval(days) <= 1)
                {
                    $time = intval($days)." day ago";
                } 
            }
            else{
              if($hours >= 1){
                $time = intval($hours)." hours ago";
                if(intval($hours) <= 1)
                {
                    $time = intval($hours)." hour ago";
                } 
                
              }
              else{
                if($minutes >= 1){
                    $time = intval($minutes)." Minutes ago";
                    if(intval($minutes) <= 1)
                {
                    $time = intval($minutes)." Minute ago";
                } 
                
              }
              else{
                $time = "Just Now";
              }
              }
            }   
               if($request->active_chat == $v->id)
               {
                  $html_data .= '<div class="chat_list active_chat" data-val="'.$v->id.'"> ';
               }
               else{
                  $html_data .= '<div class="chat_list" data-val="'.$v->id.'"> '; 
               }  
                 $html_data.= '<div class="chat_people"><div class="chat_img"> <img src="'.$user_data->profile_picture.'" alt="sunil"> </div><div class="chat_ib"><h5>'.$user_data->name.'<span class="chat_date"> '.$time.'</span></h5>  <p>'.$v->message.'';
                 if($v->count > 0)
                 {   
                  $html_data.='<span class="notication-count" style=" float: right; background-color: red; padding: 4px;  font-size: 9px; color: white; font-weight: bold;
                  border-radius: 100%;  position: relative; top: -2px;">'.$v->count.'</span>';
                 }
                 $html_data.='</p> </div> </div></div>';   
            } 
        }
         return response()->json(array("status"=>"success","chat_id"=>$request->chat_id,'html_data'=>$html_data));

      }

    }
    public function update_notication_count(Request $request)
    {  
      ChatMessage::where('chat_id',$request->chat_id)->update(['unseen_count'=>1]);
      return response()->json(array("status"=>"success","message"=>"Updated successfully"));
    }
}
