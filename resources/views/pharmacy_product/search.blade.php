<table class="show-table">
    <caption class="caption">Pharmacy Product</caption>
    <thead>
        <tr>
            <th>SL:</th>
            <th>Product Name</th>
            <th>Transaction Groupe</th>
            <th>Category Name</th>
            <th>Manufacture Name</th>
            <th>Item Form Name</th>
            <th>Unite Name</th>
            <th>Store Name</th>
            <th>Quantity</th>
            <th>Cost Price</th>
            <th>MRP</th>
            <th>Expired Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($heads as $key => $item)
            <tr>
                <td>{{ $heads->firstItem() + $key }}</td>
                <td>{{ $item->tran_head_name }}</td>
                <td>{{ $item->Groupe->tran_groupe_name }}</td>
                <td>{{ $item->Category->category_name }}</td>
                <td>{{ $item->Manufecture->manufacturer_name }}</td>
                <td>{{ $item->ItemForm->form_name }}</td>
                <td>{{ $item->ItemUnite->unite_name }}</td>
                <td>{{ $item->store }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->cost_price }}</td>
                <td>{{ $item->mrp }}</td>
                <td>{{ $item->expired_date }}</td>
                <td>
                    <div style="display: flex;gap:5px;">
                        <button class="open-modal editPharmacyProduct" data-modal-id="editPharmacyProduct" id="edit"
                            data-id="{{ $item->id }}"><i class="fas fa-edit"></i></button>
                        <button data-modal-id="deleteModal" data-id="{{ $item->id }}" id="delete"><i
                                class="fas fa-trash"></i></button>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>