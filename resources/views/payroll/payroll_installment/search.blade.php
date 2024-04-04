<table class="show-table">
    <thead>
        <caption class="caption">Payroll Installment</caption>
        <tr>
            <th>SL:</th>
            <th>Employee Id</th>
            <th>Payroll Category</th>
            <th>Amount</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        {{-- @foreach ($payroll as $key => $item)
            <tr>
                <td>{{ $payroll->firstItem() + $key }}</td>
                <td>{{ $item->Employee->user_name }}</td>
                <td>{{ $item->Head->tran_head_name }}</td>
                <td>{{ $item->amount }}</td>
                <td style="display: flex;gap:5px;">
                    <button class="btn btn-info btn-sm open-modal editPayrollSetup" data-modal-id="editPayrollSetup"
                        data-id="{{ $item->id }}"><i class="fas fa-edit"></i>Edit</button>
                    <button class="btn btn-danger btn-sm" data-id="{{ $item->id }}" id="delete"><i
                            class="fas fa-trash"></i>Delete</button>
                </td>
            </tr>
        @endforeach --}}
    </tbody>
</table>


