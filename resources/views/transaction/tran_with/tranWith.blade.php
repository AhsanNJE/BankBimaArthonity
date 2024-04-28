@extends('admin.layouts/layout')
@section('admin')
    <div class="add-search">
        <div class="row">
            <div class="col-md-2">
                <button class="open-modal add" data-modal-id="addTranWith">Add Tran With</button>
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
                <label for="types">Tran Type</label>
                <select name="types" id="types">
                    <option value="" >Select Tran Type</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}">{{ $type->type_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label for="users">User Type</label>
                <select name="users" id="users">
                    <option value="">Select User Type</option>
                    <option value="Client">Client</option>
                    <option value="Supplier">Supplier</option>
                    <option value="Employee">Employee</option>
                    <option value="Bank">Bank</option>
                    <option value="Others">Others</option>
                </select>
            </div>
            <div class="col-md-4">
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
