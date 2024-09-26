<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HomeWebController extends Controller
{
    public function index()
    {
        $plans = Plan::all();
        return view('home', compact('plans'));
    }

}
