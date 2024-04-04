@extends('admin.layouts/layout')
@section('admin')
    <div class="add-search">
        <div class="row">
            <div class="col-md-3">
                <button class="open-modal add" data-modal-id="addPayrollSetup">Add Payroll Setup</button>
            </div>
            <div class="col-md-9 search">
                <select name="searchOption" id="searchOption" class="select-small">
                    <option value="1">User Name</option>
                    <option value="2">Head</option>
                </select>
                <input type="text" name="search" id="search" class="input-small" placeholder="Search here...">
            </div>
        </div>
    </div>


    <!-- table show -->
    <div class="payroll-setup" style="overflow-x:auto;">
        @include('payroll.payroll_setup.payrollSetupPagination')
    </div>


    @include('payroll.payroll_setup.addPayrollSetup')

    @include('payroll.payroll_setup.editPayrollSetup')

@endsection


<!-- ajax part start from here -->
@section('ajax')
    <script src="{{ asset('js/ajax/payroll/payroll_setup.js') }}"></script>
    <script src="{{ asset('js/ajax/search_by_input.js') }}"></script>
@endsection
