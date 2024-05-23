<table class="show-table">
    <caption class="caption">Form Details</caption>
    <thead>
        <tr>
            <th>Id</th>
            <th>Form Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($form as $key => $item)
            <tr>
                <td>{{ $form->firstItem() + $key }}</td>
                <td>{{ $item->form_name }}</td>
                <td>
                    <div style="display: flex;gap:5px;">
                        <button class="open-modal editForm" data-modal-id="editForm" id="edit"
                            data-id="{{ $item->id }}"><i class="fas fa-edit"></i></button>
                        <button data-modal-id="deleteFormModal" data-id="{{ $item->id }}" id="delete"><i
                                class="fas fa-trash"></i></button>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="center paginate" id="paginate">
    {!! $form->links() !!}
</div>
