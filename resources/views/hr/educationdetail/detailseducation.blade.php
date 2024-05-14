

<table class="show-table">
    <thead>
        <tr>
            <th>SL:</th>
            <th>Id</th>
            <th>Name</th>
            <th>Level of Education</th>
            <th>Degree Title</th>
            <th>Group</th>
            <th>Institution Name</th>
            <th>Result</th>
            <th>CGPA</th>
            <th>Passing Year</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($employeeeducation as $key => $item)
            <tr>
                <td>{{ $employeeeducation->firstItem() + $key }}</td>
                <td>{{ $item->user->user_id }}</td>
                <td>{{ $item->user->user_name }}</td>
                <td>{{ $item->level_of_education}}</td>
                <td>{{ $item->degree_title }}</td>
                <td>{{ $item->group }}</td>
                <td>{{ $item->institution_name }}</td>
                <td>{{ $item->result }}</td>
                <td>{{ $item->cgpa }}</td>
                <td>{{ $item->passing_year }}</td>
                <td style="display: flex;gap:5px;">
                    <button class="btn btn-info btn-sm open-modal editEducationDetail" 
                        data-modal-id="editEducationDetail" data-id="{{ $item->id }}" data-form-id="form_{{ $item->id }}">
                        <i class="fas fa-edit"></i>Edit</button>
                    <button class="btn btn-danger btn-sm" data-id="{{ $item->id }}" id="deleteEducation"><i
                            class="fas fa-trash"></i>Delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="center paginate" id="paginate">
    {!! $employeeeducation->links() !!}
</div>
