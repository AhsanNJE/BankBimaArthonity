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
                    <option value="1">Groupe</option>
                    <option value="2">Head</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="search">Search Here</label>
                <input type="text" name="search" id="search" class="form-input" placeholder="Search here...">
            </div>
        </div>
    </div>


    <!-- table show -->
    <div class="summary-report" style="overflow-x:auto;">
        @include('reports.summary_report.summary_report_pagination')
    </div>

@endsection


<!-- ajax part start from here -->
@section('ajax')
    <script src="{{ asset('js/ajax/report/summary_report.js') }}"></script>
@endsection
