<table class="show-table">
    <caption class="caption">Main Head Details</caption>
    <thead>
        <tr>
            <th>SL:</th>
            <th>Main Head Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($types as $key => $item)
            <tr>
                <td>{{ $types->firstItem() + $key }}</td>
                <td>{{ $item->type_name }}</td>
                <td>
                    <div style="display: flex;gap:5px;">
                        <button class="open-modal editTransactionType" data-modal-id="editTransactionType" id="edit"
                            data-id="{{ $item->id }}"><i class="fas fa-edit"></i></button>
                        <button data-modal-id="deleteModal" data-id="{{ $item->id }}" id="delete"><i
                                class="fas fa-trash"></i></button>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>