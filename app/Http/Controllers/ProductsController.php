<?php

namespace App\Http\Controllers;

use App\Http\Requests\Products\StoreRequest;
use App\Http\Requests\Products\UpdateRequest;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Products::all();
        return view("modules.products.index", compact("products"));
    }

    public function store(StoreRequest $request)
    {
        $product_code = strtoupper(Str::random(10));

        DB::beginTransaction();

        try {

            // Procesar y guardar las imágenes
            $imageNames = [];
            if ($request->hasFile('product_image')) {
                $images = $request->file('product_image');
                foreach ($images as $image) {
                    $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('uploads/products'), $imageName);
                    $imageNames[] = $imageName;
                }
            }

            // Convierte el array de nombres de imágenes a JSON
            $productImg = !empty($imageNames) ? json_encode($imageNames) : null;

            // Crea el producto
            Products::create([
                'product_code' => $product_code,
                'product_nomenclature' => $request->input('product_nomenclature'),
                'product_name' => $request->input('product_name'),
                'product_brand' => $request->input('product_brand'),
                'product_model' => $request->input('product_model'),
                'product_status' => $request->input('product_status'),
                'product_stock' => $request->input('product_stock'),
                'product_price' => $request->input('product_price'),
                'product_description' => $request->input('product_description'),
                'product_status_description' => $request->input('product_status_description'),
                'product_image' => $productImg,
                'product_reviewed_by' => Auth::user()->name,
            ]);

            DB::commit();

            return redirect()->route('products.index')->with('success', 'Registro creado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function update(UpdateRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            // Buscar el producto por su ID
            $product = Products::findOrFail($id);

            // Procesar las imágenes
            $imageNames = json_decode($product->product_image, true) ?? []; // Obtener imágenes actuales

            if ($request->hasFile('product_image')) {
                // Si se suben nuevas imágenes, procesarlas
                foreach ($request->file('product_image') as $image) {
                    if ($image->isValid()) {
                        $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
                        $image->move(public_path('uploads/products'), $imageName);
                        $imageNames[] = $imageName;
                    }
                }
            }

            // Actualizar los datos del producto
            $product->update([
                'product_nomenclature' => $request->input('product_nomenclature'),
                'product_name' => $request->input('product_name'),
                'product_brand' => $request->input('product_brand'),
                'product_model' => $request->input('product_model'),
                'product_status' => $request->input('product_status'),
                'product_stock' => $request->input('product_stock'),
                'product_price' => $request->input('product_price'),
                'product_description' => $request->input('product_description'),
                'product_status_description' => $request->input('product_status_description'),
                'product_image' => !empty($imageNames) ? json_encode($imageNames) : null,
                'product_reviewed_by' => Auth::user()->name,
            ]);

            DB::commit();

            return redirect()->route('products.index')->with('success', 'Registro actualizado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Error al actualizar el registro: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $products)
    {
        //
    }
}
