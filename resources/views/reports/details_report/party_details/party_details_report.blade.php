@section('style')
<style>
    #search {
        width: 100%;
        margin: 0;
    }
    table{
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        margin: 20px 0;
    }
    table td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 2px 10px;
    }
</style>
@endsection


@extends('admin.layouts/layout')
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
                <label for="typeOption">Transaction Type</label>
                <select name="typeOption" id="typeOption">
                    <option value="">Select type</option>
                    <option value="receive">Receive</option>
                    <option value="payment">Payment</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="searchOption">Search Option</label>
                <select name="searchOption" id="searchOption">
                    <option value="1">Transaction User</option>
                    <option value="2">Transaction Id</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="search">Search Here</label>
                <input type="text" name="search" id="search" class="form-input" placeholder="Search here...">
            </div>
        </div>
    </div>


    <!-- table show -->
    <div class="party-details" style="overflow-x:auto;">
        @include('reports.details_report.party_details.party_details_report_pagination')
    </div>

@endsection


<!-- ajax part start from here -->
@section('ajax')
    <script src="{{ asset('js/ajax/report/party_details_report.js') }}"></script>
@endsection
