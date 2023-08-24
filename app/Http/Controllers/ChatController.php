<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Chat;
use Session;

class ChatController extends Controller
{
    public function sendMessage(Request $req){
        $chat = new Chat();
        $chat->other_id = $req->other_id;
        $chat->my_id = Session::get('username');
        $chat->msg = $req->msg;
    
        
        // Handle file uploads
        $filenames = [];
        if ($req->hasFile('files')) {
            $files = $req->file('files');
            foreach ($files as $file) {
                
                $filename = time().'_'.$file->getClientOriginalName();
                $location = 'assets/chat';
                $file->move($location,$filename);
                array_push($filenames,$filename);
            }
            $chat->files = implode(',', $filenames);
        }
        // Save the message to the database
        $chat->save();
        return response()->json(['msg'=> $req->msg,'filenames'=> $filenames]);
    }
    public function getMessages(Request $req){
        $my_id = Session::get('username');
        $other_id = $req->other_id;
        $messages =  Chat::where(function($query) use ($other_id,$my_id){
            $query->where('my_id',$other_id)->where('other_id',$my_id);
        })->orWhere(function($q) use ($other_id,$my_id){
            $q->where('my_id',$my_id)->where('other_id',$other_id);
        })->get();
        $all_msgs = '';
        foreach($messages as $msg){
            $rname = User::where('username',$msg->other_id)->first();
            $sname = User::where('username',$msg->my_id)->first();

            if($msg->other_id==$other_id){
                $all_msgs.= '<div class="msgg outgoing-msg">'.$msg->msg.'</div>';
            }
            else{
                $all_msgs.=  '<div class="msgg incoming-msg">'.$msg->msg.'</div>';
            }
        }
        return $all_msgs;
    }
}
