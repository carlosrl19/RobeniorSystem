@extends('layouts.app')

@section('head')

<!-- Datatable CSS -->
<link href="{{ asset('vendor/datatables/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('pretitle')
Listado de categorías
@endsection

@section('title')
Categorías
@endsection

@section('create')
@if ($errors->any())
<button id="alertButton" class="btn btn-sm btn-danger shake" data-bs-toggle="modal" data-bs-target="#modal-errors">
    <x-heroicon-o-bell-alert class="w-5 h-5 p-1 text-white" />
    <span class="align-middle clamp_text"> </span>
</button>
@endif

<a href="#" class="btn bt-sm btn-primary clamp_text" data-bs-toggle="modal" data-bs-target="#product_create">
    <x-heroicon-o-plus class="w-3 h-3 text-white" />
    &nbsp;Crear
</a>
@endsection

@section('content')
<div class="card" style="width: 100%">
    <div class="card-body">
        <table id="categories_table" class="display table table-bordered">
            <thead>
                <tr style="background-color: #224488;">
                    <th>Nombre</th>
                    <th>Descripción categoría</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody style="font-size: clamp(0.6rem, 3vw, 0.7rem) !important">
                @foreach ($categories as $category)
                <tr>
                    <td>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#category_update{{ $category->id }}">{{ $category->category_name }}</a>
                    </td>
                    <td>{{ $category->category_description }}</td>
                    <td>
                        <a href="#" class="text-danger" data-bs-toggle="modal" data-bs-target="#delete_category{{ $category->id }}"><x-heroicon-o-trash class="w-3 h-3" /> Eliminar</a>
                    </td>
                </tr>

                <!-- Includes -->
                @include('modules.categories._update')
                @include('modules.categories._delete')

                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('modules.categories._create')
@include('layouts._error_modal')
@endsection

@section('scripts')

<!-- JQuery -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>

<!-- Datatable -->
<script src="{{ asset('vendor/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('customjs/datatables/dt_categories.js') }}"></script>

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