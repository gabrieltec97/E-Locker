@extends('layouts.app')

@section('title', 'Blocos e Unidades - Gerenciamento completo de unidades.')

@section('content')
   <div class="row">
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-md-6 col-12 title-format">
                                <h5 class="mb-0">{{ $user->name }}</h5>
                                <p class="text-sm mb-0">
                                    <span class="font-weight-bold">Informações</span> do usuário
                                </p>
                            </div>
                            <div class="col-md-6 col-12 d-flex justify-content-center justify-content-lg-end gap-2 mt-2 mt-md-0">
                                <button class="btn btn-primary" id="save">
                                    <span class="button-text"><i class="fa-solid fa-circle-check icon-format"></i>Salvar alterações</span>
                                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-2 first-item">
                        <div class="container">
                            <form action="{{ route('usuarios.update', $user->id) }}" method="post" id="user-edit">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <span class="font-weight-bold modal-label">Nome:</span>
                                        <input type="text" id="name" name="name" value="{{ $user->name }}" class="form-control input-format mt-2 field-format">
                                    </div>

                                    <div class="col-12 col-lg-6 mt-3 mt-lg-0">
                                        <span class="font-weight-bold modal-label">Sobrenome:</span>
                                        <input type="text" id="secondName" name="secondName" value="{{ $user->surname }}" class="form-control input-format mt-2 field-format">
                                    </div>

                                    <div class="col-12 col-lg-6 mt-3">
                                        <span class="font-weight-bold modal-label">E-mail:</span>
                                        <input type="email" id="email" name="email" value="{{ $user->email }}" class="form-control input-format mt-2 field-format">
                                    </div>

                                    <div class="col-12 col-lg-6 mt-3 mb-4">
                                        <span class="font-weight-bold modal-label">Senha:</span>
                                        <input type="password" id="password" name="password" placeholder="Preencha somente se quiser alterar a senha." class="form-control input-format mt-2 field-format">
                                    </div>

                                    <div class="col-12 col-lg-6 mb-3">
                                        <span class="font-weight-bold modal-label">Perfil:</span>
                                        <select name="profile" class="form-control input-format mt-2 field-format">
                                            <option value="Administrador" {{ $user->profile == 'Administrador' ? 'selected' : '' }}>Administrador</option>
                                            <option value="Operador" {{ $user->profile == 'Operador' ? 'selected' : '' }}>Operador</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @if(session('msg-error'))
        <script>
            const notyf = new Notyf({
                position: {
                    x: 'right',
                    y: 'top',
                }
            });

            notyf
                .error({
                    message: '{{ session('msg-error') }}',
                    dismissible: true,
                    duration: 5000
                })
        </script>
    @endif

    @if ($errors->any())
        <script>
            const notyf = new Notyf({
                position: {
                    x: 'right',
                    y: 'top',
                }
            });

            notyf
                .error({
                    message: '{{ $errors->first() }}',
                    dismissible: true,
                    duration: 5000
                })
        </script>
    @endif
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsivity.css') }}">
    <script src="{{ asset('assets/js/resources/user.js') }}"></script>
@endsection
