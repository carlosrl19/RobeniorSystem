@extends('layouts.app')

@section('head')

<!-- Datatable CSS -->
<link href="{{ asset('vendor/datatables/datatables.min.css') }}" rel="stylesheet">

<!-- Venobox -->
<link href="{{ asset('vendor/venobox/venobox.min.css') }}" rel="stylesheet">

@endsection

@section('pretitle')
Listado de productos
@endsection

@section('title')
Inventario
@endsection

@section('create')
@if ($errors->any())
<button id="alertButton" class="btn btn-sm btn-danger shake" data-bs-toggle="modal" data-bs-target="#modal-errors">
    <x-heroicon-o-bell-alert class="w-5 h-5 p-1 text-white" />
    <span class="align-middle clamp_text"> </span>
</button>
@endif

<a href="{{ route('products.inventory_report') }}" class="btn bt-sm btn-success clamp_text">
    <x-heroicon-o-document-text class="w-3 h-3 text-white" />
    &nbsp;Exportar inventario
</a>

<a href="#" class="btn bt-sm btn-primary clamp_text" data-bs-toggle="modal" data-bs-target="#product_create">
    <x-heroicon-o-plus class="w-3 h-3 text-white" />
    &nbsp;Crear
</a>
@endsection

@section('content')

<div class="container">
    <!-- Include tabs/tables -->
    @include('modules.products.table_tabs')
</div>

@include('modules.products._create')
@include('layouts._error_modal')
@endsection

@section('scripts')

<!-- JQuery -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>

<script src="{{ asset('customjs/carousels/carousel_products_create.js') }}"></script>
<script src="{{ asset('customjs/carousels/carousel_products_update.js') }}"></script>

<!-- Datatable -->
<script src="{{ asset('vendor/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('customjs/datatables/dt_products.js') }}"></script>
<script src="{{ asset('customjs/datatables/dt_tools.js') }}"></script>
<script src="{{ asset('customjs/datatables/dt_fornitures.js') }}"></script>

<!-- Venobox -->
<script src="{{ asset('vendor/venobox/venobox.min.js')}}"></script>
<script src="{{ asset('customjs/venobox/vb_products.js')}}"></script>

<!-- Toast closer -->
<script src="{{ asset('customjs/scripts/toast_closer.js') }}"></script>
@endsection

@section('messages')
@if(session('success'))
<div class="toast show fade" role="alert" aria-live="assertive" aria-atomic="true"
    style="position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%); z-index: 1050;">
    <div class="toast-body clamp_text_toast toast-success">
        <span class="align-middle">
            {{ session('success') }}
        </span>
    </div>
</div>
@endif

@if ($errors->any())
<div class="toast show fade" role="alert" aria-live="assertive" aria-atomic="true"
    style="position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%); z-index: 1050;"
    data-bs-autohide="false">
    <div class="toast-body toast-error clamp_text_toast">
        <span class="align-middle">
            Error al guardar el registro.
        </span>
    </div>
</div>
@endif
@endsection