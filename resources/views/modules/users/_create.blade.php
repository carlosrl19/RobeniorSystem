<div class="modal fade" id="user_create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border: 2px solid #52524E">
            <div class="modal-header border-success-top">
                <h5 class="modal-title">Nuevo usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('users.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <div style="display: flex; justify-content: center; align-items: center; min-height: 20vh;">
                                <img id="profilePhoto" class="img-fluid rounded-circle" alt="" src="{{ asset('/images/users/672a7465799bf.jpg') }}" style="width: 160px; height: 160px; object-fit: cover;">
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <div class="form-floating">
                                <input style="font-size: clamp(0.4rem, 3vw, 0.6rem);" type="file" accept="image/*"
                                    class="form-control @error('profile_photo') is-invalid @enderror"
                                    id="profile_photo" name="profile_photo" alt="Profile photo"
                                    onchange="carouselProfileViewer(event)">
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
                                <input type="text" maxlength="55" name="name" value="{{ old('name') }}" id="name" class="input-form form-control @error('name') is-invalid @enderror" autocomplete="off" />
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <label for="name">Nombre usuario <span class="text-danger">*</span></label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <input type="email" oninput="this.value = this.value.toLowerCase().replace(/[^a-z0-9_.@]/g, '')" maxlength="55" name="email" value="{{ old('email') }}" id="email" class="input-form form-control @error('email') is-invalid @enderror" autocomplete="off" />
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <label for="email">Email usuario <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <div class="form-floating">
                                <input type="password" name="password" value="{{ old('password') }}" id="password" class="input-form form-control @error('password') is-invalid @enderror" autocomplete="off" />
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <label for="password">Contraseña <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>

                    <!-- Selección de Roles -->
                    <div class="row mb-3 align-items-end">
                        <div class="col">
                            <div class="form-floating">
                                <div class="mb-3">
                                    <select class="form-select tom-select" id="role" name="role">
                                        <option value="" selected disabled>Seleccione el rol del usuario</option>
                                        @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
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
            </div>
        </div>
    </div>
</div>