@extends('main.layout.master')

@section('title', 'Alumni | BISU-Bilar')


@push('styles')
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.5/css/buttons.dataTables.min.css">

@endpush

@section('content') 
    @include('main.components.navbar')
    @include('main.components.record')
@endsection

@push('scripts')
    <script src="/bootstrap/js/bootstrap.min.js"></script>
    <script src="/js/moment-library.js"></script>

    <script src="/js/ajax-alumni-id-view-student.js"></script>
    <script src="/js/ajax-alumni-id-edit-student.js"></script>

    <script src="/js/ajax-alumni-mem-view-student.js"></script>
    <script src="/js/ajax-alumni-mem-edit-student.js"></script>

    <script src="/js/ajax-reissueance-view-student.js"></script>
    <script src="/js/ajax-reissueance-edit-student.js"></script>

    <script src="/js/edit-photo-aid.js"></script>
    <script src="/js/edit-photo-amem.js"></script>
    <script src="/js/edit-photo-reissue.js"></script>

    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
    
    <script src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.colVis.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.html5.min.js"></script>

    <script src="/js/client-datatables.js"></script>
    <!-- End -->
    
@endpush