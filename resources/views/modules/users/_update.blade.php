<div class="modal fade" id="user_update{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border: 2px solid #52524E">
            <div class="modal-header">
                <h5 class="modal-title">Editar usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('users.update', ['user' => $user->id]) }}" novalidate enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <!-- Visualizador de imagen -->
                            <div class="text-center">
                                <img id="profilePhotoPreview" src="uploads/users/{{ $user->profile_photo }}" alt="Profile Photo" class="img-fluid rounded-circle mb-2" style="width: 150px; height: 150px; object-fit: cover;">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <!-- Input file para cargar la imagen -->
                            <div class="form-floating">
                                <input type="file" name="profile_photo" id="profile_photo_{{ $user->id }}" class="input-form form-control @error('profile_photo') is-invalid @enderror" accept="image/*" onchange="previewImage(event)">
                                @error('profile_photo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <label for="profile_photo">Foto de perfil</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" maxlength="55" value="{{ $user->name }}" name="name" id="name_{{ $user->id }}" class="input-form form-control @error('name') is-invalid @enderror" placeholder="Ingrese el nombre del comisionista" autocomplete="off" />
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <label for="name_{{ $user->id }}">Nombre usuario <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="email" maxlength="55" value="{{ $user->email }}" name="email" id="email_{{ $user->id }}" class="input-form form-control @error('email') is-invalid @enderror" placeholder="Ingrese el email del usuario" autocomplete="off" />
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <label for="email_{{ $user->id }}">Email del usuario <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <div class="form-floating">
                                <input type="password" name="password" value="" id="password_{{ $user->id }}" class="input-form form-control @error('password') is-invalid @enderror" placeholder="Ingrese la nueva contraseña (dejar vacío para no cambiar)" autocomplete="off" />
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <label for="password_{{ $user->id }}">Contraseña (vacía si no se quiere cambiar)</label>
                            </div>
                        </div>
                    </div>

                    <!-- Selección de Roles -->
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <small class="clamp_text_sm text-muted">Rol actual: {{ implode(', ', $user->getRoleNames()->toArray()) }}</small>
                            <div class="form-floating">
                                <div class="mb-3">
                                    <select class="form-select tom-select" id="role" name="role">
                                        <option value="" selected disabled>Seleccione el rol del usuario</option>
                                        @foreach($roles as $role)
                                        <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                                        @endforeach
                                        </optgroup>
                                    </select>
                                    @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-form btn-dark me-auto" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-form btn-teal">Guardar</button>
                </form>

                <script>
                    function previewImage(event) {
                        const reader = new FileReader();
                        reader.onload = function() {
                            const output = document.getElementById('profilePhotoPreview');
                            output.src = reader.result;
                        }
                        reader.readAsDataURL(event.target.files[0]);
                    }
                </script>
            </div>
        </div>
    </div>
</div>