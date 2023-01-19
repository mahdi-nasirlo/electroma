@extends('layouts.master')

@section('content')
    <livewire:shop::product-list :category="$category" />
@endsection
