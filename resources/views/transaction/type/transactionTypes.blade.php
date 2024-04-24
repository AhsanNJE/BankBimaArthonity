@extends('admin.layouts/layout')
@section('admin')
    <div class="add-search">
        <div class="row">
            <div class="col-md-3">
                <button class="open-modal add" data-modal-id="addTransactionType">Add Transaction Types</button>
            </div>
            <div class="col-md-9 search">
                <input type="text" name="search" id="search" class="form-input" placeholder="Search here...">
            </div>
        </div>
    </div>


    <!-- table show -->
    <div class="types" style="overflow-x:auto;">
        @include('transaction.type.transactionTypePagination')
    </div>


    @include('transaction.type.addTransactionType')

    @include('transaction.type.editTransactionType')

    @include('transaction.type.delete')

@endsection


<!-- ajax part start from here -->
@section('ajax')
    <script src="{{ asset('js/ajax/transaction/transaction_type.js') }}"></script>
@endsection
