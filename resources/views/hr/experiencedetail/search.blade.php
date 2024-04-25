<table class="show-table">
    <caption class="caption">Employee Experience Details</caption>
    <thead>
        <tr>
            <th>SL:</th>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Location</th>
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
                <td>{{ $item->user_email }}</td>
                <td>{{ $item->user_phone }}</td>
                <td>{{ $item->Location->upazila }}</td>
                <td>{{ $item->address }}</td>
                <td><img src="/storage/profiles/{{ $item->image !== null ? $item->image : ($item->gender == 'female' ? 'female.png' : 'male.png') }}?{{ time() }}"
                        alt="" height="50px" width="50px"></td>

                <td style="display: flex;gap:5px;">
                    <button class="btn btn-info btn-sm open-modal EmployeeExperienceDetails" data-modal-id="EmployeeExperienceDetails"
                        data-id="{{ $item->user_id }}"><i class="fa-solid fa-circle-info"></i>Details</button>
                    <button class="btn btn-info btn-sm open-modal EmployeeEdit" data-modal-id="EmployeeEdit"
                        data-id="{{ $item->id }}"><i class="fas fa-edit"></i>Edit</button>
                    <button class="btn btn-danger btn-sm" data-id="{{ $item->id }}" id="delete"><i
                            class="fas fa-trash"></i>Delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>