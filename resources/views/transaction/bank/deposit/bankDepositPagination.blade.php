<table class="show-table">
    <caption class="caption">Bank Deposit Details</caption>
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
                <td>{{ $item->bill_amount }}</td>
                <td style="display: flex;gap:5px;">
                    <button class="btn btn-info btn-sm open-modal editBankDeposit" data-modal-id="editBankDeposit"
                        data-id="{{ $item->tran_id }}"><i class="fas fa-edit"></i>Edit</button>
                    <button class="btn btn-danger btn-sm" data-id="{{ $item->tran_id }}" id="deleteMain"><i
                            class="fas fa-trash"></i>Delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>