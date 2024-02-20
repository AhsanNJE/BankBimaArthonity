@extends('admin.layouts/layout')
@section('admin')
    <div class="add-search">
        <div class="row">
            <div class="col-md-3">
                <button class="open-modal add" data-modal-id="addTransactionReceive">Add Transaction Receive Details</button>
            </div>
            <div class="col-md-9 search">
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
    <script src="{{ asset('js/ajax/searchByInput.js') }}"></script>
@endsection
