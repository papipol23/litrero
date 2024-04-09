<?php

namespace App\Http\Controllers;

use App\Events\MessagesUpdate;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PusherController extends Controller
{

    public function index()
    {

    }
    function broadcast(Request $request){

        $user = Auth::user();
        broadcast(new MessagesUpdate($request->get('message'),$user->name))->toOthers();
        $message = $request->get('message');
        return view('message.broadcast',compact('message'));
    }
    function receive(Request $request){
        $message = $request->get('message');
        $user = $request->get('user');
        return view('message.receive',compact('message','user'));
    }
}
