@extends('admin.layouts/layout')
@section('admin')
    <div class="add-search">
        <div class="row">
            <div class="col-md-3">
                <button class="open-modal add" data-modal-id="addPhamacyProduct">Add Pharmacy Product</button>
            </div>
            <div class="col-md-9 search">
                <select name="searchOption" id="searchOption" class="select-small">
                    <option value="1">Head</option>
                    <option value="2">Groupe</option>
                    <option value="3">Category</option>
                    <option value="4">Manufacture</option>
                    <option value="5">Item Form</option>
                    <option value="6">Unite</option>
                    <option value="7">Quantity</option>
                    <option value="8">Cost Price</option>
                    <option value="9">MRP</option>
                    <option value="10">Expired Date</option>
                </select>
                <input type="text" name="search" id="search" class="input-small" placeholder="Search here...">
            </div>
        </div>
    </div>


    <!-- table show -->
    <div class="heads" style="overflow-x:auto;">
        @include('pharmacy_product.pharmacyProductPagination')
    </div>


    @include('pharmacy_product.addPharmacyProduct')

    @include('pharmacy_product.editPharmacyProduct')

    @include('pharmacy_product.delete')

@endsection


<!-- ajax part start from here -->
@section('ajax')
    <!-- <script src="{{ asset('js/ajax/pharmacyproduct/pharmacy_product.js') }}"></script> -->
    <script src="{{ asset('js/ajax/search_by_input.js') }}"></script>
@endsection
