<table class="show-table">
    <thead>
        <caption class="caption">Receive from Client</caption>
        <tr>
            <th>SL:</th>
            <th>Id</th>
            <th>Transaction With</th>
            <th>User</th>
            <th>Amount</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($party as $key => $item)
            <tr>
                <td>{{ $party->firstItem() + $key }}</td>
                <td>{{ $item->tran_id }}</td>
                <td>{{ $item->withs->tran_with_name }}</td>
                <td>{{ $item->User->user_name }}</td>
                <td>{{ $item->amount }}</td>
                <td style="display: flex;gap:5px;">
                    <button class="btn btn-info btn-sm open-modal editParty" data-modal-id="editParty"
                        data-id="{{ $item->id }}"><i class="fas fa-edit"></i>Edit</button>
                    <button class="btn btn-danger btn-sm" data-id="{{ $item->id }}" id="delete"><i
                            class="fas fa-trash"></i>Delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>