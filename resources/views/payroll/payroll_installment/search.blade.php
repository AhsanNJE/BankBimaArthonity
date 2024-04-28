<table class="show-table">
    <thead>
        <caption class="caption">Payroll / Salary Payment</caption>
        <tr>
            <th>SL:</th>
            <th>Employee Id</th>
            <th>Employee Name</th>
            <th>Salary</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($payroll as $key => $item)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $item['emp_id'] }}</td>
            <td>{{ $item['emp_name'] }}</td>
            <td>{{ number_format($item['salary'], 0, '.', ',') }}</td>
            <td>
                <button class="open-modal editPayroll" data-modal-id="editPayroll" id="edit"
                    data-id="{{ $item['emp_id'] }}"><i class="fas fa-edit"></i></button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>