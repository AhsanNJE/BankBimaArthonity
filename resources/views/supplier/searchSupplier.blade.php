<table class="show-table">
    <caption class="caption">Supplier Details</caption>
    <thead>
        <tr>
            <th>SL:</th>
            <th>Supplier Name</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Address</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($supplier as $key => $item)
            <tr>
                <td>{{ $supplier->firstItem() + $key }}
                </td>
                <td>{{ $item->sup_name }}</td>
                <td>{{ $item->sup_email }}</td>
                <td>{{ $item->sup_contact }}</td>
                <td>{{ $item->sup_address }}</td>
                <td style="display: flex;gap:5px;">
                    <button class="btn btn-info btn-sm open-modal editSupplierModal" data-modal-id="editSupplierModal"
                        data-id="{{ $item->id }}"><i class="fas fa-edit"></i>Edit</button>
                    <button class="btn btn-danger btn-sm deleteSupplier" data-id="{{ $item->id }}" id="delete"><i
                            class="fas fa-trash"></i>Delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>SL:</th>
            <th>Supplier Name</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Address</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>

