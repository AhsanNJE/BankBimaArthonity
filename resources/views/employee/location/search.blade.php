<table class="show-table">
    <caption class="caption">Location Details</caption>
    <thead>
        <tr>
            <th>SL:</th>
            <th>Division</th>
            <th>District</th>
            <th>Upazila</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($location as $key => $item)
            <tr>
                <td>{{ $location->firstItem() + $key }}</td>
                <td>{{ $item->division }}</td>
                <td>{{ $item->district }}</td>
                <td>{{ $item->upazila }}</td>
                <td>
                    <div style="display: flex;gap:5px;">
                        <button class="open-modal editLocation" data-modal-id="editLocation" id="edit"
                            data-id="{{ $item->id }}"><i class="fas fa-edit"></i></button>
                        <button data-modal-id="deleteModal" data-id="{{ $item->id }}" id="delete"><i
                            class="fas fa-trash"></i></button>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>