<table class="show-table">
    <thead>
        <caption class="caption">Department Details</caption>
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
                <td style="display: flex;gap:5px;">
                    <button class="btn btn-info btn-sm open-modal editDepartment" data-modal-id="editDepartment"
                        data-id="{{ $item->id }}"><i class="fas fa-edit"></i>Edit</button>
                    <button class="btn btn-danger btn-sm" data-id="{{ $item->id }}" id="delete"><i
                            class="fas fa-trash"></i>Delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="center paginate" id="paginate">
    {!! $department->links() !!}
</div>
