@extends('layouts.dashboard')


@section('header')
    <header class="bg-white shadow">
        <div class="container px-4 py-6 mx-auto sm:px-6 lg:px-8">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('User') }}
            </h2>
        </div>
    </header>
@endsection


@section('content')
    <div class="container px-3 py-12 mx-auto">
        @livewire('user.index')
    </div>
@endsection
