@extends('admin.layouts/layout')
@section('admin')
    <div class="add-search">
        <div class="row">
            <div class="col-md-3">
                <button class="open-modal add" data-modal-id="addUnit">Add Unit</button>
            </div>
            <div class="col-md-9 search">
                <input type="text" name="searchOption" id="searchOption" class="select-small" value="Name" readonly style="width: 100px;">
                <input type="text" name="search" id="search" class="input-small" placeholder="Search here..."
                    style="width: 40%;">
            </div>
        </div>
    </div>
    
    <!-- table show -->
    <div class="unit" style="overflow-x:auto;">
        @include('unit.unitPagination')
    </div>

    @include('unit.addUnit')

    @include('unit.editUnit')

    @include('unit.deleteUnit')

@endsection

{{-- ajax part start from here --}}
@section('ajax')
    <script src="{{ asset('js/ajax/unit/item_unit.js') }}"></script>
    <script src="{{ asset('js/ajax/search_by_input.js') }}"></script>
@endsection
