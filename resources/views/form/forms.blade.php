@extends('admin.layouts/layout')
@section('admin')
    <div class="add-search">
        <div class="row">
            <div class="col-md-3">
                <button class="open-modal add" data-modal-id="addForm">Add Form</button>
            </div>
            <div class="col-md-9 search">
                <input type="text" name="searchOption" id="searchOption" class="select-small" value="Name" readonly style="width: 100px;">
                <input type="text" name="search" id="search" class="input-small" placeholder="Search here..."
                    style="width: 40%;">
            </div>
        </div>
    </div>
    
    <!-- table show -->
    <div class="form" style="overflow-x:auto;">
        @include('form.formPagination')
    </div>

    @include('form.addForm')

    @include('form.editForm')

    @include('form.deleteForm')

@endsection

{{-- ajax part start from here --}}
@section('ajax')
    <script src="{{ asset('js/ajax/form/item_form.js') }}"></script>
    <script src="{{ asset('js/ajax/search_by_input.js') }}"></script>
@endsection
