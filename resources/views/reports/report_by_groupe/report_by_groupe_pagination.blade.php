<table class="show-table">
    <thead>
        <caption class="caption">Report By Groupes</caption>
        <tr>
            <th>SL:</th>
            <th>Transaction Groupe</th>
            <th>Transaction Head</th>
            <th>Receive</th>
            <th>Payment</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($receive as $key => $items)
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
            <td style="display: flex;gap:5px;">
                @foreach ($receive_main[$key] as $item)
                    <button class="btn btn-info btn-sm open-modal invoiceDetails" data-modal-id="invoiceDetails"
                        data-id="{{ $item->tran_id }}"><i class="fas fa-edit"></i>Invoice</button>
                    {{-- <a href="{{ route('trans.details',$item->id) }}" class="btn btn-secondary btn-sm rounded-pill waves-effect waves-light"> Details </a>

                    <a href="{{ route('trans.invoice',$item->tran_id) }}" class="btn btn-secondary btn-sm rounded-pill waves-effect waves-light">Invoice</a> --}}
                @endforeach
            </td>
        </tr>
        @endforeach

        @foreach ($payment as $key => $items)
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
                @foreach ($payment_main[$key] as $item)
                    {{ $item->receive }}<br>
                @endforeach
            </td>
            <td>
                @foreach ($payment_main[$key] as $item)
                    {{ $item->payment }}<br>
                @endforeach
            </td>
            <td style="display: flex;gap:5px;">
                @foreach ($payment_main[$key] as $item)
                    <button class="btn btn-info btn-sm open-modal invoiceDetails" data-modal-id="invoiceDetails"
                        data-id="{{ $item->tran_id }}"><i class="fas fa-edit"></i>Invoice</button>
                    {{-- <a href="{{ route('trans.details',$item->id) }}" class="btn btn-secondary btn-sm rounded-pill waves-effect waves-light"> Details </a>

                    <a href="{{ route('trans.invoice',$item->tran_id) }}" class="btn btn-secondary btn-sm rounded-pill waves-effect waves-light">Invoice</a> --}}
                @endforeach
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


{{-- <div class="center paginate" id="paginate">
    {!! $client->links() !!}
</div> --}}