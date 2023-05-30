@extends('main.layout.master')

@section('title', 'Alumni | BISU-Bilar')


@section('content') 
    @include('main.components.navbar')
    @include('main.components.reissuance')
    @include('main.components.footer')
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="/js/validation-reissueance.js"></script>
@endpush