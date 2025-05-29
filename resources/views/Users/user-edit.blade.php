@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

@section('title', 'Blocos e Unidades - Gerenciamento completo de unidades.')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="row">

                            <!-- Coluna do título -->
                            <div class="col-md-6 col-12">
                                <h5 class="mb-0">{{ $user->name }}</h5>
                                <p class="text-sm mb-0">
                                    <span class="font-weight-bold">Informações</span> do usuário
                                </p>
                            </div>

                            <!-- Coluna dos botões -->
                            <div class="col-md-6 col-12 d-flex justify-content-end gap-2 mt-2 mt-md-0">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#new-block" id="save">
                                    <i class="fa-solid fa-circle-check icon-format"></i>
                                    Salvar alterações
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-2">
                        <div class="container">
                            <form action="{{ route('usuarios.update', $user->id) }}" method="post" id="user-edit">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <span class="font-weight-bold modal-label">Nome:</span>
                                        <input type="text" name="name" value="{{ $user->name }}" class="form-control input-format mt-3">
                                    </div>

                                    <div class="col-12 col-lg-6">
                                        <span class="font-weight-bold modal-label">E-mail:</span>
                                        <input type="email" name="email" value="{{ $user->email }}" class="form-control input-format mt-3">
                                    </div>

                                    <div class="col-12 col-lg-6 mt-3">
                                        <span class="font-weight-bold modal-label">Perfil:</span>
                                        <select name="profile" class="form-control input-format mt-3">
                                            <option value="Administrador" {{ $user->profile == 'Administrador' ? 'selected' : '' }}>Administrador</option>
                                            <option value="Operador" {{ $user->profile == 'Operador' ? 'selected' : '' }}>Operador</option>
                                        </select>
                                    </div>

                                    <div class="col-12 col-lg-6 mt-3 mb-4">
                                        <span class="font-weight-bold modal-label">Senha:</span>
                                        <input type="password" name="password" placeholder="Preencha somente se quiser alterar a senha." class="form-control input-format mt-3">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('save').addEventListener('click', function() {
            document.getElementById('user-edit').submit();
        });

    </script>
@endsection
