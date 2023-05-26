@extends('layouts.layout')
@section('title', '')
@section('header', 'Записи на курсы')
@section('content')
    <section>
        <div class="section_main">
            <div class="row">
                <section class="eight columns">
                    <h3>Курс: {{$course->title}}</h3>
                    @if(count($course->users) == 0)
                        <p>Нет записей</p>
                    @else
                        @foreach($course->users as $user)
                            <article class="blog_post">
                                <div class="three columns">
                                    <img
                                        src="{{asset('/storage/images/'.$user->image)}}" alt="{{$user->name}}"/>
                                </div>
                                <div class="nine columns">
                                    <h4>{{$user->name}}</h4>
                                    <div>
                                        <form action="/admin/{{$course->id}}/{{$user->id}}/cancelsubscribe" method="POST">
                                            @csrf
                                            <input type="submit" value="Отменить запись" />
                                        </form>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    @endif
                </section>
            </div>
        </div>
    </section>
@endsection
