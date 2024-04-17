@extends('admin.layouts/layout')
@section('admin')
    <div class="add-search">
        <div class="row">
            <div class="col-md-3">
                <button class="open-modal add" data-modal-id="addLocation">Add Location</button>
            </div>
            <div class="col-md-9 search">
                <select name="searchOption" id="searchOption" class="select-small">
                    <option value="1">Division</option>
                    <option value="2">District</option>
                    <option value="3">Upazila</option>
                </select>
                <input type="text" name="search" id="search" class="input-small" placeholder="Search here...">
            </div>
        </div>
    </div>


    <!-- table show -->
    <div class="location" style="overflow-x:auto;">
        @include('employee.location.locationPagination')
    </div>


    @include('employee.location.addLocation')

    @include('employee.location.editLocation')

    @include('employee.location.delete')

@endsection


<!-- ajax part start from here -->
@section('ajax')
    <script src="{{ asset('js/ajax/employee/location.js') }}"></script>
@endsection
