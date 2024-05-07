<table class="show-table">
<thead>
        <caption class="caption">Employee Experience Details</caption>
        <tr>
            <th>SL:</th>
            <th>Id</th>
            <th>Name</th>
            <th>DOB</th>
            <th>Gender</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($employee as $key => $item)
            <tr>
                <td>{{ $employee->firstItem() + $key }}</td>
                <td>{{ $item->user_id }}</td>
                <td>{{ $item->user_name }}</td>
                <td>{{ $item->dob }}</td>
                <td>{{ $item->gender }}</td>
                <td>{{ $item->user_email }}</td>
                <td>{{ $item->user_phone }}</td>
                <td>{{ $item->address }}</td>
                <td><img src="/storage/profiles/{{ $item->image !== null ? $item->image : ($item->gender == 'female' ? 'female.png' : 'male.png') }}?{{ time() }}"
                        alt="" height="50px" width="50px"></td>
                <td>
                    @if ($item->status == 1)
                        <button class="btn btn-success btn-sm toggle-status" data-id="{{$item->id}}" data-table="Inv_Client_Info" data-status="{{$item->status}}" data-target=".client">Active</button>
                    @else
                        <button class="btn btn-danger btn-sm toggle-status" data-id="{{$item->id}}" data-table="Inv_Client_Info" data-status="{{$item->status}}" data-target=".client">Inactive</button>
                    @endif
                </td>
                <td style="display: flex;gap:5px;">
                        <button class="btn btn-info btn-sm open-modal emp_experienceDetail" data-modal-id="emp_experienceDetail"
                        data-id="{{ $item->user_id }}"><i class="fas fa-caret-down dropdown-caret"></i>Show</button>
                        <button class="btn btn-info btn-sm open-modal EmployeeExperienceDetails" data-modal-id="EmployeeExperienceDetails"
                        data-id="{{ $item->user_id }}"><i class="fa-solid fa-circle-info"></i>Details</button>
                </td>
            </tr>
            <tr id = "detailsexperience{{ $item->user_id }}" style = "display:none">
                <td colspan = "9">

                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="center paginate" id="paginate">
    {!! $employee->links() !!}
</div>