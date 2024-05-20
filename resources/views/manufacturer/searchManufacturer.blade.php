<table class="show-table">
    <caption class="caption">Manufacturer Details</caption>
    <thead>
        <tr>
            <th>Id</th>
            <th>Manufacturer Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($manufacturer as $key => $item)
            <tr>
                <td>{{ $manufacturer->firstItem() + $key }}</td>
                <td>{{ $item->manufacturer_name }}</td>
                <td>
                    <div style="display: flex;gap:5px;">
                        <!-- <button class="open-modal showManufacturerDetails" data-modal-id="showManufacturerDetails" id="manufacturerdetails"
                            data-id="{{ $item->id }}"><i class="fa-solid fa-circle-info"></i></button> -->
                        <button class="open-modal editManufacturer" data-modal-id="editManufacturer" id="edit"
                            data-id="{{ $item->id }}"><i class="fas fa-edit"></i></button>
                        <button data-modal-id="deleteManufacturerModal" data-id="{{ $item->id }}" id="delete"><i
                                class="fas fa-trash"></i></button>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="center paginate" id="paginate">
    {!! $manufacturer->links() !!}
</div>
