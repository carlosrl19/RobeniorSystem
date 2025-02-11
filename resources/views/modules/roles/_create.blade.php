<div class="modal fade" id="modal-create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border: 2px solid #52524E">
            <div class="modal-header">
                <h5 class="modal-title">Agregar nuevo role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('roles.store') }}" novalidate>
                    @csrf
                    <div class="mb-3 align-items-end">
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" oninput="this.value = this.value.toLowerCase().replace(/[^a-z_]/g, '')" maxlength="55" name="name" value="{{ old('name') }}" id="name" class="input-form form-control @error('name') is-invalid @enderror" autocomplete="off" />
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <label for="name">Nombre role <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <div class="form-floating">
                                <textarea class="form-control @error('role_description') is-invalid @enderror" autocomplete="off" maxlength="255"
                                    name="role_description" id="role_description" style="resize: none; height: 100px;">{{ old('role_description') }}</textarea>
                                @error('role_description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <label for="role_description">Descripción role <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <select class="tom-select" id="permissions" name="permissions[]" multiple>
                                <option value="" selected disabled>Seleccione el permiso a entregar</option>
                                @foreach($permissions as $permission)
                                <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                @endforeach
                                </optgroup>
                            </select>
                            @error('permissions')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
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