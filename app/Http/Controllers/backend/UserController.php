<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index() {
        $currentUser = Auth::id();
        $users = User::get();
        return view('backend.user.index',compact('users','currentUser'));
    }

    public function create(){
        $user = new User();
        return view('backend.user.create',compact('user'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Rules\Password::defaults()],
            'rol' => ['required'],
        ]);
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol'=> $request->rol
        ]);
        return redirect()->route('user.index')->with('status', 'Usuario añadido');
    }

    
    public function edit(User $user)
    {
        $currentUser = Auth::id();
        return view('backend.user.edit',compact('user','currentUser'));
    }


    public function update(Request $request, User $user)
    {        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', Rules\Password::defaults()],
            'rol' => ['required'],
        ]);
        
        $user->update([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'rol'=> $request->rol
        ]);
        return redirect()->route('user.index')->with('status', 'Usuario actualizado');
    }


    public function destroy(User $user){
        $user->delete();
        return redirect()->route('user.index')->with('status', 'Usuario borrado');
    }
}
