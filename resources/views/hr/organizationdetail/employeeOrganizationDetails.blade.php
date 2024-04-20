@extends('admin.layouts/layout')
@section('admin')
    <div class="add-search">
        <div class="row">
            <div class="col-md-3">
                <button class="open-modal add" data-modal-id="EmployeeOrganization">Add Organization Detail</button>
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
                </select>
                <input type="text" name="search" id="search" class="input-small" placeholder="Search here...">
            </div>
        </div>
    </div>

    <!-- table show -->
    <div class="employee" style="overflow-x:auto;">
        @include('hr.organizationdetail.employeeOrganizationDetailPage')
    </div>
    @include('hr.organizationdetail.addOrganizationDetail')
    @include('hr.organizationdetail.employeeOrganizationFullDetail')
    @endsection

@section('ajax')
    <script src="{{ asset('js/ajax/hr/employees.js') }}"></script>
@endsection
