<div class="modal fade" id="delete_category{{ $category->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white fw-bold">
                <p class="modal-title" id="staticBackdropLabel">Eliminar categoría</p>
            </div>
            <form action="{{ route('categories.destroy', $category->id) }}"
                method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            Está a punto de realizar una acción irreversible. ¿Realmente desea eliminar la categoría <strong style="text-transform: uppercase">{{ $category->category_name }}</strong>?
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