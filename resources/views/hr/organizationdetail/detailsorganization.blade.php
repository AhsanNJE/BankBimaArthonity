<table class="show-table">
    <thead>
        <tr>
            <th>SL:</th>
            <th>Id</th>
            <th>Name</th>
            <th>Joining Date</th>
            <th>Joining Location</th>
            <th>Department</th>
            <th>Designation</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($employeeorganization as $key => $item)
            <tr>
                <td>{{ $employeeorganization->firstItem() + $key }}</td>
                <td>{{ $item->user->user_id }}</td>
                <td>{{ $item->user->user_name }}</td>
                <td>{{ $item->joining_date }}</td>
                <td>{{ $item->Location->upazila }}</td>
                <td>{{ $item->Department->dept_name }}</td>
                <td>{{ $item->Designation->designation }}</td>
                <td style="display: flex;gap:5px;">
                    <button class="btn btn-info btn-sm open-modal editOrganization" data-modal-id="editOrganization"
                        data-id="{{ $item->id }}"><i class="fas fa-edit"></i>Edit</button>
                    <button class="btn btn-danger btn-sm" data-id="{{ $item->id }}" id="deleteOrganization"><i
                            class="fas fa-trash"></i>Delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="center paginate" id="paginate">
    {!! $employeeorganization->links() !!}
</div>
