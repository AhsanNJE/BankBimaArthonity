@section('style')
    <style>
        .modal-subject {
            width: 80%;
        }
    </style>
@endsection

<div id="addTransaction" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading">
            <h3 class="center">Add Transaction Receive</h3>
            <span class="close-modal" data-modal-id="addTransaction">&times;</span>
        </div>

        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Add Transaction Receive</h3>
                    </div>
                </div>

                <!-- form start -->
                <form id="AddTransactionForm" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="date">Date</label>
                                        <input type="text" name="date" class="form-control" id="date"
                                            value="{{ date('Y-m-d') }}" disabled>
                                        <span class="text-danger error" id="date_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="type">Transaction Type</label>
                                        <select name="type" id="type">
                                            <option value="payment">Payment</option>
                                        </select>
                                        <span class="text-danger error" id="type_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="tranId">Transaction Id</label>
                                        <input type="text" name="tranId" class="form-control" id="tranId"
                                            >
                                        <span class="text-danger error" id="tranId_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="invoice">Invoice No</label>
                                        <input type="text" name="invoice" class="form-control" id="invoice">
                                        <span class="text-danger error" id="invoice_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="location">Location</label>
                                        <input type="text" name="location" class="form-control" id="location"
                                            autocomplete="off">
                                        <div id="location-list">
                                            <ul>

                                            </ul>
                                        </div>
                                        <span class="text-danger error" id="location_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="with">Transaction With</label>
                                        <select name="with" id="with">
                                            <option>Select Transaction With</option>
                                            <option value="regular employee">Regular</option>
                                            <option value="district employee">District Employee</option>
                                            <option value="bit pion">Bit Pione</option>
                                            <option value="newspaper client">Newpaper Client</option>
                                            <option value="advertisement client">Advertisement Client</option>
                                            <option value="magazine client">Magazine Client</option>
                                            <option value="food supplier">Food Supplier</option>
                                            <option value="stationary supplier">Stationary Supplier</option>
                                            <option value="others">Others</option>
                                        </select>
                                        <span class="text-danger error" id="head_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="user">Transaction User</label>
                                        <input type="text" name="user" class="form-control" id="user" autocomplete="off">
                                        <div id="user-list">
                                            <ul>

                                            </ul>
                                        </div>
                                        <span class="text-danger error" id="user_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="groupe">Transaction Groupe</label>
                                        <select name="groupe" id="groupe">
                                            <option value="">Select Transaction Groupe</option>
                                            @foreach ($groupes as $groupe)
                                                <option value="{{ $groupe->id }}">{{ $groupe->tran_groupe_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger error" id="groupe_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="head">Transaction Head</label>
                                        <select name="head" id="head">
                                            <option value="">Select Transaction Head</option>
                                            {{-- options will be display dynamicaly depending on transaction groupe --}}
                                        </select>
                                        <span class="text-danger error" id="head_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="quantity">Quantity</label>
                                        <input type="text" name="quantity" class="form-control" id="quantity" value="1">
                                        <span class="text-danger error" id="quantity_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="amount">Amount</label>
                                        <input type="text" name="amount" class="form-control" id="amount">
                                        <span class="text-danger error" id="amount_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="totAmount">Total</label>
                                        <input type="text" name="totAmount" class="form-control" id="totAmount" readonly>
                                        <span class="text-danger error" id="totAmount_error"></span>
                                    </div>
                                </div>
                                <div class="center">
                                    <button type="submit" id="InsertTransaction"
                                        class="btn btn-success">Add</button>
                                </div>
                            </div>
                            <div class="row grid">
                                <div class="col-md-12">
                                    <div class="transaction_grid">
                                        <table class="show-table">
                                            <thead>
                                                <tr>
                                                    <th>SL:</th>
                                                    <th>Transaction Head</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                    <th>Total Amount</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6"></div>
                                <div class="col-md-6">
                                    <table style="width: 100%">
                                        <tr>
                                            <td><label for="amountRP">Invoice Amount</label></td>
                                            <td><input type="text" name="amountRP" class="input-small"
                                                    id="amountRP" value="0" readonly></td>
                                        </tr>
                                        <tr>
                                            <td><label for="totalDiscount">Discount</label></td>
                                            <td><input type="text" name="totalDiscount" class="input-small"
                                                    id="totalDiscount" value="0"></td>
                                        </tr>
                                        <tr>
                                            <td><label for="netAmount">Net Amount</label>
                                            <td><input type="text" name="netAmount" class="input-small"
                                                    id="netAmount" value="0" readonly></td>
                                        </tr>
                                        <tr>
                                            <td><label for="advance">Advance</label>
                                            <td><input type="text" name="advance" class="input-small"
                                                    id="advance" value="0"></td>
                                        </tr>
                                        <tr>
                                            <td><label for="balance">Balance</label>
                                            <td><input type="text" name="balance" class="input-small"
                                                    id="balance" value="0" readonly></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="center">
                                    <button id="AddMainTransaction"
                                        class="btn btn-success addButton">Submit</button>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
