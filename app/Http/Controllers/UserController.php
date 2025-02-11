<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\Users\StoreRequest;
use App\Http\Requests\Users\UpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $roles = Role::get();
        return view("modules.users.index", compact("users", "roles"));
    }

    public function store(StoreRequest $request)
    {
        // dd($request->all());

        DB::beginTransaction();

        try {
            // Procesar y guardar la imagen
            $imageName = null; // Inicializar como null
            if ($request->hasFile('profile_photo')) {
                $image = $request->file('profile_photo');
                $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/uploads/users'), $imageName);
            }

            // Guardar el nombre de la imagen directamente
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'profile_photo' => $imageName, // Almacenar solo el nombre del archivo
                'password' => bcrypt($request->password),
            ]);

            // Asignar el rol al usuario
            $user->assignRole($request->role);

            DB::commit();

            return redirect()->route('users.index')->with('success', 'Registro creado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function update(UpdateRequest $request, User $user)
    {
        DB::beginTransaction();

        try {
            // Verificar si se ha subido una nueva imagen
            if ($request->hasFile('profile_photo')) {
                // Si hay una imagen anterior, eliminarla
                if ($user->profile_photo) {
                    $previousImagePath = public_path('images/uploads/users' . $user->profile_photo);
                    if (file_exists($previousImagePath)) {
                        unlink($previousImagePath); // Eliminar la imagen anterior
                    }
                }

                // Procesar y guardar la nueva imagen
                $image = $request->file('profile_photo');
                $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/uploads/users'), $imageName);

                // Actualizar el nombre de la imagen en el usuario
                $user->profile_photo = $imageName;
            }

            // Actualizar otros campos del usuario según sea necesario
            $user->name = $request->name;
            $user->email = $request->email;

            // Solo actualizar la contraseña si se proporciona una nueva
            if ($request->filled('password')) {
                $user->password = bcrypt($request->password);
            }

            // Asignar el nuevo rol al usuario
            // Primero, eliminar roles existentes (si es necesario)
            $user->syncRoles([$request->role]);

            // Guardar los cambios
            $user->save();

            DB::commit();

            return redirect()->route('users.index')->with('success', 'Registro actualizado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function destroy($id)
    {
        $userToDelete = User::findOrFail($id);
        $currentUser = Auth::user();

        // Verificar si el usuario a eliminar es el mismo que el usuario autenticado
        if ($userToDelete->id === $currentUser->id) {
            return redirect()->back()->withErrors(['error' => 'No puede eliminar su propio usuario.']);
        }

        // Proceder con la eliminación
        $userToDelete->delete();
        return redirect()->route('users.index')->with('success', 'Registro eliminado correctamente.');
    }
}
