<table class="show-table">
    <caption class="caption">Employee Details</caption>
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
            <tr style="{{ $item->status == 1 ? 'background:#a1f2a1;' : 'background:#ff5353;' }}">
                <td>{{ $employee->firstItem() + $key }}</td>
                <td>{{ $item->user_id }}</td>
                <td>{{ $item->user_name }}</td>
                <td>{{ $item->user_email }}</td>
                <td>{{ $item->user_phone }}</td>
                <td>{{ $item->Location->upazila }}</td>
                <td>{{ $item->address }}</td>
                <td><img src="/storage/profiles/{{ $item->image !== null ? $item->image : ($item->gender == 'female' ? 'female.png' : 'male.png') }}?{{ time() }}"
                        alt="" height="50px" width="50px"></td>
                <td>
                    <div style="display: flex;gap:5px;">
                        <button class="open-modal showEmployeeDetails" data-modal-id="showEmployeeDetails" id="details"
                            data-id="{{ $item->id }}"><i class="fa-solid fa-circle-info"></i></button>
                        <button class="open-modal editEmployee" data-modal-id="editEmployee" id="edit"
                            data-id="{{ $item->id }}"><i class="fas fa-edit"></i></button>
                        <button data-modal-id="deleteModal" data-id="{{ $item->id }}" id="delete"><i
                                class="fas fa-trash"></i></button>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>