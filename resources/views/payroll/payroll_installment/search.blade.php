<table class="show-table">
    <thead>
        <caption class="caption">Payroll / Salary Payment</caption>
        <tr>
            <th>SL:</th>
            <th>Employee Id</th>
            <th>Employee Name</th>
            <th>Salary</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($payroll as $key => $item)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $item['emp_id'] }}</td>
                <td>{{ $item['emp_name'] }}</td>
                <td>{{ number_format($item['salary'], 0, '.', ',') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>