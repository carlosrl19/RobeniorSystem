<div class="modal fade" id="product_create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content" style="border: 2px solid #52524E">
            <div class="modal-header border-success-top">
                <h5 class="modal-title">Nuevo producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" novalidate autocomplete="off" spellcheck="false">
                    @csrf
                    <input type="hidden" name="product_code" id="product_code" value="0"> <!-- Controller make this work -->
                    <input type="hidden" name="product_reviewed_by" id="product_reviewed_by" value="{{ Auth::user()->name }}">

                    <!-- Carousel sm displays -->
                    <div class="row d-sm-block d-md-block d-lg-none d-xl-none">
                        <div class="col-sm-12 col-md-12 mb-3">
                            <div id="carousel-controls" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner" id="carousel-sm-product-creation-images">
                                    <div class="carousel-item active">
                                        <img class="d-block" alt="" src="{{ asset('static/no_image_available.png') }}" style="margin: auto; min-height: 100px; max-height: 100px">
                                    </div>
                                </div>

                                <a class="carousel-control-prev" href="#carousel-controls" role="button" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Anterior</span>
                                </a>
                                <a class="carousel-control-next" href="#carousel-controls" role="button" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Siguiente</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12 ">
                            <div class="row mb-3 align-items-end">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <input type="file" multiple accept="image/*,.jpeg,.png,.jpg,.gif,.heic,.jfif" capture="camera"
                                        class="clamp_text form-control @error('product_image') is-invalid @enderror"
                                        id="product_image" name="product_image[]"
                                        onchange="carouselProductCreateViewer(event); carouselSMProductCreateViewer(event);">
                                    @error('product_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3 align-items-end">
                                <div class="col">
                                    <select class="clamp_text form-select tom-select" id="product_status" name="product_status">
                                        <option value="" selected disabled>Seleccione el estado del producto</option>
                                        <option value="1">PRODUCTO NUEVO</option>
                                        <option value="0">PRODUCTO MALO</option>
                                        <option value="2">PRODUCTO SEMINUEVO</option>
                                        <option value="3">PRODUCTO USADO</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <select class="clamp_text form-select tom-select" id="category_id" name="category_id">
                                        <option value="" selected disabled>Seleccione la categoría del producto</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>                                        
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3 align-items-end">
                                <div class="col">
                                    <div class="form-floating">
                                        <input type="text" maxlength="55" name="product_name" oninput="this.value = this.value.toUpperCase().replace(/[^A-ZÑ0-9\s]/g, '')" value="{{ old('product_name') }}" id="product_name" class="clamp_text form-control @error('product_name') is-invalid @enderror" />
                                        @error('product_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <label for="product_name">Nombre producto <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3 align-items-end">
                                <div class="col-lg-6 col-md-12 col-sm-12 mb-lg-0 mb-md-3 mb-sm-3 mb-3">
                                    <div class="form-floating">
                                        <input type="text" maxlength="20" name="product_brand" oninput="this.value = this.value.toUpperCase().replace(/[^A-ZÑ0-9\s]/g, '')" value="{{ old('product_brand') }}" id="product_brand" class="clamp_text form-control @error('product_brand') is-invalid @enderror" />
                                        @error('product_brand')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <label for="product_brand">Marca producto <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="form-floating">
                                        <input type="text" maxlength="20" name="product_model" oninput="this.value = this.value.toUpperCase().replace(/[^A-ZÑ0-9\s]/g, '')" value="{{ old('product_model') }}" id="product_model" class="clamp_text form-control @error('product_model') is-invalid @enderror" />
                                        @error('product_model')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <label for="product_name">Modelo producto</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3 align-items-end">
                                <div class="col">
                                    <div class="form-floating">
                                        <input type="number" step="any" name="product_price"
                                            value="{{ old('product_price') }}" id="product_price"
                                            class="clamp_text form-control @error('product_price') is-invalid @enderror" />
                                        @error('product_price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <label for="product_price">Precio <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-floating">
                                        <input type="number" step="1" name="product_stock"
                                            value="{{ old('product_stock') }}" id="product_stock"
                                            class="clamp_text form-control @error('product_stock') is-invalid @enderror" />
                                        @error('product_stock')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <label for="product_stock">Existencia actual <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3 align-items-end">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-floating">
                                        <input type="text" maxlength="20" name="product_nomenclature" oninput="this.value = this.value.toUpperCase().replace(/[^A-ZÑ0-9\s-]/g, '')" value="{{ old('product_nomenclature') }}" id="product_nomenclature" class="clamp_text form-control @error('product_nomenclature') is-invalid @enderror" />
                                        @error('product_nomenclature')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <label for="product_nomenclature">Nomenclatura producto <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Carrusel -->
                        <div class="col-lg-6 mb-3 d-none d-lg-block">
                            <div class="card" style="padding: 5px; min-height: 100%; max-height: 100%;">
                                <div class="card-header text-muted">
                                    Presentación del producto
                                </div>
                                <div class="card-body">
                                    <div id="carousel-controls" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner" id="carousel-product-images">
                                            <div class="carousel-item active">
                                                <img class="d-block w-100" alt="" src="{{ asset('static/no_image_available.png') }}" style="min-height: 100%; min-height: 275px; max-height: 275px">
                                            </div>
                                        </div>

                                        <a class="carousel-control-prev" href="#carousel-controls" role="button" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Anterior</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carousel-controls" role="button" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Siguiente</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal para vista previa ampliada -->
                        <div class="modal modal-blur fade" id="imagePreviewModal" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="imagePreviewLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="imagePreviewLabel">Vista previa del producto</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <img id="previewImage" src="" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3 align-items-end">
                            <div class="col-lg-6 col-md-12 col-sm-12 mb-lg-0 mb-md-3 mb-sm-3 mb-3">
                                <div class="form-floating">
                                    <textarea oninput="this.value = this.value.toUpperCase()" class="clamp_text form-control @error('product_description') is-invalid @enderror" maxlength="600"
                                        name="product_description" id="product_description" style="resize: none; height: 100px;">{{ old('product_description') }}</textarea>
                                    @error('product_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <label for="product_description">Descripción del producto</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="form-floating">
                                    <textarea oninput="this.value = this.value.toUpperCase()" class="clamp_text form-control @error('product_status_description') is-invalid @enderror" maxlength="600"
                                        name="product_status_description" id="product_status_description" style="resize: none; height: 100px;">{{ old('product_status_description') }}</textarea>
                                    @error('product_status_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <label for="product_status_description">Descripción del estado del producto <span class="text-danger">*</span></label>
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