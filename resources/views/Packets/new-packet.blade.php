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
                                <h5 class="mb-0">Nova entrega</h5>
                                <p class="text-sm mb-0">
                                    <span class="font-weight-bold">Registre</span> uma nova entrega
                                </p>
                            </div>

                            <div class="col-md-6 col-12 d-flex justify-content-end gap-2 mt-2 mt-md-0">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#new-unit" id="register">
                                    <span class="button-text"><i class="fa-solid fa-circle-plus icon-format"></i> Registrar entrega</span>
                                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-2">
                        
                        <div class="container-fluid">
                            <div class="row pb-2">
                                <div class="col-4">
                                    <span class="font-weight-bold modal-label">Recebedor:</span>
                                    <input type="text" name="receiver" class="form-control input-format mt-2">
                                </div>

                                <div class="col-4">
                                    <span class="font-weight-bold modal-label">Destinatário:</span>
                                    <input type="text" name="recipient" class="form-control input-format mt-2">
                                </div>

                                <div class="col-4">
                                    <span class="font-weight-bold modal-label">Unidade:</span>
                                    <select name="unit" class="form-control input-format mt-1">
                                        <option selected disabled>Selecione</option>
                                        @foreach ($units as $unit)
                                            <option value="">{{ $unit->number }} - BL 0{{ $unit->block }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-6 mt-3">
                                    <span class="font-weight-bold modal-label">Imagem:</span>
                                    
                                </div>

                                <div class="col-12 mt-3">
                                    <span class="font-weight-bold modal-label">Comentários:</span>
                                    <textarea name="comments" class="form-control mt-2 format-textarea modal-label" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session('msg-success'))
        <script>
            const notyf = new Notyf({
                position: {
                    x: 'right',
                    y: 'top',
                }
            });

            notyf
                .success({
                    message: '{{ session('msg-success') }}',
                    dismissible: true,
                    duration: 5000
                });
        </script>
    @endif

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

    <script>
        document.getElementById('register').addEventListener('click', function () {
            const button = this;
            const text = button.querySelector('.button-text');
            const spinner = button.querySelector('.spinner-border');

            text.classList.add('d-none');
            spinner.classList.remove('d-none');
        });
    </script>
@endsection
