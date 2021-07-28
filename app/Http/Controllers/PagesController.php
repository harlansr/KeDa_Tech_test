<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\User_type;
use App\Models\Feedback;
use App\Models\Message;
use App\Models\Report;
use Illuminate\Support\Collection;


class PagesController extends Controller
{

    public function home(){

        $type_id = \Auth::user()->user_type_id;
        $get_data = User_type::where('id', '=', $type_id)
                ->get();

        // return view('dashboard');
        return view('dashboard',[
            "name"=>\Auth::user()->email,
        ]);
    }
    public function customer(){
        $user = User::where('user_type_id','=',1)
        ->select('id','email')
            ->paginate(20);
        return view('customer',["user" => $user]);
    }
    public function customerPost(Request $request){
        
        //dd($request->id);
        if($request->action == "delete" && \Auth::user()->user_type_id == 2){
            Feedback::where('user_id','=',$request->id)->delete();
            Message::where('user_id','=',$request->id)->delete();
            Message::where('from_user_id','=',$request->id)->delete();
            Report::where('user_id','=',$request->id)->delete();
            Report::where('from_user_id','=',$request->id)->delete();
            User::where('id','=',$request->id)->delete();
        }elseif($request->action == "report"){
            Report::create([
                'user_id'=>$request->id,
                'from_user_id'=>\Auth::user()->id,
                'reason' =>$request->reason
            ]);
        }
        
        // DB::table('users')->where('id', '=', $request->id)->delete();
        
        return redirect()->back();
    }
    public function staff(){
        if(\Auth::user()->user_type_id == 1){
            return redirect()->back();
        }

        $user = User::where('user_type_id','=',2)
        ->select('id','email')
            ->paginate(20);
        return view('staff', ["user" => $user]);
    }

    public function feedback(){
        if(\Auth::user()->user_type_id != 1){
            return redirect()->back();
        }

        return view('feedback');
    }

    public function feedback_send(Request $request){
        // dd(\Auth::user()->id);
        Feedback::create([
            'user_id' => \Auth::user()->id,
            'message' => $request->message
        ]);
        return redirect()->route('home');
    }

    public function feedbacks(){
        if(\Auth::user()->user_type_id != 2){
            return redirect()->back();
        }

        // $feedback = Feedback::orderByRaw('created_at DESC')->get();
        $feedback = DB::table('feedbacks')
            ->join('users','feedbacks.user_id','=','users.id')
            ->orderByRaw('feedbacks.created_at DESC')
            ->paginate(10);
        //dd($feedback);
        return view('feedbacks', ['feedback' => $feedback]);
    }

    public function feedback_d(Id $id){
        return view('feedback_d',["feedback"=>Feedback::find($id)]);

    }

    public function message(){
        $my_id =  \Auth::user()->id;
        $message = Message::where('user_id','=',$my_id)
            ->orWhere('from_user_id','=',$my_id)
            ->leftJoin('users', function($join) use ($my_id){
                $join->on('messages.user_id','=','users.id')
                ->where('messages.user_id', '!=', $my_id )
                ->orOn('messages.from_user_id','=','users.id')
                ->where('messages.from_user_id', '!=', $my_id );
            })
            // ->groupBy('user_id')
            ->orderByRaw('messages.created_at DESC')
            ->get();
        $msg_f = new Collection();
        foreach($message as $msg){
            $msgCheck = $msg_f->where('email', $msg->email)->first();
            if(!$msgCheck)
            {
                $msg_f->push($msg);
            }
        }
        // dd($msg_f);
        return view('message',["message"=>$msg_f]);

    }
    public function message_d(int $id){
        $my_id = \Auth::user()->id;
        $message = Message::where(function($query) use ($id) {
            $query->where('user_id', \Auth::user()->id)
                  ->where('from_user_id', $id);
            })
            ->orWhere(function($query) use ($id) {
                $query->where('from_user_id', \Auth::user()->id)
                      ->where('user_id', $id);
            })
            ->join('users','messages.from_user_id','=','users.id')
            ->orderByRaw('messages.created_at DESC')
            ->paginate(200);
        return view('message_d',['id'=>$id,"message"=>$message]);
    }
    public function message_send(Request $request, int $id){
        if($request->message!=null){
            // dd($request->message);
            Message::create([
                'user_id' => $id,
                'from_user_id' => \Auth::user()->id,
                'message' => $request->message
            ]);
        }
        return redirect()->back();
    }

    public function message_all(){
        if(\Auth::user()->user_type_id != 2){
            return redirect()->back();
        }

        $my_id =  \Auth::user()->id;
        $message = Message::leftJoin('users', function($join) use ($my_id){
                $join->On('messages.from_user_id','=','users.id');
            })
            // ->groupBy('user_id')
            ->orderByRaw('messages.created_at DESC')
            ->get();
        $msg_f = new Collection();
        foreach($message as $msg){
            $msgCheck = $msg_f->where('email', $msg->email)->first();
            if(!$msgCheck)
            {
                $msg_f->push($msg);
            }
        }
        // dd($msg_f);
        return view('message_all',["message"=>$msg_f]);
    }
}
