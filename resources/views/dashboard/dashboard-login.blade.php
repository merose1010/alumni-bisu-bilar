@extends('dashboard.layout.master')

@section('styles')
    @include('dashboard.assets.style')
@endsection

@section('content')
    @include('dashboard.components.dashboard-login')
@endsection

@section('script')
    @include('dashboard.assets.script')
@endsection