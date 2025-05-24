@extends('frontend.layout')

@section('title', $meta['title'])
@section('description', $meta['description'])
@section('canonical', request()->url())

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow text-center py-4 mb-4 mb-lg-0">
                <div class="card-body">
                    <h1 class="display-3 mb-3">{{ $meta['title'] }}</h1>
                    <p>{{ $meta['description'] }}.</p>
                    <p class="mt-5">Выбирайте для своего портфеля <b><a href="{{ route('frontend.growthStocks') }}" class="text-secondary">акции с повышенным потенциалом роста</a></b> на основе фундаментальных показателей.</p>
                    <p>Изучайте <b><a href="{{ route('frontend.multiplicators') }}" class="text-secondary">мультипликаторы</a></b> и наблюдайте за их поведением у разных компаний.</p>
                </div>
            </div>
        </div>
    </div>

@endsection
