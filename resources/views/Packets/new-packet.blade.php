@extends('layouts.app')

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
                                <button class="btn btn-primary" id="register">
                                    <span class="button-text"><i class="fa-solid fa-circle-plus icon-format"></i> Registrar entrega</span>
                                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-2">
                        <div class="container-fluid">
                            <form action="{{ route('entregas.store') }}" method="post" id="new-packet">
                                @csrf
                                <div class="row pb-2">
                                    <div class="col-4">
                                        <span class="font-weight-bold modal-label">Recebedor:</span>
                                        <input type="text" name="receiver" class="form-control input-format mt-2" id="receiver">
                                    </div>

                                    <div class="col-4">
                                        <span class="font-weight-bold modal-label">Destinatário:</span>
                                        <input type="text" name="recipient" class="form-control input-format mt-2" id="recipient">
                                    </div>

                                    <div class="col-4">
                                        <span class="font-weight-bold modal-label">Unidade:</span>
                                        <select name="unit" class="form-control input-format mt-1" id="unit">
                                            <option value="selecione" selected disabled>Selecione</option>
                                            @foreach ($units as $unit)
                                                <option value="{{ $unit->number }} - BL 0{{ $unit->block }}">{{ $unit->number }} - BL 0{{ $unit->block }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-12 mt-3">
                                        <span class="font-weight-bold modal-label">Comentários:</span>
                                        <textarea name="comments" class="form-control mt-2 format-textarea modal-label" rows="5"></textarea>
                                    </div>

                                    <div class="col-6 mt-3">
                                        <span class="font-weight-bold modal-label">Imagem:</span>
                                        <div id="camera-container" class="mt-2">
                                            <video id="webcam" autoplay playsinline class="input-format w-full max-w-md border rounded"></video>
                                        </div>

                                        <input type="hidden" name="photo" id="photo">

                                        <!-- Pré-visualização -->
                                        <div id="preview-container" class="mt-3 hidden input-format">
                                            <img id="preview" class="max-w-md border rounded" />
                                        </div>

                                        <div class="input-format mt-3">
                                            <button type="button" id="start-camera" class="btn btn-sm btn-primary">Ativar Câmera</button>
                                            <button type="button" id="capture" class="btn btn-sm btn-success hidden">Capturar</button>
                                            <button type="button" id="retake" class="btn btn-sm btn-warning hidden">Refazer</button>
                                        </div>
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

    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <script src="{{ asset('assets/js/camera/webcam.js') }}"></script>
    <script src="{{ asset('assets/js/resources/new-packet.js') }}"></script>
@endsection
