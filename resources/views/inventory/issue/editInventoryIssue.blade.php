<div id="editTransaction" class="modal-container">
    <div class="modal-subject">
        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Edit Inventory Issue</h3>
                        <span class="close-modal" data-modal-id="editTransaction">&times;</span>
                    </div>
                </div>

                <!-- form start -->
                <form id="EditInventoryIssueForm" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div id="updatewithin" style="display: none"> </div>
                            <div id="updategroupein" style="display: none">
                                @foreach ($groupes as $groupe)
                                <input type="checkbox" id="groupe[]" name="groupe" class="updategroupe-checkbox" value="{{$groupe->id}}" checked>
                                @endforeach
                            </div>
                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="dId" id="dId">
                            <input type="hidden" name="tranId" id="updateTranId">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="updateDate">Date</label>
                                        <input type="text" name="date" class="form-control" id="updateDate"
                                            value="{{ date('Y-m-d') }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="updateUser">Transaction User</label>
                                        <input type="text" name="user" class="form-control" id="updateUser"
                                            autocomplete="off">
                                        <div id="update-user">
                                            <ul>

                                            </ul>
                                        </div>
                                        <span class="text-danger error" id="update_user_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="updateLocation">Location</label>
                                        <input type="text" name="location" class="form-control" id="updateLocation"
                                            autocomplete="off">
                                        <div id="update-location">
                                            <ul>

                                            </ul>
                                        </div>
                                        <span class="text-danger error" id="update_location_error"></span>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="updateHead">Transaction Head</label>
                                        <input type="text" name="head" id="updateHead" class="form-control">
                                        <div id="update-head">
                                            <ul>

                                            </ul>
                                        </div>
                                        <span class="text-danger error" id="update_head_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="updateQuantity">Quantity</label>
                                        <input type="text" name="quantity" class="form-control" id="updateQuantity" value="1">
                                        <span class="text-danger error" id="update_quantity_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="updateAmount">Amount</label>
                                        <input type="text" name="amount" class="form-control" id="updateAmount">
                                        <span class="text-danger error" id="update_amount_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="updateTotAmount">Total</label>
                                        <input type="text" name="totAmount" class="form-control" id="updateTotAmount"
                                            readonly>
                                        <span class="text-danger error" id="update_totAmount_error"></span>
                                    </div>
                                </div>
                                <div class="center">
                                    <button type="submit" id="UpdateInventoryIssue" class="btn btn-success">Add</button>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="update_transaction_grid" style="overflow-x:auto;">
                                <table class="show-table">
                                    <thead>
                                        <tr>
                                            <th>SL:</th>
                                            <th>Name</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-6"></div>
                                <div class="col-md-6">
                                    <table style="width: 100%">
                                        <tr>
                                            <td><label for="updateAmountRP">Invoice Amount</label></td>
                                            <td><input type="text" name="amountRP" class="input-small" id="updateAmountRP"
                                                    value="0" readonly style="text-align: right;"></td>
                                        </tr>
                                        <tr>
                                            <td><label for="updateTotalDiscount">Discount</label></td>
                                            <td><input type="text" name="totalDiscount" class="input-small"
                                                    id="updateTotalDiscount" value="0" style="text-align: right;"></td>
                                        </tr>
                                        <tr>
                                            <td><label for="updateNetAmount">Net Amount</label>
                                            <td><input type="text" name="netAmount" class="input-small" id="updateNetAmount"
                                                    value="0" readonly style="text-align: right;"></td>
                                        </tr>
                                        <tr>
                                            <td><label for="updateAdvance">Advance</label>
                                            <td><input type="text" name="advance" class="input-small" id="updateAdvance"
                                                    value="0" style="text-align: right;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label for="updateBalance">Balance</label>
                                            <td><input type="text" name="balance" class="input-small" id="updateBalance"
                                                    value="0" readonly style="text-align: right;"></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="center">
                                    <span class="text-danger error" id="update_discount_error"></span>
                                    <span class="text-danger error" id="update_advance_error"></span>
                                    <span class="text-danger error" id="update_message_error"></span>
                                </div>
                                <div class="center">
                                    <button id="UpdateMainTransaction" class="btn btn-success addButton">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>