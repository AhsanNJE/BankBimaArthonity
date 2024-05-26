<div id="addPhamacyProduct" class="modal-container">
    <div class="modal-subject">
        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Add Pharmacy Product</h3>
                        <span class="close-modal" data-modal-id="addPhamacyProduct">&times;</span>
                    </div>
                </div>
                
                <!-- form start -->
                <form id="addPhamacyProductForm" method="post">
                    @csrf
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    
                                    <div class="form-group">
                                        <label for="headName">Product Name</label>
                                        <input type="text" name="headName" class="form-control" id="headName">
                                        <span class="text-danger error" id="headName_error"></span>
                                    </div>
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
                                    <div class="form-group">
                                        <label for="category">Category Name</label>
                                        <input type="text" name="category" class="form-control" id="category">
                                        <div id='category-list'>
                                            <ul>

                                            </ul>
                                        </div>
                                        <span class="text-danger error" id="category_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="manufacturer">Manufacture Name</label>
                                        <input type="text" name="manufacturer" class="form-control" id="manufacturer">
                                        <div id='manufacturer-list'>
                                            <ul>

                                            </ul>
                                        </div>
                                        <span class="text-danger error" id="manufacturer_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="form">Item Form Name</label>
                                        <input type="text" name="form" class="form-control" id="form">
                                        <div id='form-list'>
                                            <ul>

                                            </ul>
                                        </div>
                                        <span class="text-danger error" id="form_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="unit">Unit Name</label>
                                        <input type="text" name="unit" class="form-control" id="unit">
                                        <div id='unit-list'>
                                            <ul>

                                            </ul>
                                        </div>
                                        <span class="text-danger error" id="unit_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="store">Store Name</label>
                                        <input type="text" name="store" class="form-control" id="store">
                                        <div id='store-list'>
                                            <ul>

                                            </ul>
                                        </div>
                                        <span class="text-danger error" id="store_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="quantity">Quantity</label>
                                        <input type="text" name="quantity" class="form-control" id="quantity">
                                        <span class="text-danger error" id="quantity_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="costprice">Cost Price</label>
                                        <input type="text" name="costprice" class="form-control" id="costprice">
                                        <span class="text-danger error" id="costprice_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="mrp">MRP</label>
                                        <input type="text" name="mrp" class="form-control" id="mrp">
                                        <span class="text-danger error" id="mrp_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="expireddate">Expired Date</label>
                                        <input type="date" name="expireddate" class="form-control" id="expireddate">
                                        <span class="text-danger error" id="expireddate_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="center">
                                <button type="submit" id="InsertPharmacyProduct" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
