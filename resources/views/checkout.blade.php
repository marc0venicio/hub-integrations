
@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5">Checkout</h1>

    <div class="text-center mb-4">
        <a href="/dashboard" class="btn btn-secondary">Ir para Dashboard</a>
    </div>

    <div class="card text-center shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title mb-2">Olá, {{ auth()->user()->name }}!</h5>
            <p class="card-text">Você está adquirindo o <strong style="font-size: 20px" >{{ $plan->name }}</strong> por <strong>R$ {{ number_format($plan->price, 2, ',', '.') }}/mês</strong>.</p>
            <h6 class="mt-4">Estão inclusos:</h6>
            <ul class="list-group list-group-flush">
                @foreach(explode(',', $plan->feature) as $feat)
                    <li class="list-group-item">{{ trim($feat) }}</li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="text-center">
        <a href="{{ route('home.index') }}" class="btn">Seleção de planos</a>
    </div>
</div>
@endsection
