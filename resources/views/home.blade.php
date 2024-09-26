@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="text-center mb-5">Planos de Assinatura Hub</h1>
        <div class="row">
            @foreach($plans as $plan)
                <div class="col-md-4">
                    <div class="card text-center shadow-sm mb-4" >
                        <div class="card-body">
                            @if($loop->index == 1)
                                <div class="badge bg-primary text-white mb-3">Mais Popular</div>
                            @endif
                            <h5 class="card-title">{{ $plan->name }}</h5>
                            <p class="text-muted">{{ $plan->description }}</p>
                            <h2 class="fw-bold text-primary">R$ {{ number_format($plan->price, 2, ',', '.') }}/mês</h2>
                            <a href="#" class="btn btn-primary w-100">Escolher plano</a>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">{{ $plan->features }}</li>
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
