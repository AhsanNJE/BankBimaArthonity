@extends('admin.layouts/layout')
@section('admin')
    <div class="add-search">
        <div class="row">
            <div class="col-md-3">
                <button class="open-modal add" data-modal-id="addTransactionGroupe">Add Transaction Groupes</button>
            </div>
            <div class="col-md-9 search">
                <input type="text" name="search" id="search" class="form-input" placeholder="Search here...">
            </div>
        </div>
    </div>


    <!-- table show -->
    <div class="groupe" style="overflow-x:auto;">
        @include('transaction.transactionGroupe.transactionGroupePagination')
    </div>


    @include('transaction.transactionGroupe.addTransactionGroupe')

    @include('transaction.transactionGroupe.editTransactionGroupe')

    @include('transaction.transactionGroupe.delete')

@endsection


<!-- ajax part start from here -->
@section('ajax')
    <script src="{{ asset('js/ajax/transaction/transaction_groupe.js') }}"></script>
@endsection
