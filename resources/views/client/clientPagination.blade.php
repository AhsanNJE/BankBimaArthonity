<table class="show-table">
    <caption class="caption">Client Details</caption>
    <thead>
        <tr>
            <th>SL:</th>
            <th>Client Id</th>
            <th>Name</th>
            <th>Client Type</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Location</th>
            <th>Address</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($client as $key => $item)
            <tr>
                <td>{{ $client->firstItem() + $key }}</td>
                <td>{{ $item->user_id }}</td>
                <td>{{ $item->user_name }}</td>
                <td>{{ $item->Withs->tran_with_name }}</td>
                <td>{{ $item->user_email }}</td>
                <td>{{ $item->user_phone }}</td>
                <td>{{ $item->Location->upazila }}</td>
                <td>{{ $item->address }}</td>
                <td>
                    <div style="display: flex;gap:5px;">
                        <button class="open-modal showClientDetails" data-modal-id="showClientDetails" id="details"
                            data-id="{{ $item->user_id }}"><i class="fa-solid fa-circle-info"></i></button>
                        <button class="open-modal editClientModal" data-modal-id="editClientModal" id="edit"
                            data-id="{{ $item->id }}"><i class="fas fa-edit"></i></button>
                        <button data-modal-id="deleteModal" data-id="{{ $item->id }}" id="delete"><i
                                class="fas fa-trash"></i></button>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="center paginate" id="paginate">
    {!! $client->links() !!}
</div>
