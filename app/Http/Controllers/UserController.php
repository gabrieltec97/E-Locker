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

    public function checkEmail(Request $request)
    {
        $email = $request->email;
        $exists = User::where('email', $email)->exists();

        return response()->json(['exists' => $exists]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'secondName' => 'required',
            'email' => 'required',
            'password' => 'required',
            'profile' => 'required',
        ], [
            'name.required' => 'Usuário não cadastrado. O nome do usuário é obrigatório.',
            'secondName.required' => 'Usuário não cadastrado. O sobrenome do usuário é obrigatório.',
            'email.required' => 'Usuário não cadastrado. O e-mail do usuário é obrigatório.',
            'password.required' => 'Usuário não cadastrado. A senha do usuário é obrigatória',
            'profile.required' => 'Usuário não cadastrado. É necessário escolher um perfil para o usuário',
        ]);

        $check = DB::table('users')
            ->where('email', $request->email)
            ->count();

        if ($check != 0){
            return redirect()->back()->with('msg-error', 'E-mail já em uso no sistema!');
        }

        $user = new User();
        $user->name = $request->name;
        $user->surname = $request->secondName;
        $user->email = $request->email;

        if ($request->profile == 'Administrador'){
            $user->profile = $request->profile;
            $user->assignRole('Administrador');
        }else{
            $user->profile = $request->profile;
            $user->assignRole('Operador');
        }

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
        $request->validate([
            'name' => 'required',
            'secondName' => 'required',
            'email' => 'required',
            'profile' => 'required',
        ], [
            'name.required' => 'Usuário não cadastrado. O nome do usuário é obrigatório.',
            'secondName.required' => 'Usuário não cadastrado. O sobrenome do usuário é obrigatório.',
            'email.required' => 'Usuário não cadastrado. O e-mail do usuário é obrigatório.',
            'profile.required' => 'Usuário não cadastrado. É necessário escolher um perfil para o usuário',
        ]);

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
        $user->surname = $request->secondName;
        $user->email = $request->email;

        if ($request->profile == 'Administrador'){
            $user->profile = $request->profile;
            $user->assignRole('Administrador');
        }else{
            $user->profile = $request->profile;
            $user->assignRole('Operador');
        }

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
