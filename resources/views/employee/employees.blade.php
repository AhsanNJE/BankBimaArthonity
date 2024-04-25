@extends('admin.layouts/layout')
@section('admin')
    <div class="add-search">
        <div class="row">
            <div class="col-md-3">
                <button class="open-modal add" data-modal-id="addEmployee">Add Employee</button>
            </div>
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
                    <option value="10">Type</option>
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
