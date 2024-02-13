@extends('admin.layouts/layout')
@section('admin')
    <div class="add-search">
        <div class="row">
            <div class="col-md-3">
                <button class="open-modal add" data-modal-id="addDepartment">Add Department</button>
            </div>
            <div class="col-md-9 search">
                <input type="text" name="search" id="search" class="form-input" placeholder="Search here...">
            </div>
        </div>
    </div>


    <!-- table show -->
    <div class="department">
        @include('employee.department.departmentPagination')
    </div>


    @include('employee.department.addDepartment')

    @include('employee.department.editDepartment')

@endsection


<!-- ajax part start from here -->
@section('ajax')
    <script src="{{ asset('js/ajax/employee/department.js') }}"></script>
@endsection
