@extends('admin.layouts/layout')
@section('admin')
    <div class="add-search">
        <div class="row">
            <div class="col-md-3">
                <button class="open-modal add" data-modal-id="addTransactionHead">Add Transaction Head</button>
            </div>
            <div class="col-md-9 search">
                <select name="searchOption" id="searchOption" class="select-small">
                    <option value="1">Head</option>
                    <option value="2">Groupe</option>
                </select>
                <input type="text" name="search" id="search" class="input-small" placeholder="Search here...">
            </div>
        </div>
    </div>


    <!-- table show -->
    <div class="heads" style="overflow-x:auto;">
        @include('transaction.transactionHead.transactionHeadPagination')
    </div>


    @include('transaction.transactionHead.addTransactionHead')

    @include('transaction.transactionHead.editTransactionHead')

    @include('transaction.transactionHead.delete')

@endsection


<!-- ajax part start from here -->
@section('ajax')
    <script src="{{ asset('js/ajax/transaction/transaction_head.js') }}"></script>
    <script src="{{ asset('js/ajax/search_by_input.js') }}"></script>
@endsection
