<table class="show-table">
    <caption class="caption">Designation Details</caption>
    <thead>
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
                <td>
                    <div style="display: flex;gap:5px;">
                        <button class="open-modal editDesignation" data-modal-id="editDesignation" id="edit"
                            data-id="{{ $item->id }}"><i class="fas fa-edit"></i></button>
                        <button data-modal-id="deleteModal" data-id="{{ $item->id }}" id="delete"><i
                                class="fas fa-trash"></i></button>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>