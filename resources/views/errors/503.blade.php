@extends('errors::minimal')

@section('title', 'عدم مجوز دسترسی')
@section('code', '503')
@section('message', trans('messages.Service Unavailable'))
