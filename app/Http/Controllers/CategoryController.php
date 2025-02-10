<?php

namespace App\Http\Controllers;

use App\Http\Requests\Categories\StoreRequest;
use App\Http\Requests\Categories\UpdateRequest;
use App\Models\Category;
use App\Models\UserHistory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view("modules.categories.index", compact("categories"));
    }


    public function store(StoreRequest $request)
    {
        $category = Category::create($request->all());
        $todayDate = Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d H:i:s');

        // Crear registro de cambios de usuario
        UserHistory::create([
            'user_name' => Auth::user()->name,
            'history_change_type' => 1,
            'history_change' => 'EL USUARIO ' . Auth::user()->name . ' CREO UNA NUEVA CATEGORIA LLAMADA ' . $request->input('product_name') . ' EN EL SISTEMA.',
            'created_at' => $todayDate,
            'updated_at' => $todayDate,
        ]);

        return redirect()->route("categories.index")->with("success", "Registro creado exitosamente.");
    }


    public function update(UpdateRequest $request, $id)
    {
        $category = Category::findOrFail($id);

        $userName = Auth::user()->name;
        $todayDate = Carbon::now()->setTimezone('America/Costa_Rica')->format('Y-m-d H:i:s');

        // Crear registro de cambios de usuario
        $category_old_name = $category->category_name;
        $category_old_description = $category->category_description;

        $category->update([
            'category_name' => $request->input('category_name'),
            'category_description' => $request->input('category_description'),
        ]);

        if ($category_old_name != $request->input('category_name')) {
            UserHistory::create([
                'user_name' => $userName,
                'history_change_type' => 2,
                'history_change' => "EL USUARIO {$userName} EDITÓ EL NOMBRE DE LA CATEGORIA " . $category_old_name . " A " . $request->input('category_name') . ".",
                'created_at' => $todayDate,
                'updated_at' => $todayDate,
            ]);
        }

        if ($category_old_description != $request->input('category_description')) {
            UserHistory::create([
                'user_name' => $userName,
                'history_change_type' => 2,
                'history_change' => "EL USUARIO {$userName} EDITÓ LA DESCRIPCIÓN DE LA CATEGORIA " . $category_old_description . " A " . $request->input('category_description') . ".",
                'created_at' => $todayDate,
                'updated_at' => $todayDate,
            ]);
        }

        $category->update();

        return redirect()->route("categories.index")->with("success", "Registro actualizado exitosamente.");
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route("categories.index")->with("success", "Registro eliminado exitosamente.");
    }
}
