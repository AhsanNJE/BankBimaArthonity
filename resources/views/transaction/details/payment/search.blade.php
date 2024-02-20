<table class="show-table">
    <thead>
        <caption class="caption">Transaction Payment Details</caption>
        <tr>
            <th>SL:</th>
            <th>Id</th>
            <th>Invoice</th>
            <th>Location</th>
            <th>Type</th>
            <th>Groupe</th>
            <th>Heads</th>
            <th>User</th>
            <th>Amount</th>
            <th>Discount</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($payment as $key => $item)
            <tr>
                <td>{{ $payment->firstItem() + $key }}</td>
                <td>{{ $item->tran_id }}</td>
                <td>{{ $item->invoice }}</td>
                <td>{{ $item->loc_id }}</td>
                <td>{{ $item->tran_type }}</td>
                <td>{{ $item->tran_groupe_id }}</td>
                <td>{{ $item->tran_head_id }}</td>
                <td>{{ $item->tran_user }}</td>
                <td>{{ $item->amount }}</td>
                <td>{{ $item->discount }}</td>
                <td style="display: flex;gap:5px;">
                    <button class="btn btn-info btn-sm open-modal editTransactionPayment" data-modal-id="editTransactionPayment"
                        data-id="{{ $item->id }}"><i class="fas fa-edit"></i>Edit</button>
                    <button class="btn btn-danger btn-sm" data-id="{{ $item->id }}" id="delete"><i
                            class="fas fa-trash"></i>Delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>SL:</th>
            <th>Id</th>
            <th>Invoice</th>
            <th>Location</th>
            <th>Type</th>
            <th>Groupe</th>
            <th>Heads</th>
            <th>User</th>
            <th>Amount</th>
            <th>Discount</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>