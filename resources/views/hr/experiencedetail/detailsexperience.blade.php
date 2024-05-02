

<table class="show-table">
    <thead>
        <tr>
            <th>SL:</th>
            <th>Id</th>
            <th>Name</th>
            <th>Company Name</th>
            <th>Designation</th>
            <th>Department</th>
            <th>Company Location</th>
            <th>Start Date</th>
            <th>End Date</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($employeeexperience as $key => $item)
            <tr>
                <td>{{ $employeeexperience->firstItem() + $key }}</td>
                <td>{{ $item->user->user_id }}</td>
                <td>{{ $item->user->user_name }}</td>
                <td>{{ $item->company_name}}</td>
                <td>{{ $item->designation }}</td>
                <td>{{ $item->department }}</td>
                <td>{{ $item->company_location }}</td>
                <td>{{ $item->start_date }}</td>
                <td>{{ $item->end_date }}</td>
                <td style="display: flex;gap:5px;">
                    <button class="btn btn-info btn-sm open-modal editExperienceDetail" data-modal-id="editExperienceDetail"
                        data-id="{{ $item->id }}"><i class="fas fa-edit"></i>Edit</button>
                    <button class="btn btn-danger btn-sm" data-id="{{ $item->id }}" id="deleteExperience"><i
                            class="fas fa-trash"></i>Delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="center paginate" id="paginate">
    {!! $employeeexperience->links() !!}
</div>
