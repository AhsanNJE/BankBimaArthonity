@extends('admin.layouts/layout')
@section('admin')
    <div class="add-search">
        <div class="row">
            <div class="col-md-3">
                <button class="open-modal add" data-modal-id="addClientModal">Add Client</button>
            </div>
            <div class="col-md-9 search">
                <select name="searchOption" id="searchOption" class="select-small">
                    <option value="1">Name</option>
                    <option value="2">Email</option>
                    <option value="3">Phone</option>
                    <option value="4">Location</option>
                    <option value="5">Address</option>
                </select>
                <input type="text" name="search" id="search" class="input-small" placeholder="Search here...">
            </div>
        </div>
    </div>


    <!-- table show -->
    <div class="client" style="overflow-x:auto;">
        @include('client.clientPagination')
    </div>


    @include('client.addClientModal')

    @include('client.editClientModal')

@endsection


<!-- ajax part start from here -->
@section('ajax')
    <script src="{{ asset('js/ajax/client/client_info.js') }}"></script>
    <script src="{{ asset('js/ajax/search_by_input.js') }}"></script>
@endsection
