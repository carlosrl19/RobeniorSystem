<div class="modal fade" id="product_update{{ $product->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content" style="border: 2px solid #52524E">
            <div class="modal-header border-warning-top">
                <h5 class="modal-title">Editar producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('products.update', ['product' => $product->id]) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="product_code" id="product_code" value="{{ $product->product_code }}">
                    <input type="hidden" name="product_reviewed_by" id="product_reviewed_by" value="{{ Auth::user()->name }}">

                    <div class="row">
                        <div class="col-6">
                            <div class="row mb-3 align-items-end">
                                <div class="col">
                                    <select class="clamp_text form-select tom-select" id="product_status" name="product_status">
                                        <option value="1" {{ (old('product_status') ?? $product->product_status) == '1' ? 'selected' : '' }}>PRODUCTO NUEVO</option>
                                        <option value="0" {{ (old('product_status') ?? $product->product_status) == '0' ? 'selected' : '' }}>PRODUCTO MALO</option>
                                        <option value="2" {{ (old('product_status') ?? $product->product_status) == '2' ? 'selected' : '' }}>PRODUCTO SEMINUEVO</option>
                                        <option value="3" {{ (old('product_status') ?? $product->product_status) == '3' ? 'selected' : '' }}>PRODUCTO USADO</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3 align-items-end">
                                <div class="col">
                                    <div class="form-floating">
                                        <input type="text" maxlength="55" name="product_name" oninput="this.value = this.value.toUpperCase().replace(/[^A-ZÑ\s]/g, '')" value="{{ $product->product_name }}" id="product_name" class="clamp_text form-control @error('product_name') is-invalid @enderror" autocomplete="off" />
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
                                <div class="col">
                                    <div class="form-floating">
                                        <input type="text" maxlength="20" name="product_brand" oninput="this.value = this.value.toUpperCase().replace(/[^A-ZÑ\s]/g, '')" value="{{ $product->product_brand }}" id="product_brand" class="clamp_text form-control @error('product_brand') is-invalid @enderror" autocomplete="off" />
                                        @error('product_brand')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <label for="product_brand">Marca producto <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-floating">
                                        <input type="text" maxlength="20" name="product_model" oninput="this.value = this.value.toUpperCase().replace(/[^A-ZÑ\s]/g, '')" value="{{ $product->product_model }}" id="product_model" class="clamp_text form-control @error('product_model') is-invalid @enderror" autocomplete="off" />
                                        @error('product_model')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <label for="product_name">Modelo producto <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3 align-items-end">
                                <div class="col">
                                    <div class="form-floating">
                                        <input type="number" step="any" name="product_price"
                                            value="{{ $product->product_price }}" id="product_price"
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
                                            value="{{ $product->product_stock }}" id="product_stock"
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
                                <div class="col">
                                    <div class="form-floating">
                                        <textarea oninput="this.value = this.value.toUpperCase()" class="clamp_text form-control @error('product_description') is-invalid @enderror" autocomplete="off" maxlength="100"
                                            name="product_description" id="product_description" style="resize: none; height: 100px;">{{ $product->product_description }}</textarea>
                                        @error('product_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <label for="product_description">Descripción del producto</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Carrusel -->
                        <div class="col-6 mb-3">
                            <div class="card" style="padding: 5px; min-height: 100%; max-height: 100%;">
                                <div class="card-header text-muted text-center">
                                    Presentación del producto
                                </div>
                                <div class="card-body">
                                    <div id="carousel-controls" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner" id="carousel-product-update-images">
                                            @foreach (json_decode($product->product_image) as $index => $image)
                                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                <a class="product_image" data-gall="product_gallery" title="Producto #{{ $product->product_code }} - {{ $product->product_nomenclature }}" data-fitview="true" href="uploads/products/{{ $image }}">
                                                    <img id="image-preview" style="border: 1px solid #e3e3e3; border-radius: 5px; width: 100%; height: 275px;" src="uploads/products/{{ $image }}" alt="Imagen del producto">
                                                </a>
                                            </div>
                                            @endforeach
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
                        <div class="modal modal-blur fade" id="imagePreviewUpdateModal" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="imagePreviewUpdateLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="imagePreviewUpdateLabel">Vista previa del producto</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <img id="previewUpdateImage" src="" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3 align-items-end">
                            <div class="col">
                                <div class="form-floating">
                                    <textarea oninput="this.value = this.value.toUpperCase()" class="clamp_text form-control @error('product_status_description') is-invalid @enderror" autocomplete="off" maxlength="255"
                                        name="product_status_description" id="product_status_description" style="resize: none; height: 100px;">{{ $product->product_status_description }}</textarea>
                                    @error('product_status_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <label for="product_status_description">Descripción del estado del producto <span class="text-danger">*</span></label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3 align-items-end">
                            <div class="col-5">
                                <div class="form-floating">
                                    <input type="text" maxlength="5" name="product_nomenclature" oninput="this.value = this.value.toUpperCase().replace(/[^A-ZÑ\s]/g, '')" value="{{ $product->product_nomenclature }}" id="product_nomenclature" class="clamp_text form-control @error('product_nomenclature') is-invalid @enderror" autocomplete="off" />
                                    @error('product_nomenclature')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <label for="product_nomenclature">Nomenclatura producto <span class="text-danger">*</span></label>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-floating">
                                    <input multiple type="file" accept="image/*"
                                        class="clamp_text form-control @error('product_image') is-invalid @enderror"
                                        id="product_image" name="product_image[]"
                                        onchange="carouselProductUpdateViewer(event)">
                                    @error('product_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <label for="product_image">Imágen(s) del producto <span class="text-danger">*</span></label>
                                </div>
                            </div>
                        </div>

                        <div class="row align-items-end">
                            <div class="col">
                                <button type="button" class="btn btn-sm btn-dark me-auto clamp_text_md" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-sm btn-yellow clamp_text_md">Guardar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>