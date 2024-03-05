<table class="show-table">
    <caption class="caption">Supplier Details</caption>
    <thead>
        <tr>
            <th>SL:</th>
            <th>Id</th>
            <th>Supplier Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Location</th>
            <th>Address</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($supplier as $key => $item)
            <tr>
                <td>{{ $supplier->firstItem() + $key }}</td>
                <td>{{ $item->user_id }}</td>
                <td>{{ $item->user_name }}</td>
                <td>{{ $item->user_email }}</td>
                <td>{{ $item->user_phone }}</td>
                <td>{{ $item->Location->upazila }}</td>
                <td>{{ $item->address }}</td>
                <td style="display: flex;gap:5px;">
                    <button class="btn btn-info btn-sm open-modal showSupplierDetails" data-modal-id="showSupplierDetails"
                        data-id="{{ $item->user_id }}"><i class="fa-solid fa-circle-info"></i>Details</button>
                    <button class="btn btn-info btn-sm open-modal editSupplierModal" data-modal-id="editSupplierModal"
                        data-id="{{ $item->id }}"><i class="fas fa-edit"></i>Edit</button>
                    <button class="btn btn-danger btn-sm" data-id="{{ $item->id }}" id="delete"><i
                            class="fas fa-trash"></i>Delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>SL:</th>
            <th>Id</th>
            <th>Supplier Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Location</th>
            <th>Address</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>