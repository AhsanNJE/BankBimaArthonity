<table class="show-table">
    <caption class="caption">Bank Transaction Details</caption>
    <thead>
        <tr>
            <th>SL:</th>
            <th>Id</th>
            <th>Bank Name</th>
            <th>Deposit Amount</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transaction as $key => $item)
            <tr>
                <td>{{ $transaction->firstItem() + $key }}</td>
                <td>{{ $item->tran_id }}</td>
                <td>{{ $item->User->user_name }}</td>
                <td style="text-align: right">{{ number_format($item->bill_amount, 0, '.', ',') }} Tk.</td>
                <td style="display: flex;gap:5px;">
                    <button class="btn btn-info btn-sm open-modal" data-modal-id="editBankTransaction" id="edit"
                        data-id="{{ $item->tran_id }}"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger btn-sm" data-id="{{ $item->tran_id }}" id="delete"><i
                            class="fas fa-trash"></i></button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
