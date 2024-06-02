<table class="show-table">
    <caption class="caption">Designation Details</caption>
    <thead>
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
                <td>
                    <div style="display: flex;gap:5px;">
                        <button class="open-modal editTransactionHead" data-modal-id="editTransactionHead" id="edit"
                            data-id="{{ $item->id }}"><i class="fas fa-edit"></i></button>
                        <button data-modal-id="deleteModal" data-id="{{ $item->id }}" id="delete"><i
                                class="fas fa-trash"></i></button>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>




<div class="center paginate" id="paginate">
    {!! $heads->links() !!}
</div>
