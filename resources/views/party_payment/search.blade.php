<table class="show-table">
    <thead>
        <caption class="caption">Party Payments</caption>
        <tr>
            <th>SL:</th>
            <th>Id</th>
            <th>Invoice</th>
            <th>Type</th>
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
        @foreach ($party as $key => $item)
            <tr>
                <td>{{ $party->firstItem() + $key }}</td>
                <td>{{ $item->tran_id }}</td>
                <td>{{ $item->invoice }}</td>
                <td>{{ $item->tran_type }}</td>
                <td>{{ $item->balance_amount }}</td>
                <td>{{ $item->discount }}</td>
                <td>{{ $item->net_amount }}</td>
                <td>{{ $item->receive }} {{ $item->payment }}</td>
                <td>{{ $item->due }}</td>
                <td>{{ $item->User->user_name }}</td>
                <td style="display: flex;gap:5px;">
                    <button class="btn btn-info btn-sm open-modal editTransaction" data-modal-id="editTransaction"
                        data-id="{{ $item->tran_id }}"><i class="fas fa-edit"></i>Edit</button>
                    <button class="btn btn-danger btn-sm" data-id="{{ $item->tran_id }}" id="delete"><i
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
            <th>Type</th>
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