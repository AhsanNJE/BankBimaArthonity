@extends('admin.layouts/layout')
@section('admin')
    <div class="add-search">
        <div class="row">
            <div class="col-md-3">
                <button class="open-modal add" data-modal-id="addInventoryIssue">Add Inventory Issue</button>
            </div>
            <div class="col-md-2">
                <label for="startDate">Start Date</label>
                <input type="date" name="startDate" id="startDate" class="form-input" value="{{ date('Y-m-d') }}">
            </div>
            <div class="col-md-2" >
                <label for="endDate">End Date</label>
                <input type="date" name="endDate" id="endDate" class="form-input" value="{{ date('Y-m-d') }}">
            </div>
            <div class="col-md-2">
                <label for="searchOption">Search Option</label>
                <select name="searchOption" id="searchOption">
                    <option value="1">Transaction Id</option>
                    <option value="2">User</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="search">Search Here</label>
                <input type="text" name="search" id="search" class="form-input" placeholder="Search here...">
            </div>
        </div>
    </div>


    <!-- table show -->
    <div class="inv-issue" style="overflow-x:auto;">
        @include('inventory.issue.inventoryIssuePagination')
    </div>


    @include('inventory.issue.addInventoryIssue')

    @include('inventory.issue.editInventoryIssue')

    @include('transaction.printDetails')

@endsection


<!-- ajax part start from here -->
@section('ajax')
    <script src="{{ asset('js/ajax/inventory/inv_issue.js') }}"></script>
    <script src="{{ asset('js/ajax/search_by_input.js') }}"></script>
@endsection
