@extends('admin.layouts/layout')
@section('admin')
    <div class="add-search">
        <div class="row">
            <div class="col-md-3">
                <button class="open-modal add" data-modal-id="addStore">Add Store</button>
            </div>
            <div class="col-md-2">
                <label for="searchDivision">Division</label>
                <select name="searchDivision" id="searchDivision">
                    <option value="">All</option>
                    <option value="Dhaka">Dhaka</option>
                    <option value="Mymensingh ">Mymensingh </option>
                    <option value="Sylhet">Sylhet</option>
                    <option value="Chattogram">Chattogram</option>
                    <option value="Barishal ">Barishal </option>
                    <option value="Khulna">Khulna</option>
                    <option value="Rajshahi ">Rajshahi </option>
                    <option value="Rangpur">Rangpur</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="searchOption">Option</label>
                <select name="searchOption" id="searchOption">
                    <option value="1">Store Name</option>
                    <option value="2 ">Location </option>
                </select>
            </div>
            <div class="col-md-5">
                <label for="search">Search</label>
                <input type="text" name="search" id="search" class="form-input" placeholder="Search here..."
                    style="width: 100%;">
            </div>
        </div>
    </div>
    
    <!-- table show -->
    <div class="store" style="overflow-x:auto;">
        @include('store.storePagination')
    </div>


    @include('store.addStore')

    @include('store.editStore')

    @include('store.deleteStore')

@endsection

{{-- ajax part start from here --}}
@section('ajax')
    <script src="{{ asset('js/ajax/store/store_info.js') }}"></script>
    <script src="{{ asset('js/ajax/search_by_input.js') }}"></script>
@endsection
