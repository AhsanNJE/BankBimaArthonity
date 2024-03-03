@section('style')
    <style>
        .modal-subject {
            width: 80%;
        }
    </style>
@endsection

<div id="editTransaction" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading">
            <h3 class="center">Edit Party Payments</h3>
            <span class="close-modal" data-modal-id="editTransaction">&times;</span>
        </div>

        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Edit Party Payments</h3>
                    </div>
                </div>

                <!-- form start -->
                <form id="EditPartyForm" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="id" id="id">
                                <input type="hidden" name="dId" id="dId">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="updateDate">Date</label>
                                        <input type="text" name="date" class="form-control" id="updateDate"
                                            value="{{ date('Y-m-d') }}" disabled>
                                        <span class="text-danger error" id="update_date_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="updateTranId">Transaction Id</label>
                                        <input type="text" name="tranId" class="form-control" id="updateTranId"
                                            readonly>
                                        <span class="text-danger error" id="update_tranId_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="updateLocation">Location</label>
                                        <input type="text" name="location" class="form-control" id="updateLocation"
                                            autocomplete="off" readonly>
                                        <div id="update-location">
                                            <ul>

                                            </ul>
                                        </div>
                                        <span class="text-danger error" id="update_location_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="updateWith">Transaction With</label>
                                        <select name="with" id="updateWith">

                                        </select>
                                        <span class="text-danger error" id="update_head_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="updateUser">Transaction User</label>
                                        <input type="text" name="user" class="form-control" id="updateUser" autocomplete="off" readonly>
                                        <div id="user-list">
                                            <ul>

                                            </ul>
                                        </div>
                                        <span class="text-danger error" id="update_user_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="updateAmount">Amount</label>
                                        <input type="text" name="amount" class="form-control" id="updateAmount">
                                        <span class="text-danger error" id="update_amount_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="updateTotAmount">Total</label>
                                        <input type="text" name="totAmount" class="form-control" id="updateTotAmount" readonly>
                                        <span class="text-danger error" id="update_totAmount_error"></span>
                                    </div>
                                </div>
                                <div class="center">
                                    <button type="submit" id="UpdateParty"
                                        class="btn btn-success addButton">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
