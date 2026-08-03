@extends('layouts.app')

@section('title', 'Camilo_nc · Bienvenido a mi mundo')

@section('content')
    @include('partials.hero')
    @include('partials.stream')
    @include('partials.about')
    @include('partials.league')
    @include('partials.games')
    @include('partials.music')
    @include('partials.squad')
    @include('partials.highlights')
@endsection
