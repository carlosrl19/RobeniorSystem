<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Http\Requests\Roles\StoreRequest;
use App\Http\Requests\Roles\UpdateRequest;

class RolesController extends Controller
{
    public function index()
    {
        $roles = Role::get();
        $permissions = Permission::get();

        return view('modules.roles.index', compact(
            'roles',
            'permissions',
        ));
    }

    public function store(StoreRequest $request)
    {
        // Crear el nuevo rol
        $role = Role::create([
            'name' => $request->name,
            'role_description' => $request->role_description,
            'guard_name' => 'web'
        ]);

        // Asignar permisos al rol si se han seleccionado
        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        return redirect()->route('roles.index')->with('success', 'Registro creado exitosamente.');
    }

    public function update(UpdateRequest $request, Role $role)
    {
        $role->name = $request->input('name');
        $role->role_description = $request->input('role_description');

        // Sincronizar permisos con el rol
        if ($request->has('permissions')) {
            // Asignar los permisos seleccionados al rol
            $role->syncPermissions($request->permissions);
        } else {
            // Si no se seleccionan permisos, eliminar todos los permisos asociados al rol
            $role->syncPermissions([]);
        }

        // Guardar cambios
        $role->save();

        return redirect()->route('roles.index')->with('success', 'Registro actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Registro eliminado exitosamente.');
    }
}
