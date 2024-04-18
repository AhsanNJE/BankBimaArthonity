<table class="show-table">
    <caption class="caption">Transaction Groupe Details</caption>
    <thead>
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
                <td>
                    <div style="display: flex;gap:5px;">
                        <button class="open-modal editTransactionGroupe" data-modal-id="editTransactionGroupe" id="edit"
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
    {!! $groupes->links() !!}
</div>
