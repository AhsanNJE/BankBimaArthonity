<table class="show-table">
    <caption class="caption">Product Details</caption>
    <thead>
        <tr>
            <th>Id</th>
            <th>Product Name</th>
            <th>Manufacturer Name</th>
            <th>Category Name</th>
            <th>Quantity</th>
            <th>Cost Price</th>
            <th>MRP</th>
            <th>Expiry Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($product as $key => $item)
            <tr>
                <td>{{ $product->firstItem() + $key }}</td>
                <td>{{ $item->Heads->tran_head_name }}</td>
                <td>{{ $item->Manufacturers->manufacturer_name }}</td>
                <td>{{ $item->Categories->category_name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->cost_price }}</td>
                <td>{{ $item->mrp }}</td>
                <td>{{ $item->expiry_date }}</td>
                <td>
                    <div style="display: flex;gap:5px;">
                        <button class="open-modal editProduct" data-modal-id="editProduct" id="edit"
                            data-id="{{ $item->id }}"><i class="fas fa-edit"></i></button>
                        <button data-modal-id="deleteProductModal" data-id="{{ $item->id }}" id="delete"><i
                                class="fas fa-trash"></i></button>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="center paginate" id="paginate">
    {!! $product->links() !!}
</div>
