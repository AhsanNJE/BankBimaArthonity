<table class="show-table">
    <caption class="caption">category Details</caption>
    <thead>
        <tr>
            <th>Id</th>
            <th>Category Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($category as $key => $item)
            <tr>
                <td>{{ $category->firstItem() + $key }}</td>
                <td>{{ $item->category_name }}</td>
                <td>
                    <div style="display: flex;gap:5px;">
                        <!-- <button class="open-modal showcategoryDetails" data-modal-id="showcategoryDetails" id="categorydetails"
                            data-id="{{ $item->id }}"><i class="fa-solid fa-circle-info"></i></button> -->
                        <button class="open-modal editcategory" data-modal-id="editcategory" id="edit"
                            data-id="{{ $item->id }}"><i class="fas fa-edit"></i></button>
                        <button data-modal-id="deletecategoryModal" data-id="{{ $item->id }}" id="delete"><i
                                class="fas fa-trash"></i></button>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="center paginate" id="paginate">
    {!! $category->links() !!}
</div>
