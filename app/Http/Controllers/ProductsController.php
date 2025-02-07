<?php

namespace App\Http\Controllers;

use App\Http\Requests\Products\StoreRequest;
use App\Http\Requests\Products\UpdateRequest;
use App\Models\Products;
use App\Models\UserHistory;
use Carbon\Carbon;
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
        $todayDate = Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d H:i:s');

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
                'created_at' => $todayDate,
                'updated_at' => $todayDate,
            ]);

            // Crear registro de cambios de usuario
            UserHistory::create([
                'user_name' => Auth::user()->name,
                'history_change_type' => 1,
                'history_change' => 'EL USUARIO ' . Auth::user()->name . ' CREO UN NUEVO PRODUCTO LLAMADO' . $request->input('product_name') . ' EN EL SISTEMA.',
                'created_at' => $todayDate,
                'updated_at' => $todayDate,
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

            // Crear registro de cambios de usuario
            $product_old_name = $product->product_name;
            $product_old_nomenclature = $product->product_nomenclature;
            $product_old_brand = $product->product_brand;
            $product_old_model = $product->product_model;
            $product_old_status = $product->product_status;
            $product_old_stock = $product->product_stock;
            $product_old_price = $product->product_price;
            $product_old_description = $product->product_description;
            $product_old_status_description = $product->product_status_description;
            $product_old_image = $product->product_image;
            $product_old_reviewed_by = $product->product_reviewed_by;

            $userName = Auth::user()->name;
            $todayDate = Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d H:i:s');

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
                'created_at' => $todayDate,
                'updated_at' => $todayDate,
            ]);

            if ($product_old_name != $request->input('product_name')) {
                UserHistory::create([
                    'user_name' => $userName,
                    'history_change_type' => 2,
                    'history_change' => "EL USUARIO {$userName} EDITÓ EL NOMBRE DEL PRODUCTO " . $product_old_name . " A " . $request->input('product_name') . ".",
                    'created_at' => $todayDate,
                    'updated_at' => $todayDate,
                ]);
            }

            if ($product_old_nomenclature != $request->input('product_nomenclature')) {
                UserHistory::create([
                    'user_name' => $userName,
                    'history_change_type' => 2,
                    'history_change' => "EL USUARIO {$userName} EDITÓ LA NOMENCLATURA DEL PRODUCTO " . $product_old_nomenclature . " A " . $request->input('product_nomenclature') . ".",
                    'created_at' => $todayDate,
                    'updated_at' => $todayDate,
                ]);
            }

            if ($product_old_brand != $request->input('product_brand')) {
                UserHistory::create([
                    'user_name' => $userName,
                    'history_change_type' => 2,
                    'history_change' => "EL USUARIO {$userName} EDITÓ LA MARCA DEL PRODUCTO " . $product_old_brand . " A " . $request->input('product_brand') . ".",
                    'created_at' => $todayDate,
                    'updated_at' => $todayDate,
                ]);
            }

            if ($product_old_model != $request->input('product_model')) {
                UserHistory::create([
                    'user_name' => $userName,
                    'history_change_type' => 2,
                    'history_change' => "EL USUARIO {$userName} EDITÓ EL MODELO DEL PRODUCTO " . $product_old_model . " A " . $request->input('product_model') . ".",
                    'created_at' => $todayDate,
                    'updated_at' => $todayDate,
                ]);
            }

            if ($product_old_status != $request->input('product_status')) {

                $statusMap = [
                    0 => 'MALO',
                    1 => 'NUEVO',
                    2 => 'SEMINUEVO',
                    3 => 'USADO',
                ];

                $oldStatusString = $statusMap[$product_old_status] ?? 'Unknown'; // Use 'Unknown' as a default
                $newStatusString = $statusMap[$request->input('product_status')] ?? 'Unknown'; // Use 'Unknown' as a default

                UserHistory::create([
                    'user_name' => $userName,
                    'history_change_type' => 2,
                    'history_change' => "EL USUARIO {$userName} EDITÓ EL ESTADO DEL PRODUCTO DE " . $oldStatusString . " A " . $newStatusString . ".",
                    'created_at' => $todayDate,
                    'updated_at' => $todayDate,
                ]);
            }

            if ($product_old_stock != $request->input('product_stock')) {
                UserHistory::create([
                    'user_name' => $userName,
                    'history_change_type' => 2,
                    'history_change' => "EL USUARIO {$userName} EDITÓ EL STOCK DEL PRODUCTO " . $product_old_stock . " A " . $request->input('product_stock') . ".",
                    'created_at' => $todayDate,
                    'updated_at' => $todayDate,
                ]);
            }

            if ($product_old_price != $request->input('product_price')) {
                UserHistory::create([
                    'user_name' => $userName,
                    'history_change_type' => 2,
                    'history_change' => "EL USUARIO {$userName} EDITÓ EL PRECIO DEL PRODUCTO " . $product_old_price . " A " . $request->input('product_price') . ".",
                    'created_at' => $todayDate,
                    'updated_at' => $todayDate,
                ]);
            }

            if ($product_old_description != $request->input('product_description')) {
                UserHistory::create([
                    'user_name' => $userName,
                    'history_change_type' => 2,
                    'history_change' => "EL USUARIO {$userName} EDITÓ LA DESCRIPCIÓN DEL PRODUCTO.",
                    'created_at' => $todayDate,
                    'updated_at' => $todayDate,
                ]);
            }

            if ($product_old_status_description != $request->input('product_status_description')) {
                UserHistory::create([
                    'user_name' => $userName,
                    'history_change_type' => 2,
                    'history_change' => "EL USUARIO {$userName} EDITÓ LA DESCRIPCIÓN DEL ESTADO DEL PRODUCTO.",
                    'created_at' => $todayDate,
                    'updated_at' => $todayDate,
                ]);
            }

            if ($product_old_reviewed_by != $request->input('product_reviewed_by')) {
                UserHistory::create([
                    'user_name' => $userName,
                    'history_change_type' => 2,
                    'history_change' => "EL RESIVOR DEL PRODUCTO CAMBIO DE " . $product_old_reviewed_by . " A " . $request->input('product_reviewed_by') . ".",
                    'created_at' => $todayDate,
                    'updated_at' => $todayDate,
                ]);
            }

            DB::commit();

            return redirect()->route('products.index')->with('success', 'Registro actualizado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Error al actualizar el registro: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $product = Products::findOrFail($id);
            $userName = Auth::user()->name;
            $todayDate = Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d H:i:s');

            Products::destroy($id);

            UserHistory::create([
                'user_name' => $userName,
                'history_change_type' => 0,
                'history_change' => "EL USUARIO {$userName} ELIMINÓ EL PRODUCTO " . $product->product_name . ".",
                'created_at' => $todayDate,
                'updated_at' => $todayDate,
            ]);

            return redirect()->route('products.index')->with('success', 'Registro eliminado exitosamente.');
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1451) {
                return redirect()->route('products.index')->with('error', 'El producto no puede ser eliminado porque existen compras asociadas.');
            }
            return redirect()->route('products.index')->with('error', 'Acción no permitida.');
        }
    }
}
