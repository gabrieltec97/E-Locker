<div>
    <input type="search" class="form-control mb-2" wire:model.live.debounce.150ms="searchTerm">

    <table class="table align-middle mb-0">
        <thead>
        <tr>
            <th class="ps-2 text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Unidade</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Destinatário</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Recebimento</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Recebido por</th>
        </tr>
        </thead>
        <tbody>
        @if($packets && $packets->count() > 0)
            @foreach($packets as $packet)
                <tr>
                    <td class="ps-2 align-middle">
                        <h6 class="text-sm">{{ $packet->unit }}</h6>
                    </td>
                    <td class="align-middle">
                        <h6 class="text-sm">{{ $packet->owner }}</h6>
                    </td>
                    <td class="text-center align-middle">
                        <h6 class="text-sm">{{ $packet->received_at }}</h6>
                    </td>
                    <td class="text-center align-middle">
                        <h6 class="text-sm">{{ $packet->received_by }}</h6>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="4" class="text-center text-danger">Sem registros com este nome</td>
            </tr>
        @endif
        </tbody>
    </table>

</div>


