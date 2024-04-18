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
            <td>{{$transactions->firstItem() + $key}}</td>
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
                        $totalBillAmount += $item->total_bill_amount;
                        $totalDiscount += $item->total_discount;
                        $totalNetAmount += $item->total_net_amount;
                        $totalReceive += $item->total_receive;
                        $totalPayment += $item->total_payment;
                        $totalDueCol += $item->total_due_col;
                        $totalDueDiscount += $item->total_due_disc;
                        $totalDue += $item->total_due;
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