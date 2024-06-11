<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function showProfile(Request $request)
    {
        // Obtener el usuario actualmente autenticado
        $user = Auth::user();
        // Pasar el objeto $user a la vista
        return view('profile', ['user' => $user]);
    }
    public function update(Request $request)
    {
        $user = Auth::user();
        // Validar los campos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:6', // Puedes ajustar las reglas según tus necesidades
            'phone_number' => 'required|string|size:9',
            // Agrega más reglas de validación según sea necesario
        ]);

        // Si la contraseña se ha actualizado, cifrarla antes de actualizarla
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Actualizar otros campos del usuario
        $user->update($request->except('password'));

        return redirect()->back()->with('update', 'Profile updated successfully');
    }
}
