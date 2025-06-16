<div>
    <input type="search" class="form-control mb-2" wire:model.live.debounce.150ms="searchTerm">

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th class="ps-2 text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Id</th>
                <th class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Unidade</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Destinatário</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Recebimento</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Recebido por</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
            </tr>
            </thead>
            <tbody>
            @if($packets && $packets->count() > 0)
                @foreach($packets as $packet)
                    <tr>
                        <td class="ps-2 align-middle">
                            <h6 class="text-sm"><a href="{{ route('entregas.show', $packet->id) }}">#{{ $packet->id }}</a></h6>
                        </td>
                        <td class="align-middle">
                            <h6 class="text-sm"><a href="{{ route('entregas.show', $packet->id) }}">{{ $packet->unit }}</a></h6>
                        </td>
                        <td class="align-middle">
                            <h6 class="text-sm"><a href="{{ route('entregas.show', $packet->id) }}">{{ $packet->owner }}</a></h6>
                        </td>
                        <td class="text-center align-middle">
                            <h6 class="text-sm"><a href="{{ route('entregas.show', $packet->id) }}">{{ $packet->received_at }}</a></h6>
                        </td>
                        <td class="text-center align-middle">
                            <h6 class="text-sm"><a href="{{ route('entregas.show', $packet->id) }}">{{ $packet->received_by }}</a></h6>
                        </td>
                        <td class="text-center align-middle">
                            <h6 class="text-sm
                        @if($packet->status == 'Aguardando Retirada')
                            text-primary
                        @elseif($packet->status == 'Cancelado')
                            text-danger
                        @else
                            text-success
                        @endif
                        ">
                                {{ $packet->status }}
                            </h6>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-danger">Sem registros com este nome</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
</div>


