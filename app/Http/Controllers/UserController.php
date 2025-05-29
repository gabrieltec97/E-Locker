<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $check = DB::table('users')
            ->where('email', $request->email)
            ->count();

        if ($check != 0){
            return redirect()->back()->with('msg-error', 'E-mail já em uso no sistema!');
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->profile = $request->profile;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->back()->with('msg-success', 'Usuário cadastrado com sucesso!');
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
        //Verificação para e-mail utilizado.
        $check = DB::table('users')
            ->select('id')
            ->where('email', $request->email)
            ->get();

        if (count($check) != 0){
            if ($check[0]->id != $id){
                return redirect()->back()->with('msg-error', 'E-mail já em uso no sistema!');
            }
        }

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->profile = $request->profile;
        if ($request->password != null){
            $user->password = bcrypt($request->password);
        }

        $user->save();
        return redirect()->route('usuarios.index')->with('msg-success', 'Alterações salvas com sucesso!');
    }

    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->back()->with('msg-success', 'Usuário deletado com sucesso!');
    }
}
