<table class="show-table">
    <thead>
        <caption class="caption">Designation Details</caption>
        <tr>
            <th>SL:</th>
            <th>Transaction Head Name</th>
            <th>Transaction Groupe</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($heads as $key => $item)
            <tr>
                <td>{{ $heads->firstItem() + $key }}</td>
                <td>{{ $item->tran_head_name }}</td>
                <td>{{ $item->Groupe->tran_groupe_name }}</td>
                <td style="display: flex;gap:5px;">
                    <button class="btn btn-info btn-sm open-modal editTransactionHead" data-modal-id="editTransactionHead"
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
            <th>Transaction Head Name</th>
            <th>Transaction Groupe</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>




<div class="center paginate" id="paginate">
    {!! $heads->links() !!}
</div>
