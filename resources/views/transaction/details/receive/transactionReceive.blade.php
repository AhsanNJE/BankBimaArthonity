@extends('admin.layouts/layout')
@section('admin')
    <div class="add-search">
        <div class="row">
            <div class="col-md-3">
                <button class="open-modal add" data-modal-id="addTransaction">Add Transaction Receive</button>
            </div>
            <div class="col-md-9 search">
                <input type="date" name="startDate" id="startDate" class="form-input" value="{{ date('Y-m-d') }}">
                <input type="date" name="endDate" id="endDate" class="form-input" value="{{ date('Y-m-d') }}">
                <input type="text" name="search" id="search" class="form-input" placeholder="Search here...">
            </div>
        </div>
    </div>


    <!-- table show -->
    <div class="details">
        @include('transaction.details.receive.transactionReceivePagination')
    </div>


    @include('transaction.details.receive.addTransactionReceive')

    @include('transaction.details.receive.editTransactionReceive')

@endsection


<!-- ajax part start from here -->
@section('ajax')
    <script src="{{ asset('js/ajax/transaction/transaction_receive.js') }}"></script>
    <script src="{{ asset('js/ajax/search_by_input.js') }}"></script>
@endsection
