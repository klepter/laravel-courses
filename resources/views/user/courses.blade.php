@extends('layouts.layout')
@section('title', 'Мои курсы | Языковая школа LINGVO')
@section('header', 'Мои курсы')
@section('content')
    <section>
        <div class="section_main">
            <div class="row">
                <section class="eight columns">
                    @if(count($userCourses) > 0)
                        @foreach($userCourses as $course)
                            <article class="blog_post">
                                <div class="three columns">
                                    <a href="/course/{{$course->id}}" class="th"><img
                                            src="{{asset('storage/images/' . $course->image)}}" alt="desc"/></a>
                                </div>
                                <div class="nine columns">
                                    <a href="/course/{{$course->id}}"><h4>{{$course->title}}</h4></a>
                                    <p>{{$course->description}}</p>
                                    <p>Дата начала: <b>{{\Carbon\Carbon::parse($course->start_date)->format('d.m.Y H:i')}}</b></p>
                                    @if(!Gate::allows('cancelSubscribe', $course))
                                        <p>До старта курса меньше 1 дня, запись отменить нельзя</p>
                                    @elseif(!$course->isActive())
                                        <p>Курс завершен</p>
                                    @else
                                        <a href="/course/{{$course->id}}/subscribecancel">Отменить запись</a>
                                    @endif
                                </div>
                            </article>
                        @endforeach
                    @else
                        <p>Вы не записаны ни на один курс</p>
                    @endif
                </section>
            </div>
        </div>
    </section>
@endsection
