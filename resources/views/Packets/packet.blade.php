@extends('layouts.app')

@section('title')
    Entrega {{ $packet->id }} - Faça a gestão desta entrega.
@endsection

@section('content')
    <div class="row">
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-md-6 col-12 title-format">
                                <h5 class="mb-0">Entrega nº{{ $packet->id }}</h5>
                                @if($packet->withdrawn_by == null)
                                    @if($packet->status == 'Cancelado')
                                        <p class="text-sm mb-0">
                                            <span class="font-weight-bold"><span class="text-danger">{{ $packet->status }}</span></span>
                                        </p>
                                    @else
                                        <p class="text-sm mb-0">
                                            <span class="font-weight-bold">Administre</span> esta entrega
                                        </p>
                                    @endif
                                @else
                                    <p class="text-sm mb-0">
                                        <span class="font-weight-bold text-success">Retirado por {{ $packet->withdrawn_by }} em {{ $packet->withdrawn_at }}</span>
                                    </p>
                                @endif
                            </div>

                            @if($packet->status != 'Cancelado')
                                @if($packet->withdrawn_by == null )
                                    <div class="col-md-6 col-12 d-flex justify-content-center justify-content-lg-end gap-2 mt-2 mt-md-0">
                                        <button class="btn btn-primary" id="register">
                                            <span class="button-text"><i class="fa-solid fa-circle-check icon-format"></i> Salvar alterações</span>
                                            <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                        </button>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="row pb-2">
                                <div class="col-12 col-lg-4 first-item">
                                    <span class="font-weight-bold modal-label">Recebedor:</span>
                                    <input type="text" value="{{ $packet->received_by }}" class="form-control input-format mt-2 cursor-pointer field-format" disabled>
                                </div>

                                <div class="col-12 col-lg-4 mt-3 mt-lg-0">
                                    <span class="font-weight-bold modal-label">Destinatário:</span>
                                    <input type="text" value="{{ $packet->owner }}" id="owner" class="form-control input-format mt-2 cursor-pointer field-format" disabled>
                                </div>

                                <div class="col-12 col-lg-4 mt-3 mt-lg-0">
                                    <span class="font-weight-bold modal-label">Unidade:</span>
                                    <input type="text" value="{{ $packet->unit }}" class="form-control input-format mt-2 cursor-pointer field-format" disabled>
                                </div>

                                <div class="col-12 mt-3">
                                    <span class="font-weight-bold modal-label ">Comentários:</span>
                                    <br>
                                    @if($packet->comments == null)
                                        <textarea class="form-control input-format field-format mt-3 comments" cols="10" rows="5" disabled>Sem comentários adicionados</textarea>
                                    @else
                                        <textarea class="form-control input-format field-format mt-3 comments" cols="10" rows="5" disabled>{{ $packet->comments }}</textarea>
                                    @endif
                                </div>
                            </div>
                                <form action="{{ route('entregas.update', $packet->id) }}" method="post" id="upd-packet">
                                    @csrf
                                    @method('PUT')
                                    <div class="row mt-3 mb-5">
                                        <div class="col-12 col-lg-4">
                                            <span class="font-weight-bold modal-label ">Status:</span>
                                            <select name="status" id="status" class="form-control input-format field-format mt-2" {{ ($packet->status == 'Retirado por terceiros' || $packet->status == 'Retirado pelo destinatário') ? 'disabled' : '' }}>
                                                <option value="Cancelado" {{ $packet->status == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                                                <option value="Aguardando Retirada" {{ $packet->status == 'Aguardando Retirada' ? 'selected' : '' }}>Aguardando Retirada</option>
                                                <option value="Retirado por terceiros" {{ $packet->status == 'Retirado por terceiros' ? 'selected' : '' }}>Retirado por terceiros</option>
                                                <option value="Retirado pelo destinatário" {{ $packet->status == 'Retirado pelo destinatário' ? 'selected' : '' }}>Retirado pelo destinatário</option>
                                            </select>
                                        </div>

                                        <div class="col-12 col-lg-4 mt-3 mt-lg-0">
                                            <span class="font-weight-bold modal-label">Retirado por:</span>
                                            <input type="text" id="recipient" name="withdrawn" value="{{ $packet->withdrawn_by }}" {{ $packet->withdrawn_by != null ? 'disabled' : '' }} class="form-control input-format mt-2 field-format">
                                        </div>

                                        @if($packet->withdrawn_at != null)
                                            <div class="col-12 col-lg-4 mt-3 mt-lg-0">
                                                <span class="font-weight-bold modal-label">Retirado em:</span>
                                                <input type="text" value="{{ $packet->withdrawn_at }}" class="form-control input-format mt-2 field-format" disabled>
                                            </div>
                                        @endif

                                        @if($packet->signature == null)
                                            @if($packet->status != 'Cancelado')
                                                <div class="col-12 col-lg-6 mt-4">
                                                    <span class="font-weight-bold modal-label">Assinatura:</span>
                                                    <div class="p-2 mt-2">
                                                        <canvas id="signature-pad" class="border rounded bg-white signature-format sign-format"></canvas>
                                                        <br>
                                                        <button type="button" id="clear-signature" class="btn btn-sm btn-secondary signature-format mt-3">Limpar</button>
                                                    </div>
                                                    <input type="hidden" name="signature" id="signature">
                                                </div>
                                            @endif
                                        @else
                                            <div class="col-12 col-lg-6 mt-3 mt-lg-4">
                                                <span class="font-weight-bold modal-label">Assinatura do recebedor:</span>
                                                <br>
                                                <img src="{{ asset($packet->signature) }}" class="image-format mt-3 field-format">
                                            </div>
                                        @endif

                                        <div class="col-12 col-lg-6 mt-3 mt-lg-4">
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
    <script src="{{ asset('assets/js/signature/my-signature.js') }}"></script>
@endsection
