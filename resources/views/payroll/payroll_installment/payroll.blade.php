@section('style')
    <style>
        #search {
            width: 100%;
            margin: 0;
        }
    </style>
@endsection


@extends('admin.layouts/layout')
@section('admin')
    <div class="add-search">
        <div class="row">
            <div class="col-md-3">
                <button class="add" id="PayrollProcess" data-modal-id="confirmPayrollModal"><i
                    class="fa-solid fa-rotate"></i> Process Payroll</button>
            </div>
            <div class="col-md-2">
                <label for="month">Month</label>
                <select name="month" id="month">
                    <option value="01" {{ date('m') == '01' ? 'selected' : '' }}>January</option>
                    <option value="02" {{ date('m') == '02' ? 'selected' : '' }}>February</option>
                    <option value="03" {{ date('m') == '03' ? 'selected' : '' }}>March</option>
                    <option value="04" {{ date('m') == '04' ? 'selected' : '' }}>April</option>
                    <option value="05" {{ date('m') == '05' ? 'selected' : '' }}>May</option>
                    <option value="06" {{ date('m') == '06' ? 'selected' : '' }}>June</option>
                    <option value="07" {{ date('m') == '07' ? 'selected' : '' }}>July</option>
                    <option value="08" {{ date('m') == '08' ? 'selected' : '' }}>August</option>
                    <option value="09" {{ date('m') == '09' ? 'selected' : '' }}>September</option>
                    <option value="10" {{ date('m') == '10' ? 'selected' : '' }}>October</option>
                    <option value="11" {{ date('m') == '11' ? 'selected' : '' }}>November</option>
                    <option value="12" {{ date('m') == '12' ? 'selected' : '' }}>December</option>
                </select>
            </div>
            <div class="col-md-1">
                <label for="year">Year</label>
                <select name="year" id="year">
                    @for ($year = date('Y'); $year >= 2000; $year--)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-6">
                <label for="Search">Search</label>
                <input type="text" name="search" id="search" class="form-input" placeholder="Search Employee here...">
            </div>
        </div>
    </div>


    <!-- table show -->
    <div class="payroll-installment" style="overflow-x:auto;">
        @include('payroll.payroll_installment.payrollPagination')
    </div>

    @include('payroll.payroll_installment.editPayroll')

    @include('payroll.payroll_installment.process')

@endsection


<!-- ajax part start from here -->
@section('ajax')
    <script src="{{ asset('js/ajax/payroll/payroll.js') }}"></script>
    <script src="{{ asset('js/ajax/search_by_input.js') }}"></script>
@endsection