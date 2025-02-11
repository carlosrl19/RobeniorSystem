@extends('layouts.app')

@section('head')

<!-- Datatable CSS -->
<link href="{{ asset('vendor/datatables/datatables.min.css') }}" rel="stylesheet">

<!-- Tomselect -->
<link href="{{ asset('vendor/tomselect/tom-select.min.css') }}" rel="stylesheet">

<!-- Venobox -->
<link href="{{ asset('vendor/venobox/venobox.min.css') }}" rel="stylesheet">
@endsection

@section('pretitle')
Listado de usuarios
@endsection

@section('title')
Usuarios
@endsection

@section('create')
@if ($errors->any())
<button id="alertButton" class="btn btn-sm btn-danger shake" data-bs-toggle="modal" data-bs-target="#modal-errors">
    <x-heroicon-o-bell-alert class="w-5 h-5 p-1 text-white" />
    <span class="align-middle clamp_text"> </span>
</button>
@endif

<a href="#" class="btn bt-sm btn-primary clamp_text" data-bs-toggle="modal" data-bs-target="#user_create">
    <x-heroicon-o-plus class="w-3 h-3 text-white" />
    &nbsp;Crear
</a>
@endsection

@section('content')
<div class="card" style="width: 100%">
    <div class="card-body">
        <table id="users_table" class="display table table-bordered">
            <thead>
                <tr style="background-color: #224488;">
                    <th>Imagen perfil</th>
                    <th>Role</th>
                    <th>Permisos asignados</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody style="font-size: clamp(0.6rem, 3vw, 0.7rem) !important">
                @foreach ($users as $user)
                <tr>
                    <td>
                        @if ($user->profile_photo)
                        <div class="d-flex flex-wrap justify-content-center">
                            <div class="mx-2 my-1">
                                <a class="profile_photo" data-gall="user_gallery" title="Foto perfil - {{ $user->name }}" data-fitview="true" href="images/uploads/users/{{ $user->profile_photo }}">
                                    <img id="image-preview" style="border: 1px solid #e3e3e3; border-radius: 5px; padding: 5px;" src="images/uploads/users/{{ $user->profile_photo }}" alt="Profile photo" width="30" height="30">
                                </a>
                            </div>
                        </div>
                        @else
                        N/D
                        @endif
                    </td>
                    <td>
                        <span class="badge bg-primary">
                            {{ implode(', ', $user->getRoleNames()->toArray()) }}
                        </span>
                    </td>
                    <td>
                        @foreach ($user->getAllPermissions() as $permission)
                        <span class="badge mt-1 bg-teal" title="{{ $permission->permission_description }}" data-bs-toggle="tooltip" data-bs-placement="top">
                            {{ $permission->name }}
                        </span>
                        @endforeach
                    </td>
                    <td>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#user_update{{ $user->id }}">{{ $user->name }}</a>
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="#" class="text-danger" data-bs-toggle="modal" data-bs-target="#delete_user{{ $user->id }}"><x-heroicon-o-trash class="w-3 h-3" /> Eliminar</a>
                    </td>
                </tr>

                <!-- Includes -->
                @include('modules.users._update')
                @include('modules.users._delete')

                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('modules.users._create')
@include('layouts._error_modal')
@endsection

@section('scripts')

<!-- JQuery -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>

<!-- Datatable -->
<script src="{{ asset('vendor/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('customjs/datatables/dt_users.js') }}"></script>

<!-- Toast closer -->
<script src="{{ asset('customjs/scripts/toast_closer.js') }}"></script>

<!-- Tomselect -->
<script src="{{ asset('vendor/tomselect/tom-select.complete.js') }}"></script>
<script src="{{ asset('customjs/tomselect/ts_users.js') }}"></script>

<!-- Carousel viewer (create) -->
<script src="{{ asset('customjs/carousels/carousel_profile_picture_users_viewer.js')}}"></script>

<!-- Venobox -->
<script src="{{ asset('vendor/venobox/venobox.min.js')}}"></script>
<script src="{{ asset('customjs/venobox/vb_users.js')}}"></script>
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