@extends('main.layout.master')

@section('title', 'Alumni | BISU-Bilar')

@section('content') 
    @include('main.components.navbar')
    <main class="success_page_reissueance">
        <div class="content">
            <i class="fas fa-check-circle"></i>
            <span>Your ID has been successfully reissued.</span>
        </div>

        <div class="links">
            <div>
                <span>Do you want to apply for membership?</span>
                <a href="/home-alumni-membership">Apply Alumni Membership</a>
            </div>
            <div>
                <span>Do you want to apply for Alumni ID?</span>
                <a href="/home-alumni-id">Apply Alumni ID</a>
            </div>
        </div>
    </main>
    @include('main.components.footer')
@endsection
