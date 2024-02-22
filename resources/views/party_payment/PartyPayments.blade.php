@extends('admin.layouts/layout')
@section('admin')
    <div class="add-search">
        <div class="row">
            <div class="col-md-3">
                <button class="open-modal add" data-modal-id="addTransaction">Add Party Payments</button>
            </div>
            <div class="col-md-9 search">
                <input type="date" name="startDate" id="startDate" class="form-input">
                <input type="date" name="endDate" id="endDate" class="form-input">
                <input type="text" name="search" id="search" class="form-input" placeholder="Search here...">
            </div>
        </div>
    </div>


    <!-- table show -->
    <div class="party">
        @include('party_payment.partyPaymentPagination')
    </div>


    @include('party_payment.addPartyPayments')

    @include('party_payment.editPartyPayments')

@endsection


<!-- ajax part start from here -->
@section('ajax')
    <script src="{{ asset('js/ajax/party_payment/party_payments.js') }}"></script>
    <script src="{{ asset('js/ajax/search_by_input.js') }}"></script>
@endsection
