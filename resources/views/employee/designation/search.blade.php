<table class="show-table">
    <thead>
        <caption class="caption">Designation Details</caption>
        <tr>
            <th>SL:</th>
            <th>Designation</th>
            <th>Department</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($designations as $key => $item)
            <tr>
                <td>{{ $designations->firstItem() + $key }}</td>
                <td>{{ $item->designation }}</td>
                <td>{{ $item->Department->dept_name }}</td>
                <td style="display: flex;gap:5px;">
                    <button class="btn btn-info btn-sm open-modal editDesignation" data-modal-id="editDesignation"
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
            <th>Designation</th>
            <th>Department</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>


