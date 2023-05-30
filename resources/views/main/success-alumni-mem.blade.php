@extends('main.layout.master')

@section('title', 'Alumni | BISU-Bilar')

@section('content') 
    @include('main.components.navbar')
    <main class="success_page">
        <div class="content">
            <i class="fas fa-check-circle"></i>
            <span>You've Successfully Apply for Alumni Membership</span>
        </div>

        <div class="links">
            <span>Do you want to apply for Alumni ID?</span>
            <a href="/home-alumni-id">Apply Alumni ID</a>
        </div>
    </main>
    @include('main.components.footer')
@endsection
