<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Project;
use App\Models\Investor;
use App\Models\CommissionAgent;
use App\Models\PaymentCommissioner;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Permissions\StoreRequest;
use App\Http\Requests\Permissions\UpdateRequest;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    public function index()
    {
        $permissions = Permission::get();

        return view('modules.permissions.index', compact(
            'permissions',
        ));
    }

    public function store(StoreRequest $request)
    {
        // Crear el permiso
        $user = Permission::create([
            'name' => $request->name,
            'permission_description' => $request->permission_description,
            'guard_name' => "web",
        ]);

        return redirect()->route('permissions.index')->with('success', 'Registro creado exitosamente.');
    }

    public function update(UpdateRequest $request, Permission $permission)
    {
        $permission->update($request->all());
        return redirect()->route("permissions.index")->with("success", "Registro actualizado exitosamente.");
    }

    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();

        return redirect()->route('permissions.index')->with('success', 'Registro eliminado exitosamente.');
    }
}
