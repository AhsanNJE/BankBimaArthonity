@extends('admin.layouts/layout')
@section('admin')
    <div class="add-search">
        <div class="row">
            <div class="col-md-3">
                <button class="open-modal add" data-modal-id="addTranWithGroupe">Add Tranwith Groupes</button>
            </div>
            <div class="col-md-9 search">
                <select name="searchOption" id="searchOption" class="select-small">
                    <option value="1">With</option>
                    <option value="2">Groupe</option>
                </select>
                <input type="text" name="search" id="search" class="input-small" placeholder="Search here...">
            </div>
        </div>
    </div>


    <!-- table show -->
    <div class="with-groupe" style="overflow-x:auto;">
        @include('transaction.tran_with_groupe.tranWithGroupePagination')
    </div>


    @include('transaction.tran_with_groupe.addTranWithGroupe')

    @include('transaction.tran_with_groupe.editTranWithGroupe')

    @include('transaction.tran_with_groupe.delete')

@endsection


<!-- ajax part start from here -->
@section('ajax')
    <script src="{{ asset('js/ajax/transaction/transaction_with_groupe.js') }}"></script>
@endsection
