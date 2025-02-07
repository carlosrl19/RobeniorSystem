@extends('layouts.app')

@section('head')

<!-- Datatable CSS -->
<link href="{{ asset('vendor/datatables/datatables.min.css') }}" rel="stylesheet">

<!-- Oculta el dataTables_length en pantallas sm y md -->
<style>
    @media (max-width: 767px) {

        /* md breakpoint is 768px */
        .dt-length {
            display: none;
        }
    }
</style>
@endsection

@section('pretitle')
Usuarios
@endsection

@section('title')
Historial de cambios
@endsection

@section('content')
<div class="card" style="width: 100%; overflow: visible;">
    <div class="card-body">
        <table id="user_histories_index_table" class="display table table-bordered">
            <thead>
                <tr style="background-color: #224488;">
                    <th>Fecha</th>
                    <th>Registro</th>
                    <th>Información de registro</th>
                    <th>Usuario</th>
                </tr>
            </thead>
            <tbody style="font-size: clamp(0.6rem, 3vw, 0.7rem) !important">
                @foreach ($user_histories as $user_history)
                <tr>
                    <td>{{ $user_history->created_at }}</td>
                    <td>
                        @if($user_history->history_change_type == 1)
                        <span class="badge bg-success">CREACIÓN</span>
                        @elseif($user_history->history_change_type == 2)
                        <span class="badge bg-primary">ACTUALIZACIÓN</span>
                        @elseif($user_history->history_change_type == 0)
                        <span class="badge bg-danger">ELIMINACIÓN</span>
                        @else
                        <span class="badge bg-dark">ERROR</span>
                        @endif
                    </td>
                    <td>{{ $user_history->history_change }}</td>
                    <td>{{ $user_history->user_name }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')

<!-- JQuery -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>

<!-- Datatable -->
<script src="{{ asset('vendor/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('customjs/datatables/dt_user_histories.js') }}"></script>

@endsection