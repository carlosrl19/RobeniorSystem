@extends('layouts.app')

@section('head')

<!-- Datatable CSS -->
<link href="{{ asset('vendor/datatables/datatables.min.css') }}" rel="stylesheet">

<!-- Tomselect -->
<link href="{{ asset('vendor/tomselect/tom-select.min.css') }}" rel="stylesheet">
@endsection

@section('pretitle')
Listado principal
@endsection

@section('title')
Roles
@endsection

@section('create')
@if ($errors->any())
<button id="alertButton" class="btn btn-sm btn-danger shake" data-bs-toggle="modal" data-bs-target="#modal-errors">
    <img style="filter: brightness(0) saturate(100%) invert(100%) sepia(100%) saturate(1%) hue-rotate(245deg) brightness(105%) contrast(96%);"
        src="{{ asset('../static/svg/cancel.svg') }}" width="15" height="15"
        alt="">
    <span class="align-middle clamp_text"> </span>
</button>
@endif

<a href="#" class="btn btn-primary" style="font-size: clamp(0.6rem, 6vh, 0.7rem);" data-bs-toggle="modal" data-bs-target="#modal-create">
    + Nuevo role
</a>
@endsection

@section('content')
<div class="container-xl">
    <div class="card" style="width: 100%; overflow: visible;">
        <div class="card-body">
            <table id="roles_table" class="display table table-bordered">
                <thead>
                    <tr style="background-color: #224488;">
                        <th>#</th>
                        <th>NOMBRE ROL</th>
                        <th>DESCRIPCION ROL</th>
                        <th>PERMISOS</th>
                        <th style="width: 8vh">ACCIONES</th>
                    </tr>
                </thead>
                <tbody style="font-size: clamp(0.6rem, 3vw, 0.7rem) !important">
                    @foreach($roles as $i => $role)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>
                            <span class="badge bg-primary">
                                <a href="#" class="text-white" data-bs-toggle="modal" data-bs-target="#update_role{{ $role->id }}">{{ $role->name }}</a>
                            </span>
                        </td>
                        <td>
                            @foreach ($role->getAllPermissions() as $permission)
                            <span class="badge mt-1 bg-teal" title="{{ $permission->permission_description }}" data-bs-toggle="tooltip" data-bs-placement="top">
                                {{ $permission->name }}
                            </span>
                            @endforeach
                        </td>
                        <td>
                            {{ $role->role_description }}
                        </td>
                        <td>
                            <a href="#" class="text-danger" data-bs-toggle="modal" data-bs-target="#delete_role{{ $role->id }}"><x-heroicon-o-trash class="w-3 h-3" /> Eliminar</a>
                        </td>
                    </tr>

                    <!-- Role update modal -->
                    @include('modules.roles._update')

                    <!-- Role delete modal -->
                    @include('modules.roles._delete')

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('modules.roles._create')
@endsection

@section('scripts')

<!-- JQuery -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>

<!-- Toast fade closer script -->
<script src="{{ asset('customjs/scripts/toast_closer.js')}}"></script>

<!-- Toast alert animation -->
@if ($errors->any())
<script src="{{ asset('customjs/scripts/alert_animation.js') }}"></script>
@endif

<!-- Datatable -->
<script src="{{ asset('vendor/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('customjs/datatables/dt_roles.js') }}"></script>
<script src="{{ asset('customjs/datatables/dt_permissions.js') }}"></script>

<!-- Tomselect -->
<script src="{{ asset('vendor/tomselect/tom-select.complete.js') }}"></script>
<script src="{{ asset('customjs/tomselect/ts_permissions.js') }}"></script>
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