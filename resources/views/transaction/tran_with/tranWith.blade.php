@extends('admin.layouts/layout')
@section('admin')
    <div class="add-search">
        <div class="row">
            <div class="col-md-3">
                <button class="open-modal add" data-modal-id="addTranWith">Add Tran With</button>
            </div>
            <div class="col-md-2">
                <label for="methods">Method</label>
                <select name="methods" id="methods">
                    <option>Select Method</option>
                    <option value="Receive">Receive</option>
                    <option value="Payment">Payment</option>
                    <option value="Both">Both</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="searchOption">Search Option</label>
                <select name="searchOption" id="searchOption">
                    <option value="1">Name</option>
                    <option value="2">User Type</option>
                    <option value="3">Tran Type</option>
                    <option value="4">Tran Method</option>
                </select>
            </div>
            <div class="col-md-5">
                <label for="search">Search</label>
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
