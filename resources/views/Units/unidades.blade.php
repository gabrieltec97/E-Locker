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
                                <h5 class="mb-0">Blocos e Unidades</h5>
                                <p class="text-sm mb-0">
                                    <span class="font-weight-bold">Gerenciamento</span> completo
                                </p>
                            </div>

                            <!-- Coluna dos botões -->
                            <div class="col-md-6 col-12 d-flex justify-content-end gap-2 mt-2 mt-md-0">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#new-unit"><i class="fa-solid fa-circle-plus icon-format"></i> Nova unidade</button>
                                <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#new-block"><i class="fa-solid fa-circle-plus icon-format"></i> Novo bloco</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        @livewire('units')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de blocos-->
    <div class="modal fade" id="new-block" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex">
                    <h5 class="modal-title" id="exampleModalLongTitle">Cadastrar bloco</h5>
                    <i class="fa-solid fa-circle-xmark text-danger ms-auto cursor-pointer" data-bs-dismiss="modal"></i>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <form class="form-group" action="{{ route('blocos.store') }}" method="post">
                                    @csrf
                                    <span class="font-weight-bold modal-label">Número do bloco:</span>
                                    <input type="number" name="block" class="form-control input-format mt-3">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer format-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-circle-check icon-format"></i> Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de unidades-->
    <div class="modal fade" id="new-unit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex">
                    <h5 class="modal-title" id="exampleModalLongTitle">Cadastrar unidade</h5>
                    <i class="fa-solid fa-circle-xmark text-danger ms-auto cursor-pointer" data-bs-dismiss="modal"></i>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="{{ route('unidades.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-lg-6 col-md-6">
                                    <span class="font-weight-bold modal-label">Número da unidade:</span>
                                    <input type="number" name="unit" class="form-control input-format mt-3">
                                </div>

                                <div class="col-12 col-lg-6 col-md-6">
                                    <span class="font-weight-bold modal-label">Número do bloco:</span>
                                    <select name="block" class="form-control input-format mt-3">
                                        <option selected disabled>Selecione</option>
                                        @foreach($blocks as $block)
                                            <option value="{{$block->number}}">Bloco {{$block->number}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="modal-footer format-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-circle-check icon-format"></i> Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
