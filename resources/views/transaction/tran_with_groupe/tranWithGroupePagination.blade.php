<table class="show-table">
    <caption class="caption">Tranwith Groupe Details</caption>
    <thead>
        <tr>
            <th>SL:</th>
            <th>Transaction with Name</th>
            <th>Transaction Groupe Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($withgroupes as $key => $item)
            <tr>
                <td>{{ $withgroupes->firstItem() + $key }}</td>
                <td>{{ $item->Withs->tran_with_name }}</td>
                <td>{{ $item->Groupe->tran_groupe_name }}</td>
                <td>
                    <div style="display: flex;gap:5px;">
                        <button class="open-modal editTranWithGroupe" data-modal-id="editTranWithGroupe" id="edit"
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
    {!! $withgroupes->links() !!}
</div>
