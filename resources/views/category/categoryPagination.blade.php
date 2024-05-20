<table class="show-table">
    <caption class="caption">Category Details</caption>
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
                        <!-- <button class="open-modal showCategoryDetails" data-modal-id="showCategoryDetails" id="categorydetails"
                            data-id="{{ $item->id }}"><i class="fa-solid fa-circle-info"></i></button> -->
                        <button class="open-modal editCategory" data-modal-id="editCategory" id="edit"
                            data-id="{{ $item->id }}"><i class="fas fa-edit"></i></button>
                        <button data-modal-id="deleteCategoryModal" data-id="{{ $item->id }}" id="delete"><i
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
