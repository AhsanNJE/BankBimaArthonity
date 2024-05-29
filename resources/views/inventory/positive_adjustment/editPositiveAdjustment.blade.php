<div id="editAdjustment" class="modal-container">
    <div class="modal-subject">
        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Edit Positive Adjustment</h3>
                        <span class="close-modal" data-modal-id="editAdjustment">&times;</span>
                    </div>
                </div>

                <!-- form start -->
                <form id="EditPositiveAdjustmentForm" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div id="updatewithin" style="display: none"> </div>
                                    <div id="updategroupein" style="display: none">
                                        @foreach ($groupes as $groupe)
                                        <input type="checkbox" id="groupe[]" name="groupe" class="updategroupe-checkbox" value="{{$groupe->id}}" checked>
                                        @endforeach
                                    </div>
                                    <input type="hidden" name="id" id="id">
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
                                                <label for="updateStore">Store</label>
                                                <input type="text" name="store" class="form-control" id="updateStore"
                                                    autocomplete="off">
                                                <div id="update-store">
                                                    <ul>

                                                    </ul>
                                                </div>
                                                <span class="text-danger error" id="update_store_error"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="updateProduct">Product</label>
                                                <input type="text" name="product" id="updateProduct" class="form-control">
                                                <div id="update-product">
                                                    <ul>

                                                    </ul>
                                                </div>
                                                <span class="text-danger error" id="update_product_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="updateQuantity">Quantity</label>
                                                <input type="text" name="quantity" class="form-control" id="updateQuantity" value="1">
                                                <span class="text-danger error" id="update_quantity_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div id="update-product">
                                        <table class="product-table">
                                            <caption class="caption">Product List</caption>
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
                                </div>
                                <div class="center">
                                    <button type="submit" id="UpdateAdjustment" class="btn btn-success">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>