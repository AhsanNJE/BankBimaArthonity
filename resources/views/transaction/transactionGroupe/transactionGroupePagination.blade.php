<table class="show-table">
    <thead>
        <caption class="caption">Transaction Groupe Details</caption>
        <tr>
            <th>SL:</th>
            <th>Transaction Groupe Name</th>
            <th>Transaction Groupe Type</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($groupes as $key => $item)
            <tr>
                <td>{{ $groupes->firstItem() + $key }}</td>
                <td>{{ $item->tran_groupe_name }}</td>
                <td>{{ $item->tran_groupe_type }}</td>
                <td style="display: flex;gap:5px;">
                    <button class="btn btn-info btn-sm open-modal editTransactionGroupe" data-modal-id="editTransactionGroupe"
                        data-id="{{ $item->id }}"><i class="fas fa-edit"></i>Edit</button>
                    <button class="btn btn-danger btn-sm" data-id="{{ $item->id }}" id="delete"><i
                            class="fas fa-trash"></i>Delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="center paginate" id="paginate">
    {!! $groupes->links() !!}
</div>
