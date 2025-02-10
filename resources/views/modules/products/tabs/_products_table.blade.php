@php
$products_it = App\Models\Products::where('category_id', 1)->get();
@endphp
<div class="card" style="width: 100%">
    <div class="card-body">
        <table id="products_index_table" class="display table table-bordered">
            <thead>
                <tr style="background-color: #224488;">
                    <th>Código</th>
                    <th>Presentación</th>
                    <th>Nombre</th>
                    <th>Nomenclatura</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Stock</th>
                    <th>Estado</th>
                    <th>Precio</th>
                    <th>Tecnico</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody style="font-size: clamp(0.6rem, 3vw, 0.7rem) !important">
                @foreach ($products_it as $product)
                <tr>
                    <td>#{{ $product->product_code }}</td>
                    <td>
                        @if ($product->product_image)
                        <div class="d-flex flex-wrap justify-content-center">
                            @foreach (json_decode($product->product_image) as $image)
                            <div class="mx-1">
                                <a class="product_image" data-gall="product_gallery" title="Producto #{{ $product->product_code }} - {{ $product->product_nomenclature }}" data-fitview="true" href="uploads/products/{{ $image }}">
                                    <img id="image-preview" style="border: 1px solid #e3e3e3; border-radius: 5px; min-height: 30px; max-height: 25px;" src="uploads/products/{{ $image }}" alt="&nbsp;payment-img" width="30" height="30">
                                </a>
                            </div>
                            @endforeach
                        </div>
                        @else
                        N/D
                        @endif
                    </td>
                    <td>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#product_update{{ $product->id }}">
                            {{ $product->product_name }}
                        </a>
                    </td>
                    <td>
                        <span class="badge bg-dark">{{ $product->product_nomenclature }}</span>
                    </td>
                    <td>{{ $product->product_brand }}</td>
                    <td>{{ $product->product_model }}</td>
                    <td>{{ $product->product_stock }}</td>
                    <td>
                        @if($product->product_status == 0)
                        <span class="badge bg-danger">
                            Malo
                        </span>
                        @elseif($product->product_status == 1)
                        <span class="badge bg-success">Nuevo</span>
                        @elseif($product->product_status == 2)
                        <span class="badge bg-warning">Seminuevo</span>
                        @elseif($product->product_status == 3)
                        <span class="badge bg-secondary">Usado</span>
                        @endif
                    </td>
                    <td>L. {{ number_format($product->product_price,2) }}</td>
                    <td>{{ $product->product_reviewed_by }}</td>
                    <td>
                        <a href="#" class="text-danger" data-bs-toggle="modal" data-bs-target="#delete_product{{ $product->id }}"><x-heroicon-o-trash class="w-3 h-3" /> Eliminar</a>
                    </td>
                </tr>

                <!-- Includes -->
                @include('modules.products._update')
                @include('modules.products._delete')

                @endforeach
            </tbody>
        </table>
    </div>
</div>