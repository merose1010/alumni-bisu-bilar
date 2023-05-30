@extends('main.layout.master')

@section('title', 'Alumni | BISU-Bilar')

@section('content') 
    @include('main.components.navbar')
    <main class="success_page">
        <div class="content">
            <i class="fas fa-check-circle"></i>
            <span>You've Successfully Apply for Alumni ID</span>
        </div>

        <div class="links">
            <span>Do you want to apply for membership?</span>
            <a href="/home-alumni-membership">Apply Alumni Membership</a>
        </div>
    </main>
    @include('main.components.footer')
@endsection
