<table class="show-table">
    <thead>
        <caption class="caption">Employee Organization Details</caption>
        <tr>
            <th>SL:</th>
            <th>Id</th>
            <th>Name</th>
            <th>Joining Date</th>
            <th>Joining Location</th>
            <th>Department</th>
            <th>Designation</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($employeeorganization as $key => $item)
            <tr>
                <td>{{ $employeeorganization->firstItem() + $key }}</td>
                <td>{{ $item->emp_id }}</td>
                <td>{{ $item->user->user_name }}</td>
                <td>{{ $item->joining_date }}</td>
                <td>{{ $item->Location->upazila }}</td>
                <td>{{  $item->Department->dept_name }}</td>
                <td>{{ $item->Designation->designation }}</td>
                <td>
                    @if ($item->status == 1)
                        <button class="btn btn-success btn-sm toggle-status" data-id="{{$item->id}}" data-table="Inv_Client_Info" data-status="{{$item->status}}" data-target=".client">Active</button>
                    @else
                        <button class="btn btn-danger btn-sm toggle-status" data-id="{{$item->id}}" data-table="Inv_Client_Info" data-status="{{$item->status}}" data-target=".client">Inactive</button>
                    @endif
                </td>
                <td style="display: flex;gap:5px;">
                    <button class="btn btn-info btn-sm open-modal EmployeeOrganizationDetails" data-modal-id="EmployeeOrganizationDetails"
                        data-id="{{ $item->id }}"><i class="fa-solid fa-circle-info"></i>Details</button>
                    <button class="btn btn-info btn-sm open-modal EmployeeEdit" data-modal-id="EmployeeEdit"
                        data-id="{{ $item->emp_id }}"><i class="fas fa-edit"></i>Edit</button>
                    <button class="btn btn-danger btn-sm" data-id="{{ $item->emp_id }}" id="delete"><i
                            class="fas fa-trash"></i>Delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="center paginate" id="paginate">
    {!! $employeeorganization->links() !!}
</div>
