<div class="opening">
    <label for="opening">Opening Balance</label>
    <input type="text" name="opening" id="opening" value="{{ number_format($opening, 0, '.', ',') }}" disabled>
</div>
<table class="show-table">
    <thead>
        <caption class="caption">Summary Balance Sheet</caption>
        <tr>
            <th>SL:</th>
            <th>Id</th>
            <th>User Name</th>
            <th>Receive</th>
            <th>Payment</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transactions as $key => $transaction)
        <tr>
            <td>{{ $transactions->firstItem() + $key }}</td>
            <td>{{$transaction->tran_id}}</td>
            <td>{{$transaction->User->user_name}}</td>
            <td>{{$transaction->receive}}</td>
            <td>{{$transaction->payment}}</td>
        </tr>
        @endforeach
    </tbody>
</table>


{{-- <div class="center paginate" id="paginate">
    {!! $client->links() !!}
</div> --}}