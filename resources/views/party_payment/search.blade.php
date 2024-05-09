<table class="show-table">
    <thead>
        <caption class="caption">Receive from Client</caption>
        <tr>
            <th>SL:</th>
            <th>Id</th>
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
                <td>{{ $item->User->user_name }}</td>
                <td style="text-align: right">{{ number_format($item->amount, 0, '.', ',') }} Tk.</td>
                <td>
                    <div style="display: flex;gap:5px;">
                        <button class="open-modal editParty" data-modal-id="editParty" id="edit"
                            data-id="{{ $item->id }}"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm" data-id="{{ $item->id }}" id="delete"><i
                            class="fas fa-trash"></i></button>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>