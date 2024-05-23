<table class="show-table">
    <caption class="caption">Form Details</caption>
    <thead>
        <tr>
            <th>Id</th>
            <th>Unit Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($unit as $key => $item)
            <tr>
                <td>{{ $unit->firstItem() + $key }}</td>
                <td>{{ $item->unit_name }}</td>
                <td>
                    <div style="display: flex;gap:5px;">
                        <button class="open-modal editUnit" data-modal-id="editUnit" id="edit"
                            data-id="{{ $item->id }}"><i class="fas fa-edit"></i></button>
                        <button data-modal-id="deleteUnitModal" data-id="{{ $item->id }}" id="delete"><i
                                class="fas fa-trash"></i></button>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="center paginate" id="paginate">
    {!! $unit->links() !!}
</div>
