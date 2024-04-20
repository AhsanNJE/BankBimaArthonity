<table class="show-table">
    <thead>
        <caption class="caption">Employee Training Details</caption>
        <tr>
            <th>SL:</th>
            <th>Id</th>
            <th>Name</th>
            <th>Training Title</th>
            <th>Topic</th>
            <th>Institution Name</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($employeeinfo as $key => $item)
            <tr>
                <td>{{ $employeeinfo->firstItem() + $key }}</td>
                <td>{{ $item-trainingDetail->emp_id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->trainingDetail->training_title }}</td>
                <td>{{ $item->trainingDetail->topic }}</td>
                <td>{{ $item->trainingDetail->institution_name }}</td>
                <td>{{ $item->trainingDetail->start_date }}</td>
                <td>{{ $item->trainingDetail->end_date }}</td>
                <td><img src="/storage/profiles/{{ $item->image !== null ? $item->image : ($item->gender == 'female' ? 'female.png' : 'male.png') }}" alt="" height="50px" width="50px"></td>
                <td>
                    @if ($item->status == 1)
                        <button class="btn btn-success btn-sm toggle-status" data-id="{{$item->id}}" data-table="Inv_Client_Info" data-status="{{$item->status}}" data-target=".client">Active</button>
                    @else
                        <button class="btn btn-danger btn-sm toggle-status" data-id="{{$item->id}}" data-table="Inv_Client_Info" data-status="{{$item->status}}" data-target=".client">Inactive</button>
                    @endif
                </td>
                <td style="display: flex;gap:5px;">
                    <button class="btn btn-info btn-sm open-modal EmployeeTrainingDetails" data-modal-id="EmployeeTrainingDetails"
                        data-id="{{ $item->id }}"><i class="fa-solid fa-circle-info"></i>Details</button>
                    <button class="btn btn-info btn-sm open-modal EmployeeEdit" data-modal-id="EmployeeEdit"
                        data-id="{{ $item->id }}"><i class="fas fa-edit"></i>Edit</button>
                    <button class="btn btn-danger btn-sm" data-id="{{ $item->id }}" id="delete"><i
                            class="fas fa-trash"></i>Delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="center paginate" id="paginate">
    {!! $employeeinfo->links() !!}
</div>
