<table class="show-table">
    <caption class="caption">Adjustment Details</caption>
    <thead>
        <tr>
            <th>SL:</th>
            <th>Id</th>
            <th>Date</th>
            <th>Product Name</th>
            <th>Store Name</th>
            <th>Quantity</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($adjust as $key => $item)
            <tr>
                <td>{{ $adjust->firstItem() + $key }}</td>
                <td>{{ $item->tran_id }}</td>
                <td>{{ date('Y-m-d', strtotime($item->tran_date)) }}</td>
                <td>{{ $item->Head->tran_head_name }}</td>
                <td>{{ $item->Store->store_name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>
                    <div style="display: flex;gap:5px;">
                        <button class="open-modal editAdjustment" data-modal-id="editAdjustment" id="edit" data-id="{{ $item->id }}"><i class="fas fa-edit"></i></button>
                        <button data-modal-id="deleteModal" data-id="{{ $item->id }}" id="delete"><i
                                class="fas fa-trash"></i></button>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
