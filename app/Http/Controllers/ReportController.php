<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{

    public function student()
    {
        return view('report.student.index');
    }
    public function allen()
    {
        return view('test');
    }
}
