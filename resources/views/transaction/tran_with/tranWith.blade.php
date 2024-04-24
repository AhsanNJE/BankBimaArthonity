@extends('admin.layouts/layout')
@section('admin')
    <div class="add-search">
        <div class="row">
            <div class="col-md-3">
                <button class="open-modal add" data-modal-id="addTranWith">Add Tran With</button>
            </div>
            <div class="col-md-9 search">
                <select name="searchOption" id="searchOption" class="select-small">
                    <option value="1">Name</option>
                    <option value="2">Type</option>
                </select>
                <input type="text" name="search" id="search" class="form-input" placeholder="Search here...">
            </div>
        </div>
    </div>


    <!-- table show -->
    <div class="tranwith" style="overflow-x:auto;">
        @include('transaction.tran_with.tranWithPagination')
    </div>


    @include('transaction.tran_with.addTranWith')

    @include('transaction.tran_with.editTranWith')

    @include('transaction.tran_with.delete')

@endsection


<!-- ajax part start from here -->
@section('ajax')
    <script src="{{ asset('js/ajax/transaction/tran_with.js') }}"></script>
@endsection
