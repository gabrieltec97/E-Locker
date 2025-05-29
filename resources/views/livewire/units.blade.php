<script src="{{ asset('assets/js/sweetalert2.js') }}"></script>
<div>
    <input type="search" class="form-control mb-2" style="margin-left: 10px; width: 98%;" wire:model.live.debounce.150ms="searchTerm">

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
                        <td>{{$unit->number}}</td>
                        <td>{{ $unit->block }}</td>
                        <td class="align-middle text-center text-sm">
                            <a href="{{ route('usuarios.show', $unit->id) }}"><i class="fa-solid fa-user-pen cursor-pointer maintence-icon"></i></a>
                            <i class="fa-solid fa-trash cursor-pointer text-danger" id="delete{{$unit->id}}"></i>
                        </td>
                    </tr>

                    <form id="form-delete-{{ $unit->id }}" action="{{ route('unidades.destroy', $unit->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>

                    <script>
                        const btnAlert{{ $unit->id }} = document.querySelector('#delete{{ $unit->id }}');
                        btnAlert{{ $unit->id }}.addEventListener('click', function () {
                            Swal.fire({
                                html: `Deseja excluir a unidade <b>{{ $unit->number }} bloco {{ $unit->block }}</b>?`,
                                icon: "question",
                                showCancelButton: true,
                                cancelButtonText: 'Voltar',
                                confirmButtonText: 'Excluir',
                                confirmButtonColor: '#F97316',
                                focusCancel: true
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    document.getElementById('form-delete-{{ $unit->id }}').submit();
                                }
                            });
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
</div>
