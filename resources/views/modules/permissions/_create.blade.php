<div class="modal fade" id="modal-create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border: 2px solid #52524E">
            <div class="modal-header">
                <h5 class="modal-title">Agregar nuevo permiso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('permissions.store') }}" novalidate>
                    @csrf
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" oninput="this.value = this.value.toLowerCase().replace(/[^a-z_]/g, '')" maxlength="55" name="name" value="{{ old('name') }}" id="name" class="input-form form-control @error('name') is-invalid @enderror" autocomplete="off" />
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <label for="name">Nombre permiso <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <div class="form-floating">
                                <textarea class="form-control @error('permission_description') is-invalid @enderror" autocomplete="off" maxlength="255"
                                    name="permission_description" id="permission_description" style="resize: none; height: 100px;">{{ old('permission_description') }}</textarea>
                                @error('permission_description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <label for="permission_description">Descripción permiso <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row align-items-end">
                        <div class="col">
                            <button type="button" class="btn btn-sm btn-dark me-auto clamp_text_md" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-sm btn-teal clamp_text_md">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>