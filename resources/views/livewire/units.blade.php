@php
    $blocks = \App\Models\Block::all();
@endphp

<div>
    <input type="search" class="form-control mb-2 livewire-input-format" wire:model.live.debounce.150ms="searchTerm">

    <table class="table align-items-center mb-0">
        <thead>
        <tr>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Unidade</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Bloco</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ajustes</th>
        </tr>
        </thead>
        <tbody>
        @if($units && $units->count() > 0)
            @foreach($units as $unit)
                <tr>
                    <td>
                        <div class="d-flex px-3 py-1">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">{{$unit->number}}</h6>
                            </div>
                        </div>
                    </td>

                    <td>
                        <h6 class="mb-0 text-sm">{{ $unit->block }}</h6>
                    </td>
                    <td class="align-middle text-center text-sm">
                        <i class="fa-solid fa-user-pen cursor-pointer maintence-icon" data-bs-toggle="modal" data-bs-target="#edit-unit{{ $unit->id }}"></i>

                        <!-- Atualizado com data-* -->
                        <i class="fa-solid fa-trash cursor-pointer text-danger delete-button"
                           data-id="{{ $unit->id }}"
                           data-number="{{ $unit->number }}"
                           data-block="{{ $unit->block }}"></i>
                    </td>
                </tr>

                <!-- Formulário oculto de exclusão -->
                <form id="form-delete-{{ $unit->id }}" action="{{ route('unidades.destroy', $unit->id) }}" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>

                <!-- Modal de edição -->
                <div class="modal fade" id="edit-unit{{ $unit->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header d-flex">
                                <h5 class="modal-title" id="exampleModalLongTitle">Editar unidade</h5>
                                <i class="fa-solid fa-circle-xmark text-danger ms-auto cursor-pointer" data-bs-dismiss="modal"></i>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <form action="{{ route('unidades.update', $unit->id ) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-12 col-lg-6 col-md-6">
                                                <span class="font-weight-bold modal-label">Número da unidade:</span>
                                                <input type="number" name="unit" class="form-control input-format mt-2 field-modal-format" value="{{ $unit->number }}">
                                            </div>

                                            <div class="col-12 col-lg-6 col-md-6 mt-3 mt-lg-0">
                                                <span class="font-weight-bold modal-label">Número do bloco:</span>
                                                <select name="block" class="form-control input-format field-modal-format mt-2">
                                                    <option selected disabled>Selecione</option>
                                                    @foreach($blocks as $block)
                                                        <option value="{{$block->number}}" {{ $unit->block == $block->number ? 'selected' : '' }}>Bloco {{$block->number}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <div class="modal-footer format-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-primary" id="save{{ $unit->id }}">
                                    <span class="button-text"><i class="fa-solid fa-circle-check icon-format"></i> Salvar alterações</span>
                                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Spinner no botão salvar -->
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const btnSave = document.getElementById('save{{ $unit->id }}');
                        if (btnSave) {
                            btnSave.addEventListener('click', function () {
                                const text = btnSave.querySelector('.button-text');
                                const spinner = btnSave.querySelector('.spinner-border');
                                text.classList.add('d-none');
                                spinner.classList.remove('d-none');
                            });
                        }
                    });
                </script>
            @endforeach
        @else
            <tr>
                <td colspan="4"><p class="text-danger">Sem registros com este nome</p></td>
            </tr>
        @endif
        </tbody>
    </table>

    <link rel="stylesheet" href="{{ asset('assets/css/responsivity.css') }}">
</div>

<!-- Script Global para deletar (Após Livewire atualizar a DOM) -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.addEventListener('click', function (e) {
            if (e.target && e.target.classList.contains('delete-button')) {
                const unitId = e.target.getAttribute('data-id');
                const unitNumber = e.target.getAttribute('data-number');
                const unitBlock = e.target.getAttribute('data-block');

                Swal.fire({
                    html: `Deseja excluir a unidade <b>${unitNumber} bloco ${unitBlock}</b>?`,
                    icon: "question",
                    showCancelButton: true,
                    cancelButtonText: 'Voltar',
                    confirmButtonText: 'Excluir',
                    confirmButtonColor: '#F97316',
                    focusCancel: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(`form-delete-${unitId}`).submit();
                    }
                });
            }
        });
    });
</script>
