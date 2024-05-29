<table class="show-table">
    <thead>
        <caption class="caption">Inventory Issue Details</caption>
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
        @foreach ($inventory as $key => $item)
            <tr>
                <td>{{ $inventory->firstItem() + $key }}</td>
                <td>{{ $item->tran_id }}</td>
                <td>{{ $item->User->user_name }}</td>
                <td style="text-align: right">{{ number_format($item->bill_amount, 0, '.', ',') }}</td>
                <td style="text-align: right">{{ number_format($item->discount, 0, '.', ',') }}</td>
                <td style="text-align: right">{{ number_format($item->net_amount, 0, '.', ',') }}</td>
                <td style="text-align: right">
                    {{ $item->tran_method == 'Receive' ? number_format($item->receive, 0, '.', ',') : number_format($item->payment, 0, '.', ',') }} 
                </td>
                <td style="text-align: right">{{ number_format($item->due_col, 0, '.', ',') }}</td>
                <td style="text-align: right">{{ number_format($item->due_disc, 0, '.', ',') }}</td>
                <td style="text-align: right">{{ number_format($item->due, 0, '.', ',') }}</td>
                <td>
                    <div style="display: flex;gap:5px;">
                        <button class="open-modal" data-modal-id="printDetails" id="details"
                            data-id="{{ $item->tran_id }}"><i class="fa-solid fa-circle-info"></i></button>
                        <button class="open-modal editInventoryIssue" data-modal-id="editInventoryIssue" id="edit"
                            data-id="{{ $item->tran_id }}"><i class="fas fa-edit"></i></button>
                        <button class="deleteMain" data-id="{{ $item->tran_id }}" id="delete"><i class="fas fa-trash"></i></button>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
    @if($inventory->count() > 0)
        <tfoot>
            <tr>
                @php
                    $totalBillAmount = 0;
                    $totalDiscount = 0;
                    $totalNetAmount = 0;
                    $totalAdvance = 0;
                    $totalDueCol = 0;
                    $totalDueDiscount = 0;
                    $totalDue = 0;
                @endphp
                @foreach ($inventory as $key => $item)
                    @php
                        $totalBillAmount += $item->bill_amount;
                        $totalDiscount += $item->discount;
                        $totalNetAmount += $item->net_amount;
                        $item->tran_method == 'Receive' ? $totalAdvance += $item->receive : $totalAdvance += $item->payment;
                        $totalDueCol += $item->due_col;
                        $totalDueDiscount += $item->due_disc;
                        $totalDue += $item->due;
                    @endphp
                @endforeach
                <td colspan="3">Total:</td>
                <td style="text-align: right">{{ number_format($totalBillAmount, 0, '.', ',') }}</td>
                <td style="text-align: right">{{ number_format($totalDiscount, 0, '.', ',') }}</td>
                <td style="text-align: right">{{ number_format($totalNetAmount, 0, '.', ',') }}</td>
                <td style="text-align: right">{{ number_format($totalAdvance, 0, '.', ',') }}</td>
                <td style="text-align: right">{{ number_format($totalDueCol, 0, '.', ',') }}</td>
                <td style="text-align: right">{{ number_format($totalDueDiscount, 0, '.', ',') }}</td>
                <td style="text-align: right">{{ number_format($totalDue, 0, '.', ',') }}</td>
                <td></td>
            </tr>     
        </tfoot>      
    @endif
</table>


<div class="center paginate" id="paginate">
    {!! $inventory->links() !!}
</div>