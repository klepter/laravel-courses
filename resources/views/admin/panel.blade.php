@extends('layouts.layout')
@section('title', 'Админ-панель | Языковая школа LINGVO')
@section('header', '')
@section('content')
    <section>
        <div class="section_main">
            <div class="row">
                <section class="eight columns">
                    @foreach($courses as $language => $hasCourses)
                        <h3>{{$language}}</h3>
                        @if(count($hasCourses) == 0)
                            <p>Нет курсов</p>
                        @else
                            @foreach($hasCourses as $course)
                                <article class="blog_post">
                                    <div class="three columns">
                                        <a href="/course/{{$course->id}}" class="th">
                                            <img
                                                src="{{asset('/storage/images/'.$course->image)}}"
                                                alt="{{$course->title}}"/>
                                        </a>
                                    </div>
                                    <div class="nine columns">
                                        <a href="/course/{{$course->id}}">
                                            <h4>{{$course->title}}</h4>
                                        </a>
                                        <p>{{$course->description}}</p>
                                        <div>
                                            @cannot('deleteCourse', $course)
                                                <p>Есть записи на курс, удаление запрещено</p>
                                            @else
                                                <form action="{{route('course.delete', ['id' => $course->id])}}"
                                                      method="POST">
                                                    @csrf
                                                    <input type="submit" value="Удалить">
                                                </form>
                                            @endif
                                        </div>
                                        <div>
                                            <form action="{{route('course.editForm', ['id' => $course->id])}}">
                                                @csrf
                                                <input type="submit" value="Редактировать">
                                            </form>
                                        </div>
                                        <div>
                                            <a href="/admin/course/{{$course->id}}/users">Записи на курс</a>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        @endif
                    @endforeach
                </section>
                <section class="four columns">
                    <H3> &nbsp; </H3>
                    <div class="panel">
                        <h3>Админ-панель</h3>
                        <ul class="accordion">
                            <li class="active">
                                <div class="title">
                                    <a href="{{route('course.add')}}"><h5>Добавить курс</h5></a>
                                </div>
                            </li>
                        </ul>
                    </div>
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
