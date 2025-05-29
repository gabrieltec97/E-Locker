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
                        <td>teste</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4"><p class="text-danger">Sem registros com este nome</p></td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
