@extends('layouts.layout')
@section('title', 'Добавление курса')
@section('header', 'Добавление курса')
@section('content')
    <div class="register">
        <x-auth-session-status class="mb-4" :status="session('status')"/>
        <form action="{{route('course.edit', $course->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="title">Заголовок</label>
                <input id="title" type="text" name="title" value="{{old('title') ?? $course->title}}"
                       required autofocus/>
                <x-input-error :messages="$errors->get('title')"/>
            </div>
            <div>
                <label for="description">Описание</label>
                <textarea name="description" style="resize: none" id="description" cols="30" rows="10"
                          required>{{old('description') ?? $course->description}}</textarea>
                <x-input-error :messages="$errors->get('title')"/>
            </div>
            <div>
                <label for="amount">Количество мест</label>
                <input id="amount" type="number" name="amount" min="1" value="{{old('amount') ?? $course->amount}}"
                       required/>
                <x-input-error :messages="$errors->get('amount')"/>
            </div>
            <div>
                <label for="start_date">Дата и время начала</label>
                <input id="start_date" type="datetime-local" name="start_date"
                       value="{{old('start_date') ?? $course->start_date}}"
                       required/>
                <x-input-error :messages="$errors->get('start_date')"/>
            </div>
            <div>
                <label for="code_id">Изучаемый язык</label>
                <select name="code_id" id="code_id">
                    @foreach($languages as $language)
                        <option value="{{$language->id}}"
                                @if(old('code_id') == $language->id || $course->code_id == $language->id) selected @endif>
                            {{$language->title}}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('code_id')"/>
            </div>
            <div>
                <label for="image">Обложка курса</label>
                <input type="file" id="image" name="image" accept="image/*">
                <x-input-error :messages="$errors->get('image')"/>
            </div>

            <div class="register-controls">
                <x-primary-button>
                    {{ __('Редактировать курс') }}
                </x-primary-button>
            </div>
        </form>
    </div>
@endsection
