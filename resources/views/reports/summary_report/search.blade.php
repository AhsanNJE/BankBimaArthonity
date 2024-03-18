<table class="show-table">
    <thead>
        <caption class="caption">Report By Groupes</caption>
        <tr>
            <th>SL:</th>
            <th>Transaction Groupe</th>
            <th>Transaction Head</th>
            <th>Receive</th>
            <th>Payment</th>
        </tr>
    </thead>
    <tbody>
        {{-- @foreach ($receive as $key => $items)
        <tr>
            <td>{{ $key + 1 }}</td>
            @foreach ($items as $item)                    
                @if ($loop->first)
                    <td>{{ $item->Groupe->tran_groupe_name }}</td>
                @endif        
                @if ($loop->last)
                    <td>
                        @foreach ($items as $item)
                            {{ $item->Head->tran_head_name }}<br>
                        @endforeach
                    </td>
                @endif
                
            @endforeach
            <td>
                @foreach ($receive_main[$key] as $item)
                    {{ $item->receive }}<br>
                @endforeach
            </td>
            <td>
                @foreach ($receive_main[$key] as $item)
                    {{ $item->payment }}<br>
                @endforeach
            </td>
        </tr>
        @endforeach --}}
    </tbody>
</table>


{{-- <div class="center paginate" id="paginate">
    {!! $client->links() !!}
</div> --}}