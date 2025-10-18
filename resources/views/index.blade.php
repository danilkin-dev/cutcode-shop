@extends('layouts.app')

@section('content')
    @auth
        <form action="{{ route('logout') }}" method="post">
            @csrf
            @method('DELETE')

            <button>Выйти</button>
        </form>
    @endauth
@endsection
