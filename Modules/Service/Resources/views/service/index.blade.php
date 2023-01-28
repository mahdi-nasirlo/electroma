@extends('layouts.master')

@section('content')
    @include('blog::hero.index', ['name' => 'تماس با ما', 'string' => 'درخواست خدمات'])
    @include('service::service.contact-us')
    @include('service::service.contact-to-us-way')
@endsection
