@php
$products_it_counter = App\Models\Products::where('category_id', 1)->count();
$products_tools_counter = App\Models\Products::where('category_id', 2)->count();
$products_fornitures_counter = App\Models\Products::where('category_id', 3)->count();
@endphp
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active bg-white clamp_text" id="products-tab" data-bs-toggle="tab" data-bs-target="#products-tab-content" type="button" role="tab" aria-controls="products-tab-content" aria-selected="true">
            Productos Informática ({{ $products_it_counter }})
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link bg-white clamp_text" id="tools-tab" data-bs-toggle="tab" data-bs-target="#tools-tab-content" type="button" role="tab" aria-controls="tools-tab-content" aria-selected="false">
            Herramientas ({{ $products_tools_counter }})
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link bg-white clamp_text" id="forniture-tab" data-bs-toggle="tab" data-bs-target="#forniture-tab-content" type="button" role="tab" aria-controls="forniture-tab-content" aria-selected="false">
            Mobiliario y equipo ({{ $products_fornitures_counter }})
        </button>
    </li>
</ul>

<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="products-tab-content" role="tabpanel" aria-labelledby="products-tab">
        <!-- Products table -->
        @include('modules.products.tabs._products_table')
    </div>

    <div class="tab-pane fade show" id="tools-tab-content" role="tabpanel" aria-labelledby="tools-tab">
        <!-- Tools table -->
        @include('modules.products.tabs._tools_table')
    </div>

    <div class="tab-pane fade show" id="forniture-tab-content" role="tabpanel" aria-labelledby="tools-tab">
        <!-- Forniture table -->
        @include('modules.products.tabs._forniture_table')
    </div>
</div>