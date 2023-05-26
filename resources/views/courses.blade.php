@extends('layouts.layout')
@section('title', $language->title.' | Языковая школа LINGVO')
@section('header', 'Языковая школа LINGVO')
@section('content')
    <section>
        <div class="section_main">
            <div class="row">
                <section class="eight columns">
                    <h3>{{$language->title}}</h3>
                    @if(count($courses) > 0)
                        @foreach($courses as $course)
                            <article class="blog_post">
                                <div class="three columns">
                                    <a href="/course/{{$course->id}}" class="th"><img src="{{asset('storage/images/' . $course->image)}}" alt="desc"/></a>
                                </div>
                                <div class="nine columns">
                                    <a href="/course/{{$course->id}}"><h4>{{$course->title}}</h4></a>
                                    <p>{{$course->description}}</p>
                                </div>
                            </article>
                        @endforeach
                    @else
                        <p>Курсов нет</p>
                    @endif
                </section>
            </div>
        </div>
    </section>
    <!-- ######################## Section ######################## -->
    <section>
        <div class="section_dark">
            <div class="row">
                <h2></h2>
                <div class="two columns">
                    <img src="{{asset('storage/images/thumb1.jpg')}}" alt="desc"/>
                </div>
                <div class="two columns">
                    <img src="{{asset('storage/images/thumb2.jpg')}}" alt="desc"/>
                </div>
                <div class="two columns">
                    <img src="{{asset('storage/images/thumb3.jpg')}}" alt="desc"/>
                </div>
                <div class="two columns">
                    <img src="{{asset('storage/images/thumb4.jpg')}}" alt="desc"/>
                </div>
                <div class="two columns">
                    <img src="{{asset('storage/images/thumb5.jpg')}}" alt="desc"/>
                </div>
                <div class="two columns">
                    <img src="{{asset('storage/images/thumb6.jpg')}}" alt="desc"/>
                </div>
            </div>
        </div>
    </section>
@endsection
