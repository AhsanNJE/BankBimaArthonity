<table class="show-table">
    <thead>
        <caption class="caption">Party Summary Report</caption>
        <tr>
            <th>SL:</th>
            <th>Transaction Type</th>
            <th>Tran With</th>
            <th>Tran User</th>
            <th>Bill Amount</th>
            <th>Discount</th>
            <th>Net Amount</th>
            <th>Receive</th>
            <th>Payment</th>
            <th>Due Col</th>
            <th>Due discount</th>
            <th>Balance / Due</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transactions as $key => $transaction)
        <tr>
            <td>{{$key + 1}}</td>
            <td>{{$transaction->tran_type}}</td>
            <td>{{$transaction->Withs->tran_with_name}}</td>
            <td>{{$transaction->User->user_name}}</td>
            <td>{{$transaction->total_bill_amount}}</td>
            <td>{{$transaction->total_discount}}</td>
            <td>{{$transaction->total_net_amount}}</td>
            <td>{{$transaction->total_receive}}</td>
            <td>{{$transaction->total_payment}}</td>
            <td>{{$transaction->total_due_col}}</td>
            <td>{{$transaction->total_due_disc}}</td>
            <td>{{$transaction->total_due}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

