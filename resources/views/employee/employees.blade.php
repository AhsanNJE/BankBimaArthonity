@section('style')
    <style>
        .modal-subject {
            width: 80%;
        }
        .designation{
            color: #0af7b7f5;
            font-size: 20px;
        }
        .payroll table{
            margin: 20px 0;
        }
        .show-table td, th {
            border: 1px solid #4f4a4a63;
        }
        .add-search .row {
            justify-content: center; /* This will center the row's contents horizontally */
        }

        .search {
            display: flex;
            justify-content: center; /* This centers the children of the 'search' div */
            flex-wrap: wrap; /* Allows elements to wrap into the next line if needed */
        }
    </style>
@endsection

@extends('admin.layouts/layout')
@section('admin')
<div class="add-search">
    <div class="row justify-content-center">
        <div class="col-md-9 search">
            <select name="searchOption" id="searchOption" class="select-small">
                <option value="1">Name</option>
                <option value="2">Email</option>
                <option value="3">Phone</option>
                <option value="4">Location</option>
                <option value="5">Address</option>
                <option value="6">Nid</option>
                <option value="7">Dob</option>
                <option value="8">Department</option>
                <option value="9">Designation</option>
            </select>
            <input type="text" name="search" id="search" class="input-small" placeholder="Search here...">
        </div>
    </div>
</div>



    <!-- table show -->
    <div class="employee" style="overflow-x:auto;">
        @include('employee.employeePagination')
    </div>


    @include('employee.addEmployee')

    @include('employee.editEmployee')
    
    @include('employee.employeeDetails')

    @include('employee.delete')

@endsection


<!-- ajax part start from here -->
@section('ajax')
    <script src="{{ asset('js/ajax/employee/employee.js') }}"></script>
    <script src="{{ asset('js/ajax/search_by_input.js') }}"></script>
@endsection
