<table class="show-table">
    <thead>
        <caption class="caption">Transaction Details</caption>
        <tr>
            <th>SL:</th>
            <th>Id</th>
            <th>User</th>
            <th>Total</th>
            <th>Discount</th>
            <th>Net Total</th>
            <th>Advance</th>
            <th>Due Col</th>
            <th>Due Discount</th>
            <th>Due</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transaction as $key => $item)
            <tr>
                <td>{{ $transaction->firstItem() + $key }}</td>
                <td>{{ $item->tran_id }}</td>
                <td>{{ $item->User->user_name }}</td>
                <td>{{ $item->bill_amount }}</td>
                <td>{{ $item->discount }}</td>
                <td>{{ $item->net_amount }}</td>
                <td>{{ $item->receive }} {{ $item->payment }}</td>
                <td>{{ $item->due_col }}</td>
                <td>{{ $item->due_disc }}</td>
                <td>{{ $item->due }}</td>
                <td style="display: flex;gap:5px;">
                    <button class="btn btn-info btn-sm open-modal editTransaction" data-modal-id="editTransaction"
                        data-id="{{ $item->tran_id }}"><i class="fas fa-edit"></i>Edit</button>
                    <button class="btn btn-danger btn-sm" data-id="{{ $item->tran_id }}" id="deleteMain"><i
                            class="fas fa-trash"></i>Delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
    @if($transaction->count() > 0)
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
                @foreach ($transaction as $key => $item)
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
                <td colspan="3">Total:</td>
                <td>{{ $totalBillAmount }}</td>
                <td>{{ $totalDiscount }}</td>
                <td>{{ $totalNetAmount }}</td>
                <td>{{ $totalReceive }}{{ $totalPayment }}</td>
                <td>{{ $totalDueCol }}</td>
                <td>{{ $totalDueDiscount }}</td>
                <td>{{ $totalDue }}</td>
                <td></td>
            </tr>    
        </tfoot>      
    @endif
</table>

<div class="center paginate" id="paginate">
    {!! $transaction->links() !!}
</div>
