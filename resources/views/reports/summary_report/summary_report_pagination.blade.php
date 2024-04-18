<table class="show-table">
    <thead>
        <caption class="caption">Summary Report</caption>
        <tr>
            <th>SL:</th>
            <th>Transaction Groupe</th>
            <th>Transaction Head</th>
            <th>Quantity</th>
            {{-- <th>Price</th> --}}
            <th>Total Amount</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transactions as $key => $transaction)
        <tr>
            <td>{{$key + 1}}</td>
            <td>{{$transaction->Groupe->tran_groupe_name}}</td>
            <td>{{$transaction->Head->tran_head_name}}</td>
            <td>{{$transaction->total_quantity}}</td>
            {{-- <td>{{$transaction->total_amount}}</td> --}}
            <td>{{$transaction->total_tot_amount}}</td>
        </tr>
        @endforeach
    </tbody>
</table>


{{-- <div class="center paginate" id="paginate">
    {!! $client->links() !!}
</div> --}}