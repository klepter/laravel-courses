@extends('layouts.layout')
@section('title', $course->title)
@section('header-content')
    <article>
        @if($userSubscribeCourse !== false)
            <div class="eight columns">
                <p class="excerpt">
                    <b>Вы записаны на этот курс</b>
                </p>
            </div>
        @endif
        <div class="twelve columns">
            <h1>{{$course->title}}</h1>
            <p class="excerpt">
                Начало курса: <b>{{\Carbon\Carbon::parse($course->start_date)->format('d.m.Y, H.i')}}</b>
            </p>
            <p class="excerpt">
                Количество мест: <b>{{$course->getFreeAmount(). '/' .$course->amount}}</b>
            </p>
        </div>
    </article>
@endsection
@section('content')
    <section class="section_light">
        <div class="row">
            <p><img src="{{asset('/storage/images/' . $course->image)}}" alt="{{$course->title}}" width=400>
                {{$course->description}}
            </p>
        </div>
    </section>
@endsection
