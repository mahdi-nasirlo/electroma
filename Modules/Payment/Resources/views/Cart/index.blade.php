@extends('layouts.master')

@section('content')
    <div>

        @include('blog::hero.index', ['name' => 'سبد خرید'])

        <livewire:payment::cart.cart />
    </div>
@endsection
