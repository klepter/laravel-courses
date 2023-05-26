@extends('layouts.layout')
@section('title', 'Вход')
@section('header', 'Вход')
@section('content')
    <div class="register">

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')"/>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="input_type" :value="__('Email или логин')"/>
                <x-text-input id="input_type" class="block mt-1 w-full" type="text" name="input_type" :value="old('input_type')"
                              required autofocus autocomplete="username"/>
                <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                <x-input-error :messages="$errors->get('login')" class="mt-2"/>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Пароль')"/>

                <x-text-input id="password" class="block mt-1 w-full"
                              type="password"
                              name="password"
                              required autocomplete="current-password"/>

                <x-input-error :messages="$errors->get('password')" class="mt-2"/>
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                           name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Запомнить меня') }}</span>
                </label>
            </div>
            <div class="register-controls">
                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ml-3">
                        {{ __('Войти') }}
                    </x-primary-button>
                </div>
            </div>
        </form>
    </div>
@endsection
