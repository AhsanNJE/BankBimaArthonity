@extends('admin.layouts/layout')
@section('admin')
    <div class="add-search">
        <div class="row">
            <div class="col-md-3">
                <button class="open-modal add" data-modal-id="addPayrollMiddlewire">Add Payroll Middlewire</button>
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
    <div class="payroll-middlewire" style="overflow-x:auto;">
        @include('payroll.payroll_middlewire.payrollMiddlewirePagination')
    </div>


    @include('payroll.payroll_middlewire.addPayrollMiddlewire')

    @include('payroll.payroll_middlewire.editPayrollMiddlewire')

    @include('payroll.payroll_middlewire.delete')

@endsection


<!-- ajax part start from here -->
@section('ajax')
    <script src="{{ asset('js/ajax/payroll/payroll_middlewire.js') }}"></script>
    <script src="{{ asset('js/ajax/search_by_input.js') }}"></script>
@endsection
