@section('style')
<style>
    #search {
        width: 100%;
        margin: 0;
    }
    .opening{
        display: flex;
        gap: 5px;
        align-items: center;
        margin-bottom: 5px;
        justify-content: center;
    }
</style>
@endsection


@extends('admin.layouts.layout')
@section('admin')
    <div class="add-search">
        <div class="row">
            <div class="col-md-2">
                <label for="startDate">Start Date</label>
                <input type="date" name="startDate" id="startDate" class="form-input" value="{{ date('Y-m-d') }}">
            </div>
            <div class="col-md-2" >
                <label for="endDate">End Date</label>
                <input type="date" name="endDate" id="endDate" class="form-input" value="{{ date('Y-m-d') }}">
            </div>
            <div class="col-md-2">
                <label for="methodOption">Transaction method</label>
                <select name="methodOption" id="methodOption">
                    <option value="">Select method</option>
                    <option value="Receive">Receive</option>
                    <option value="Payment">Payment</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="searchOption">Search Option</label>
                <select name="searchOption" id="searchOption">
                    <option value="1">Transaction User</option>
                    <option value="2">Transaction With</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="search">Search Here</label>
                <input type="text" name="search" id="search" class="form-input" placeholder="Search here...">
            </div>
        </div>
    </div>


    <!-- table show -->
    <div class="summary-balance" style="overflow-x:auto;">
        @include('reports.balance_sheet.summary.summaryBalanceSheetPagination')
    </div>

@endsection


<!-- ajax part start from here -->
@section('ajax')
    <script src="{{ asset('js/ajax/report/summary_balance_sheet.js') }}"></script>
@endsection
