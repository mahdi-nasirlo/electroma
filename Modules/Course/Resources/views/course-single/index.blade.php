@extends('layouts.master')

@section('content')
    @include('course::course-single.hero', ['cours' => $course])
    @include('course::course-single.future')
    @include('course::course-single.price')
    @include('course::course-single.content')
    @include('course::course-single.common-question')
    @include('course::course-single.similar', [
        'papular' => \Modules\Course\Entities\Course::all()->take(6),
    ])
    <div class="container-xxl">
        @include('course::comment.index', [
            'comments' => $course->comments->where('is_visible', true)->where('parent_id', 0),
            'commentable' => $course,
        ])
    </div>
@endsection
