@extends('electo.layouts.app')

@section('content')

    {{-- Navigation --}}
    @include('electo.components.navigation.navbar')

    {{-- Hero Section --}}
    @include('electo.sections.hero')

    {{-- Features Section --}}
    @include('electo.sections.features')

@endsection