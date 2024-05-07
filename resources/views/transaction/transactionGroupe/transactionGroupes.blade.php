@extends('admin.layouts/layout')
@section('admin')
    <div class="add-search">
        <div class="row">
            <div class="col-md-3">
                <button class="open-modal add" data-modal-id="addTransactionGroupe">Add Transaction Groupes</button>
            </div>
            <div class="col-md-2">
                <label for="methods">Method</label>
                <select name="methods" id="methods">
                    <option value="">Select Method</option>
                    <option value="Receive">Receive</option>
                    <option value="Payment">Payment</option>
                    <option value="Both">Both</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="types">Groupe Type</label>
                <select name="types" id="types">
                    <option value="" >Select GroupType</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}">{{ $type->type_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-5">
                <label for="search">Search</label>
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
