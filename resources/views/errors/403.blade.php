@extends('errors::minimal')

@section('title', 'دسترسی ممنوع است')
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden'))
