<div class="modal fade" id="update_permission{{ $permission->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border: 2px solid #52524E">
            <div class="modal-header border-warning-top">
                <h5 class="modal-title">Editar permiso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('permissions.update', ['permission' => $permission->id]) }}" novalidate autocomplete="off" spellcheck="false">
                    @method('PUT')
                    @csrf
                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" oninput="this.value = this.value.toLowerCase().replace(/[^a-z_]/g, '')" maxlength="55" name="name" value="{{ $permission->name }}" id="name" class="input-form form-control @error('name') is-invalid @enderror" />
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <label for="name">Nombre permiso <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-floating">
                                <textarea class="form-control @error('permission_description') is-invalid @enderror" maxlength="255"
                                    name="permission_description" id="permission_description" style="resize: none; height: 100px;">{{ $permission->permission_description }}</textarea>
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
                            <button type="submit" class="btn btn-sm btn-yellow clamp_text_md">Guardar</button>
                            <button type="button" class="btn btn-sm btn-danger me-auto clamp_text_md" style="float: right" data-bs-toggle="modal" data-bs-target="#delete_permission{{ $permission->id }}">Eliminar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>