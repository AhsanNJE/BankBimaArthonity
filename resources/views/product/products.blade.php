@section('style')
    <style>
        .modal-subject {
            width: 80%;
        }
        .designation{
            color: #0af7b7f5;
            font-size: 20px;
        }
        .payroll table{
            margin: 20px 0;
        }
        .show-table td, th {
            border: 1px solid #4f4a4a63;
        }
        .add-search .row {
            justify-content: center; /* This will center the row's contents horizontally */
        }

        .search {
            display: flex;
            justify-content: center; /* This centers the children of the 'search' div */
            flex-wrap: wrap; /* Allows elements to wrap into the next line if needed */
        }
    </style>
@endsection

@extends('admin.layouts/layout')
@section('admin')
    <div class="add-search">
        <div class="row">
            <div class="col-md-9 search">
                <select name="searchOption" id="searchOption" class="select-small">
                    <option value="1">Product Name</option>
                    <option value="2">Manufacturer Name</option>
                    <option value="3">Category Name</option>
                </select>
                <input type="text" name="search" id="search" class="input-small" placeholder="Search here..."
                    style="width: 40%;">
            </div>
        </div>
    </div>
    
    <!-- table show -->
    <div class="product" style="overflow-x:auto;">
        @include('product.productPagination')
    </div>

    @include('product.editProduct')

    @include('product.deleteProduct')

@endsection

{{-- ajax part start from here --}}
@section('ajax')
    <script src="{{ asset('js/ajax/product/product_info.js') }}"></script>
    <script src="{{ asset('js/ajax/search_by_input.js') }}"></script>
@endsection
