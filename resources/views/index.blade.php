@extends('layouts.layout')
@section('title', 'Языковая школа LINGVO')
@section('header', 'Языковая школа LINGVO')
@section('content')
    <section>
        <div class="section_main">
            <div class="row">
                <section class="eight columns">
                    <form action="" id="filter-form">
                        <div class="filter-container">
                            <input type="radio" name="filter" value="all" id="filter-all"
                                   @if($filter == '' || $filter == 'all') checked @endif>
                            <label for="filter-all">Все</label>
                            <input type="radio" name="filter" value="active" id="filter-active"
                                   @if($filter == 'active') checked @endif>
                            <label for="filter-active">Активные</label>
                            <input type="radio" name="filter" value="full_amount" id="filter-full-amount"
                                   @if($filter == 'full_amount') checked @endif>
                            <label for="filter-full-amount">Нет мест</label>
                            <input type="radio" name="filter" value="past" id="filter-past"
                                   @if($filter == 'past') checked @endif>
                            <label for="filter-past">Прошедшие</label>
                            {{--                            <input type="submit" value="Применить">--}}
                        </div>
                    </form>
                    @if(count($courses) > 0)
                        @foreach($courses as $course)
                            <article class="blog_post">
                                <div class="three columns">
                                    <a href="/course/{{$course->id}}" class="th"><img
                                            src="{{asset('storage/images/' . $course->image)}}" alt="desc"/></a>
                                </div>
                                <div class="nine columns">
                                    <a href="/course/{{$course->id}}"><h4>{{$course->title}}</h4></a>
                                    <p>{{$course->description}}</p>
                                    @if($course->isActive() && $course->getFreeAmount() !== 0)
                                        <p>Дата начала:
                                            <b>{{\Carbon\Carbon::parse($course->start_date)->format('d.m.Y H:i')}}</b>
                                        </p>
                                        <p>Свободных мест: <b>{{$course->getFreeAmount()}}</b></p>
                                    @elseif($course->getFreeAmount() === 0)
                                        <p>Свободных мест нет</p>
                                    @elseif(!$course->isActive())
                                        <p>Курс завершен</p>
                                    @endif
                                    @can('subscribeCourse', $course)
                                        <a href="/course/{{$course->id}}/subscribe">Записаться на курс</a>
                                    @else
                                        @can('cancelSubscribe', $course)
                                            <a href="/course/{{$course->id}}/subscribecancel">Отменить запись</a>
                                        @endcan
                                    @endif
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
    <script>
        window.onload = () => {
            const filters = document.querySelector('.filter-container').getElementsByTagName('input');
            const filterForm = document.querySelector('#filter-form');
            for (let filter of filters) {
                filter.addEventListener('change', () => filterForm.submit());
            }
        }
    </script>
@endsection
