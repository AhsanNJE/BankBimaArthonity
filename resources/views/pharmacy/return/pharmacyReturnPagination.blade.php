<table class="show-table">
    <thead>
        <caption class="caption">Inventory Return Details</caption>
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
                <td style="display: flex;gap:5px;">
                    <button class="btn btn-info btn-sm open-modal editTransaction" data-modal-id="editTransaction"
                        data-id="{{ $item->tran_id }}"><i class="fas fa-edit"></i>Edit</button>
                    <button class="btn btn-danger btn-sm" data-id="{{ $item->tran_id }}" id="deleteMain"><i
                            class="fas fa-trash"></i>Delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


<div class="center paginate" id="paginate">
    {!! $inventory->links() !!}
</div>