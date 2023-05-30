@extends('main.layout.master')

@section('title', 'Alumni | BISU-Bilar')

@section('content') 
    @include('main.components.navbar')
    <main class="main_announce">
    @include('main.components.news-announcements')
    </main>
    @include('main.components.footer')
@endsection

