@extends('main.layout.master')

@section('title', 'Alumni | BISU-Bilar')

@section('content') 
    @include('main.components.navbar')
    <main class="main_about">
    @include('main.components.about')
    </main>
    @include('main.components.footer')
@endsection

