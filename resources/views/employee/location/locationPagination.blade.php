<table class="show-table">
    <thead>
        <caption class="caption">Location Details</caption>
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
                <td style="display: flex;gap:5px;">
                    <button class="btn btn-info btn-sm open-modal editLocation" data-modal-id="editLocation"
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
            <th>Division</th>
            <th>District</th>
            <th>Upazila</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>

<div class="center paginate" id="paginate">
    {!! $location->links() !!}
</div>
