@extends('admin.layouts/layout')
@section('admin')
    <div class="add-search">
        <div class="row">
            <div class="col-md-3">
                <button class="open-modal add" data-modal-id="addBankTransaction">Add Bank Transaction</button>
            </div>
            <div class="col-md-2">
                <label for="startDate">Start Date</label>
                <input type="date" name="startDate" id="startDate" class="form-input" value="{{ date('Y-m-d') }}">
            </div>
            <div class="col-md-2" >
                <label for="endDate">End Date</label>
                <input type="date" name="endDate" id="endDate" class="form-input" value="{{ date('Y-m-d') }}">
            </div>
            <div class="col-md-2">
                <label for="searchOption">Search Option</label>
                <select name="searchOption" id="searchOption">
                    <option value="1">Transaction Id</option>
                    <option value="2">Invoice</option>
                    <option value="3">Transaction With</option>
                    <option value="4">User</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="search">Search Here</label>
                <input type="text" name="search" id="search" class="form-input" placeholder="Search here...">
            </div>
        </div>
    </div>


    <!-- table show -->
    <div class="bank" style="overflow-x:auto;">
        @include('transaction.bank.bankTransactionPagination')
    </div>


    @include('transaction.bank.addBankTransaction')

    @include('transaction.bank.editBankTransaction')

@endsection


<!-- ajax part start from here -->
@section('ajax')
    <script src="{{ asset('js/ajax/transaction/bank.js') }}"></script>
    <script src="{{ asset('js/ajax/search_by_input.js') }}"></script>
@endsection
