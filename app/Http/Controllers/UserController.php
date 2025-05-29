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

    public function edit(string $id)
    {
        echo $id;
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        echo $id;
    }
}
