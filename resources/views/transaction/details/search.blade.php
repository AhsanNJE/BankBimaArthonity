<table class="show-table">
    <thead>
        <caption class="caption">Transaction Details</caption>
        <tr>
            <th>SL:</th>
            <th>Id</th>
            <th>Total</th>
            <th>Discount</th>
            <th>Balance</th>
            <th>Advance</th>
            <th>Due</th>
            <th>User</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transaction as $key => $item)
            <tr>
                <td>{{ $transaction->firstItem() + $key }}</td>
                <td>{{ $item->tran_id }}</td>
                <td>{{ $item->balance_amount }}</td>
                <td>{{ $item->discount }}</td>
                <td>{{ $item->net_amount }}</td>
                <td>{{ $item->receive }} {{ $item->payment }}</td>
                <td>{{ $item->due }}</td>
                <td>{{ $item->User->user_name }}</td>
                <td style="display: flex;gap:5px;">
                    <button class="btn btn-info btn-sm open-modal editTransaction" data-modal-id="editTransaction"
                        data-id="{{ $item->tran_id }}"><i class="fas fa-edit"></i>Edit</button>
                    <button class="btn btn-danger btn-sm" data-id="{{ $item->tran_id }}" id="deleteMain"><i
                            class="fas fa-trash"></i>Delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>SL:</th>
            <th>Id</th>
            <th>Total</th>
            <th>Discount</th>
            <th>Balance</th>
            <th>Advance</th>
            <th>Due</th>
            <th>User</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>