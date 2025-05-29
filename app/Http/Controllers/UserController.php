<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('Users.users-management', [
            'users' => $users
        ]);
    }

    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->profile = $request->profile;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->back();
    }

    public function show(string $id)
    {
        $user = User::find($id);
        return view('Users.user-edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->profile = $request->profile;
        if ($request->password != null){
            $user->password = bcrypt($request->password);
        }

        $user->save();
        return redirect()->route('usuarios.index');
    }

    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->back();
    }
}
