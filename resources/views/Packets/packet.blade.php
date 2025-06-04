@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

@section('title')
    Entrega {{ $packet->id }} - Faça a gestão desta entrega.
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="row">

                            <!-- Coluna do título -->
                            <div class="col-md-6 col-12">
                                <h5 class="mb-0">Entrega nº{{ $packet->id }}</h5>
                                <p class="text-sm mb-0">
                                    <span class="font-weight-bold">Administre</span> esta entrega
                                </p>
                            </div>

                            <div class="col-md-6 col-12 d-flex justify-content-end gap-2 mt-2 mt-md-0">
                                <button class="btn btn-primary" id="register">
                                    <span class="button-text"><i class="fa-solid fa-circle-check icon-format"></i> Salvar alterações</span>
                                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-2">
                        <div class="container-fluid">
                            <div class="row pb-2">
                                <div class="col-12 col-lg-3">
                                    <span class="font-weight-bold modal-label">Recebedor:</span>
                                    <input type="text" value="{{ $packet->received_by }}" class="form-control input-format mt-2 cursor-pointer" disabled>
                                </div>

                                <div class="col-12 col-lg-3">
                                    <span class="font-weight-bold modal-label">Destinatário:</span>
                                    <input type="text" value="{{ $packet->owner }}" class="form-control input-format mt-2 cursor-pointer" disabled>
                                </div>

                                <div class="col-12 col-lg-3">
                                    <span class="font-weight-bold modal-label">Unidade:</span>
                                    <input type="text" value="{{ $packet->unit }}" class="form-control input-format mt-2 cursor-pointer" disabled>
                                </div>

                                <div class="col-12 col-lg-3">
                                    <span class="font-weight-bold modal-label ">Comentários:</span>
                                    <br>
                                    @if($packet->comments == null)
                                        <span class="text-danger input-format">Sem comentários adicionados.</span>
                                    @else
                                        <span class="text-dark input-format">{{ $packet->comments }}.</span>
                                    @endif
                                </div>
                            </div>

                                <form action="#" method="post" id="upd-packet">
                                    @csrf
                                    <div class="row mt-4">
                                        <div class="col-12 col-lg-6">
                                            <span class="font-weight-bold modal-label ">Status:</span>
                                            <select name="status" class="form-control input-format cursor-pointer mt-2" id="">
                                                <option value="" {{ $packet->status == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                                                <option value="" {{ $packet->status == 'Aguardando Retirada' ? 'selected' : '' }}>Aguardando Retirada</option>
                                                <option value="" {{ $packet->status == 'Retirado pelo destinatário' ? 'selected' : '' }}>Retirado pelo destinatário</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <span class="font-weight-bold modal-label">Retirado por:</span>
                                            <input type="text" name="withdrawn" class="form-control input-format mt-2">
                                        </div>

                                        <div class="col-12 col-lg-6 mt-4">
                                            <span class="font-weight-bold modal-label">Assinatura:</span>
                                        </div>

                                        <div class="col-12 col-lg-6 mt-3">
                                            <span class="font-weight-bold modal-label">Imagem:</span>
                                            <br>
                                            <img src="{{ asset($packet->image) }}" class="image-format mt-3">
                                        </div>
                                    </div>
                                </form>
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
            const form = document.getElementById('upd-packet');

            text.classList.add('d-none');
            spinner.classList.remove('d-none');
            form.submit();
        });
    </script>

@endsection
