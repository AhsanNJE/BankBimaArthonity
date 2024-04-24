<table class="show-table">
    <caption class="caption">Transaction With Details</caption>
    <thead>
        
        <tr>
            <th>SL:</th>
            <th>Transaction With Name</th>
            <th>User Type</th>
            <th>Transaction Type</th>
            <th>Transaction Method</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tranwith as $key => $item)
            <tr>
                <td>{{ $key+ 1}}</td>
                <td>{{ $item->tran_with_name }}</td>
                <td>{{ $item->user_type }}</td>
                <td>{{ $item->Type->type_name }}</td>
                <td>{{ $item->tran_method }}</td>
                <td>
                    <div style="display: flex;gap:5px;">
                        <button class="btn btn-info btn-sm open-modal editTranWith" data-modal-id="editTranWith" id="edit"
                            data-id="{{ $item->id }}"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm" data-modal-id="deleteModal" data-id="{{ $item->id }}" id="delete"><i
                                class="fas fa-trash"></i></button>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>