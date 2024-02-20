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
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="updateDate">Date</label>
                                        <input type="text" name="date" class="form-control" id="updateDate"
                                            value="{{ date('Y-m-d') }}" disabled>
                                        <span class="text-danger error" id="update_date_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="updateType">Transaction Type</label>
                                        <select name="type" id="updateType">
                                            
                                        </select>
                                        <span class="text-danger error" id="update_type_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="updateTranId">Transaction Id</label>
                                        <input type="text" name="tranId" class="form-control" id="updateTranId"
                                            readonly>
                                        <span class="text-danger error" id="update_tranId_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="updateInvoice">Invoice No</label>
                                        <input type="text" name="invoice" class="form-control" id="updateInvoice" readonly>
                                        <span class="text-danger error" id="update_invoice_error"></span>
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
                                <div class="col-md-4">
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
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="updateGroupe">Transaction Groupe</label>
                                        <select name="groupe" id="updateGroupe">
                                            <option value="">Select Transaction Groupe</option>
                                            @foreach ($groupes as $groupe)
                                                <option value="{{ $groupe->id }}">{{ $groupe->tran_groupe_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger error" id="update_groupe_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="updateHead">Transaction Head</label>
                                        <select name="head" id="updateHead">
                                            <option value="">Select Transaction Head</option>
                                            {{-- options will be display dynamicaly depending on transaction groupe --}}
                                        </select>
                                        <span class="text-danger error" id="update_head_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="updateQuantity">Quantity</label>
                                        <input type="text" name="quantity" class="form-control" id="updateQuantity" value="1">
                                        <span class="text-danger error" id="update_quantity_error"></span>
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
                                    <button type="submit" id="UpdateTransaction"
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
