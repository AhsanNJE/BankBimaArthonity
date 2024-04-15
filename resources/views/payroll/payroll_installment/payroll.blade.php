@extends('admin.layouts/layout')
@section('admin')
    <div class="add-search">
        <div class="row">
            <div class="col-md-3">
                <button class="open-modal add" data-modal-id="addPayroll">Add Payroll</button>
            </div>
            <div class="col-md-6 search">
                <input type="text" name="search" id="search" class="input-small" placeholder="Search here...">
            </div>
            <div class="col-md-3">
                <button class="add" id="PayrollProcess"><i class="fa-solid fa-rotate"></i> Process Payroll</button>
            </div>
        </div>
    </div>


    <!-- table show -->
    <div class="payroll-installment" style="overflow-x:auto;">
        @include('payroll.payroll_installment.payrollPagination')
    </div>


    @include('payroll.payroll_installment.addPayroll')

    @include('payroll.payroll_installment.editPayroll')

@endsection


<!-- ajax part start from here -->
@section('ajax')
    <script src="{{ asset('js/ajax/payroll/payroll.js') }}"></script>
    <script src="{{ asset('js/ajax/search_by_input.js') }}"></script>
@endsection
