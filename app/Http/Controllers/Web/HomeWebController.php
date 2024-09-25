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
        return view('home');
    }

    // public function store(StorePlanRequest $request)
    // {
    //     $plan = Plan::create($request->validated());

    //     return (new PlanResource($plan))
    //         ->response()
    //         ->setStatusCode(Response::HTTP_CREATED);
    // }

    // public function create()
    // {
    //     abort_if(Gate::denies('plan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     return response([
    //         'meta' => [
    //             'active'        => Plan::ACTIVE_RADIO,
    //             'billing_cycle' => Plan::BILLING_CYCLE_SELECT,
    //         ],
    //     ]);
    // }

    // public function show(Plan $plan)
    // {
    //     abort_if(Gate::denies('plan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     return new PlanResource($plan);
    // }

    // public function update(UpdatePlanRequest $request, Plan $plan)
    // {
    //     $plan->update($request->validated());

    //     return (new PlanResource($plan))
    //         ->response()
    //         ->setStatusCode(Response::HTTP_ACCEPTED);
    // }

    // public function edit(Plan $plan)
    // {
    //     abort_if(Gate::denies('plan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     return response([
    //         'data' => new PlanResource($plan),
    //         'meta' => [
    //             'active'        => Plan::ACTIVE_RADIO,
    //             'billing_cycle' => Plan::BILLING_CYCLE_SELECT,
    //         ],
    //     ]);
    // }

    // public function destroy(Plan $plan)
    // {
    //     abort_if(Gate::denies('plan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     $plan->delete();

    //     return response(null, Response::HTTP_NO_CONTENT);
    // }
}
