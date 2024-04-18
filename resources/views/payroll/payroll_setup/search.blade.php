<table class="show-table">
    <caption class="caption">Additional Payroll Details</caption>
    <thead>
        <tr>
            <th>SL:</th>
            <th>Employee Id</th>
            <th>Payroll Category</th>
            <th>Amount</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($payroll as $key => $item)
            <tr>
                <td>{{ $payroll->firstItem() + $key }}</td>
                <td>{{ $item->Employee->user_name }}</td>
                <td>{{ $item->Head->tran_head_name }}</td>
                <td>{{ $item->amount }}</td>
                <td>
                    <div style="display: flex;gap:5px;">
                        <button class="open-modal editPayrollSetup" data-modal-id="editPayrollSetup" id="edit"
                            data-id="{{ $item->id }}"><i class="fas fa-edit"></i></button>
                        <button data-modal-id="deleteModal" data-id="{{ $item->id }}" id="delete"><i
                            class="fas fa-trash"></i></button>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>