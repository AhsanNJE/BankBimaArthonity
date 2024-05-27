@section('style')
<style>
    .modal-subject {
        width: 80%;
    }

    #search {
        width: 100%;
        margin: 0;
    }
</style>
@endsection

<div id="addInventoryPurchase" class="modal-container">
    <div class="modal-subject">
        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Add Inventory Purchase</h3>
                        <span class="close-modal" data-modal-id="addInventoryPurchase">&times;</span>
                    </div>
                </div>
                
                <!-- form start -->
                <form id="AddInventoryPurchaseForm" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div id="within" style="display: none"> </div>
                            <div id="groupein" style="display: none">
                                @foreach ($groupes as $groupe)
                                <input type="checkbox" id="groupe[]" class="groupe-checkbox" name="groupe"
                                    value="{{$groupe->id}}" checked>
                                @endforeach
                            </div>
                            <input type="text" name="tranId" class="form-control" id="tranId" style="display: none">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="date">Date</label>
                                        <input type="text" name="date" class="form-control" id="date"
                                            value="{{ date('Y-m-d') }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="user">Supplier Name</label>
                                        <input type="text" name="user" class="form-control" id="user"
                                            autocomplete="off">
                                        <div id="user-list">
                                            <ul>

                                            </ul>
                                        </div>
                                        <span class="text-danger error" id="user_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="store">Store</label>
                                        <input type="text" name="store" class="form-control" id="store"
                                            autocomplete="off">
                                        <div id="store-list">
                                            <ul>

                                            </ul>
                                        </div>
                                        <span class="text-danger error" id="store_error"></span>
                                    </div>
                                </div>
                                

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="product">Product Name</label>
                                        <input type="text" name="product" id="product" class="form-control" autocomplete="off">
                                        <div id="product-list">
                                            <table class="product-table">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Generic Name</th>
                                                        <th>Manufacture</th>
                                                        <th>Form</th>
                                                        <th>Quantity</th>
                                                        <th>MRP</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                        <span class="text-danger error" id="product_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="quantity">Quantity</label>
                                        <input type="text" name="quantity" class="form-control" id="quantity" value="1">
                                        <span class="text-danger error" id="quantity_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="unit">Unit</label>
                                        <input type="text" name="unit" class="form-control" id="unit" autocomplete="off">
                                        <div id="unit-list">
                                            <ul>
                                                
                                            </ul>
                                        </div>
                                        <span class="text-danger error" id="unit_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="amount">Cost Price</label>
                                        <input type="text" name="amount" class="form-control" id="amount">
                                        <span class="text-danger error" id="amount_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="mrp">Mrp</label>
                                        <input type="text" name="mrp" class="form-control" id="mrp">
                                        <span class="text-danger error" id="amount_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="totAmount">Total</label>
                                        <input type="text" name="totAmount" class="form-control" id="totAmount"
                                            readonly>
                                        <span class="text-danger error" id="totAmount_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="expiry">Expiry Date</label>
                                        <input type="date" name="expiry" class="form-control" id="expiry">
                                        <span class="text-danger error" id="expiry_error"></span>
                                    </div>
                                </div>
                                <div class="center">
                                    <button type="submit" id="InsertTransaction" class="btn btn-success">Add</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="transaction_grid" style="overflow-x:auto;">
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
                                            <td><label for="amountRP">Invoice Amount</label></td>
                                            <td><input type="text" name="amountRP" class="input-small" id="amountRP"
                                                    value="0" readonly style="text-align: right;"></td>
                                        </tr>
                                        <tr>
                                            <td><label for="totalDiscount">Discount</label></td>
                                            <td><input type="text" name="totalDiscount" class="input-small"
                                                    id="totalDiscount" value="0" style="text-align: right;"></td>
                                        </tr>
                                        <tr>
                                            <td><label for="netAmount">Net Amount</label>
                                            <td><input type="text" name="netAmount" class="input-small" id="netAmount"
                                                    value="0" readonly style="text-align: right;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label for="advance">Advance</label>
                                            <td><input type="text" name="advance" class="input-small" id="advance"
                                                    value="0" style="text-align: right;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label for="balance">Balance</label>
                                            <td><input type="text" name="balance" class="input-small" id="balance"
                                                    value="0" readonly style="text-align: right;"></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="center">
                                    <span class="text-danger error" id="discount_error"></span>
                                    <span class="text-danger error" id="advance_error"></span>
                                    <span class="text-danger error" id="message_error"></span>
                                </div>
                                <div class="center">
                                    <button id="InsertMainPurchase" class="btn btn-success addButton">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>