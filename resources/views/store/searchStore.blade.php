<table class="show-table">
    <caption class="caption">Store Details</caption>
    <thead>
        <tr>
            <th>Id</th>
            <th>Store Name</th>
            <th>Division</th>
            <th>Location</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($store as $key => $item)
            <tr>
                <td>{{ $store->firstItem() + $key }}</td>
                <td>{{ $item->store_name }}</td>
                <td>{{ $item->division }}</td>
                <td>{{ $item->Location->upazila }}</td>
                <td>
                    <div style="display: flex;gap:5px;">
                        <!-- <button class="open-modal showStoreDetails" data-modal-id="showStoreDetails" id="storedetails"
                            data-id="{{ $item->id }}"><i class="fa-solid fa-circle-info"></i></button> -->
                        <button class="open-modal editStore" data-modal-id="editStore" id="edit"
                            data-id="{{ $item->id }}"><i class="fas fa-edit"></i></button>
                        <button data-modal-id="deleteStoreModal" data-id="{{ $item->id }}" id="delete"><i
                                class="fas fa-trash"></i></button>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="center paginate" id="paginate">
    {!! $store->links() !!}
</div>
