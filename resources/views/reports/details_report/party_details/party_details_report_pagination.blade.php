<table class="show-table">
    <thead>
        <caption class="caption">Party Summary Report</caption>
        <tr>
            <th>SL:</th>
            <th>Transaction Id</th>
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
            <td>{{$transactions->firstItem() + $key}}</td>
            <td>{{$transaction->tran_id}}</td>
            <td>{{$transaction->Withs->tran_with_name}}</td>
            <td>{{$transaction->User->user_name}}</td>
            <td>{{$transaction->bill_amount}}</td>
            <td>{{$transaction->discount}}</td>
            <td>{{$transaction->net_amount}}</td>
            <td>{{$transaction->receive}}</td>
            <td>{{$transaction->payment}}</td>
            <td>{{$transaction->due_col}}</td>
            <td>{{$transaction->due_disc}}</td>
            <td>{{$transaction->due}}</td>
        </tr>
        @endforeach
    </tbody>
    @if($transactions->count() > 0)
        <tfoot>
            <tr>
                @php
                    $totalBillAmount = 0;
                    $totalDiscount = 0;
                    $totalNetAmount = 0;
                    $totalReceive = 0;
                    $totalPayment = 0;
                    $totalDueCol = 0;
                    $totalDueDiscount = 0;
                    $totalDue = 0;
                @endphp
                @foreach ($transactions as $key => $item)
                    @php
                        $totalBillAmount += $item->bill_amount;
                        $totalDiscount += $item->discount;
                        $totalNetAmount += $item->net_amount;
                        $totalReceive += $item->receive;
                        $totalPayment += $item->payment;
                        $totalDueCol += $item->due_col;
                        $totalDueDiscount += $item->due_disc;
                        $totalDue += $item->due;
                    @endphp
                @endforeach
                <td colspan="4">Total:</td>
                <td>{{ $totalBillAmount }}</td>
                <td>{{ $totalDiscount }}</td>
                <td>{{ $totalNetAmount }}</td>
                <td>{{ $totalReceive }}</td>
                <td>{{ $totalPayment }}</td>
                <td>{{ $totalDueCol }}</td>
                <td>{{ $totalDueDiscount }}</td>
                <td>{{ $totalDue }}</td>
            </tr>    
        </tfoot>      
    @endif
</table>


<div class="center paginate" id="paginate">
    {!! $transactions->links() !!}
</div>