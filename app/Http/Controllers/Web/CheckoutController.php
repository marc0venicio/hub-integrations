<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
// use Gate;

class CheckoutController extends Controller
{
    public function index()
    {

        $plan_id = session('plan_id');
        $plan = Plan::find($plan_id);
        if (!$plan) {
            return redirect()->route('home.index');
        }

        return view('checkout', compact('plan'));
    }
}
