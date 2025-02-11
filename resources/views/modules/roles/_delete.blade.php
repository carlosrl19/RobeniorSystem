<div class="modal fade" id="delete_role{{ $role->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white fw-bold">
                <p class="modal-title" id="staticBackdropLabel">Eliminar role</p>
            </div>
            <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            Está a punto de realizar una acción irreversible. ¿Realmente desea eliminar el role <strong style="text-transform: uppercase">{{ $role->name }}</strong>?
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" data-bs-dismiss="modal" class="btn btn-sm btn-dark">
                        {{ __('Regresar') }}
                    </a>
                    <button type="submit" class="btn btn-sm btn-danger text-white">
                        {{ __('Eliminar') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>