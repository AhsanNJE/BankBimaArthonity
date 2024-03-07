<table class="show-table">
    <thead>
        <caption class="caption">Transaction With Details</caption>
        <tr>
            <th>SL:</th>
            <th>Transaction With Name</th>
            <th>User Type</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tranwith as $key => $item)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $item->tran_with_name }}</td>
                <td>{{ $item->user_type }}</td>
                <td style="display: flex;gap:5px;">
                    <button class="btn btn-info btn-sm open-modal editTranWith" data-modal-id="editTranWith"
                        data-id="{{ $item->id }}"><i class="fas fa-edit"></i>Edit</button>
                    <button class="btn btn-danger btn-sm" data-id="{{ $item->id }}" id="delete"><i
                            class="fas fa-trash"></i>Delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


