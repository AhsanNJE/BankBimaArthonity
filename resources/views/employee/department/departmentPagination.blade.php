<table class="show-table">
    <caption class="caption">Department Details</caption>
    <thead>
        <tr>
            <th>SL:</th>
            <th>Department Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($department as $key => $item)
            <tr>
                <td>{{ $department->firstItem() + $key }}</td>
                <td>{{ $item->dept_name }}</td>
                <td>
                    <div style="display: flex;gap:5px;">
                        <button class="open-modal editDepartment" data-modal-id="editDepartment" id="edit"
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
    {!! $department->links() !!}
</div>
