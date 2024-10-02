<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HomeWebController extends Controller
{
    public function index()
    {
        $plans = Plan::all();
        return view('home', compact('plans'));
    }
    public function choosePlan($plan_id)
    {
        session(['plan_id' => $plan_id]);

        if (Auth::check()) {
            return redirect()->route('checkout');
        }

        return redirect()->route('login', ['plan_id' => $plan_id]);
    }
}
