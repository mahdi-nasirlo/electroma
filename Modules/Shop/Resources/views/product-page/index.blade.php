@extends('layouts.master')

@section('content')
    <livewire:shop::product-page :product="$product" />
@endsection

@section('style')
    @vite('resources/css/tiny-slider.css')
@endsection

@section('script')
    <script src="\static\assets\tiny-slider.js"></script>
@endsection
