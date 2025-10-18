@extends('layouts.auth')

@section('title', 'Восстановление пароля')

@section('content')
    <x-forms.auth-forms title="Восстановление пароля" action="{{ route('password.update') }}" method="POST">
        @csrf

        <input type="hidden" name="token" value="{{ request('token') }}">

        <x-forms.text-input name="email" type="email" value="{{ request('email') }}" placeholder="E-mail" required
            :isError="$errors->has('email')" />

        @error('email')
            <x-forms.error>{{ $message }}</x-forms.error>
        @enderror

        <x-forms.text-input name="password" type="password" placeholder="Пароль" required :isError="$errors->has('password')" />

        @error('password')
            <x-forms.error>{{ $message }}</x-forms.error>
        @enderror

        <x-forms.text-input name="password_confirmation" type="password" placeholder="Повторите пароль" required
            :isError="$errors->has('password_confirmation')" />

        @error('password_confirmation')
            <x-forms.error>{{ $message }}</x-forms.error>
        @enderror

        <x-forms.primary-button>Обновить пароль</x-forms.primary-button>
    </x-forms.auth-forms>
@endsection
