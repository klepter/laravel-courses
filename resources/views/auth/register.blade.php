@extends('layouts.layout')
@section('title', 'Регистрация')
@section('header', 'Регистрация')
@section('content')
    <div class="register">
        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Имя')"/>
                <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus
                              autocomplete="name"/>
                <x-input-error :messages="$errors->get('name')"/>
            </div>

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')"/>
                <x-text-input id="email" type="email" name="email" :value="old('email')" required
                              autocomplete="username"/>
                <x-input-error :messages="$errors->get('email')"/>
            </div>

            <!-- Login -->
            <div>
                <x-input-label for="login" :value="__('Логин')"/>
                <x-text-input id="login" type="text" name="login" :value="old('login')" required
                              autocomplete="username"/>
                <x-input-error :messages="$errors->get('login')"/>
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Пароль')"/>

                <x-text-input id="password"
                              type="password"
                              name="password"
                              required autocomplete="new-password"/>

                <x-input-error :messages="$errors->get('password')"/>
            </div>

            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" :value="__('Подтверждение пароля')"/>

                <x-text-input id="password_confirmation"
                              type="password"
                              name="password_confirmation" required autocomplete="new-password"/>

                <x-input-error :messages="$errors->get('password_confirmation')"/>
            </div>

            <!-- Image -->
            <div>
                <x-input-label for="image" :value="__('Аватар')"/>
                <x-text-input id="image" type="file" name="image" accept="image/*" :value="old('image')"/>
                <x-input-error :messages="$errors->get('image')"/>
            </div>

            <div class="register-controls">
                <a href="{{ route('login') }}">
                    {{ __('Уже зарегистированы?') }}
                </a>

                <x-primary-button>
                    {{ __('Регистрация') }}
                </x-primary-button>
            </div>
        </form>
    </div>
@endsection
