@extends('layouts.master')


@section('content')
    <div>
        @include('blog::hero.index', ['name' => 'صندوق'])

        <livewire:payment::guest-pay.payment />
    </div>
@endsection
