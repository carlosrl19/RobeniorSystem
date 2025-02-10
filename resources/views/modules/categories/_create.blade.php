<div class="modal fade" id="product_create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border: 2px solid #52524E">
            <div class="modal-header border-success-top">
                <h5 class="modal-title">Nueva categoría</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('categories.store') }}" method="POST" novalidate autocomplete="off" spellcheck="false">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                            <div class="row mb-3 align-items-end">
                                <div class="col">
                                    <div class="form-floating">
                                        <input type="text" maxlength="55" name="category_name" oninput="this.value = this.value.toUpperCase().replace(/[^A-ZÑ\s]/g, '')" value="{{ old('category_name') }}" id="category_name" class="clamp_text form-control @error('category_name') is-invalid @enderror" />
                                        @error('category_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <label for="category_name">Nombre categoría <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3 align-items-end">
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-lg-0 mb-md-3 mb-sm-3 mb-3">
                                <div class="form-floating">
                                    <textarea oninput="this.value = this.value.toUpperCase()" class="clamp_text form-control @error('category_description') is-invalid @enderror" maxlength="600"
                                        name="category_description" id="category_description" style="resize: none; height: 100px;">{{ old('category_description') }}</textarea>
                                    @error('category_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <label for="category_description">Descripción de categoría</label>
                                </div>
                            </div>
                        </div>

                        <div class="row align-items-end">
                            <div class="col">
                                <button type="button" class="btn btn-sm btn-dark me-auto clamp_text_md" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-sm btn-teal clamp_text_md">Guardar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>