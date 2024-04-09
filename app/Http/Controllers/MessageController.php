<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    public function index()
    {
        return view('message.index');
    }


}
