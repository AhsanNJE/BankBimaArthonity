<table class="show-table">
    <thead>
        <tr>
            <th>SL:</th>
            <th>Id</th>
            <th>Name</th>
            <th>Training Title</th>
            <th>Country</th>
            <th>Topic</th>
            <th>Institution Name</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Training Year</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($employeetraining as $key => $item)
            <tr>
                <td>{{ $employeetraining->firstItem() + $key }}</td>
                <td>{{ $item->user->user_id }}</td>
                <td>{{ $item->user->user_name }}</td>
                <td>{{ $item->training_title}}</td>
                <td>{{ $item->country }}</td>
                <td>{{ $item->topic }}</td>
                <td>{{ $item->institution_name }}</td>
                <td>{{ $item->start_date }}</td>
                <td>{{ $item->end_date }}</td>
                <td>{{ $item->training_year }}</td>
                <td style="display: flex;gap:5px;">
                    <button class="btn btn-info btn-sm open-modal editTrainingDetail" data-modal-id="editTrainingDetail"
                        data-id="{{ $item->id }}"><i class="fas fa-edit"></i>Edit</button>
                    <button class="btn btn-danger btn-sm" data-id="{{ $item->id }}" id="deleteTraining"><i
                            class="fas fa-trash"></i>Delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="center paginate" id="paginate">
    {!! $employeetraining->links() !!}
</div>
