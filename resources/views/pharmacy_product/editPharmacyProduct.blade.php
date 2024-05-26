<div id="editPharmacyProduct" class="modal-container">
    <div class="modal-subject">
        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Edit Pharmacy Product</h3>
                        <span class="close-modal" data-modal-id="editPharmacyProduct">&times;</span>
                    </div>
                </div>
                
                <!-- form start -->
                <form id="EditPharmacyProductForm" method="post">
                    @csrf
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" name="id" id="id">
                                    <div class="form-group">
                                        <label for="updateHeadName">Transaction Head</label>
                                        <input type="text" name="headName" class="form-control" id="updateHeadName">
                                        <span class="text-danger error" id="update_headName_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="updateGroupe">Transaction Groupe</label>
                                        <select name="groupe" id="updateGroupe">
                                            {{-- options will be display dynamically --}}
                                        </select>
                                        <span class="text-danger error" id="update_groupe_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="updateCategory">Category Name</label>
                                        <select name="category" id="updateCategory">
                                            {{-- options will be display dynamically --}}
                                        </select>
                                        <span class="text-danger error" id="update_category_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="updateManufacture">Manufacture Name</label>
                                        <select name="manufacture" id="updateManufacture">
                                            {{-- options will be display dynamically --}}
                                        </select>
                                        <span class="text-danger error" id="update_manufacture_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="updateItemForm">Item Form Name</label>
                                        <select name="itemform" id="updateItemForm">
                                            {{-- options will be display dynamically --}}
                                        </select>
                                        <span class="text-danger error" id="update_itemform_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="updateUnite">Unite Name</label>
                                        <select name="unite" id="updateUnite">
                                            {{-- options will be display dynamically --}}
                                        </select>
                                        <span class="text-danger error" id="update_unite_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="updateStore">Store</label>
                                        <input type="text" name="store" class="form-control" id="updateStore">
                                        <span class="text-danger error" id="update_store_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="updateQuantity">Quantity</label>
                                        <input type="text" name="quantity" class="form-control" id="updateQuantity">
                                        <span class="text-danger error" id="update_quantity_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="updateCostPrice">Cost Price</label>
                                        <input type="text" name="costprice" class="form-control" id="updateCostPrice">
                                        <span class="text-danger error" id="update_costprice_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="updateMrp">MRP</label>
                                        <input type="text" name="mrp" class="form-control" id="updateMrp">
                                        <span class="text-danger error" id="update_mrp_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="updateExpiredDate">Expired Date</label>
                                        <input type="text" name="expireddate" class="form-control" id="updateExpiredDate">
                                        <span class="text-danger error" id="update_expireddate_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="center">
                                <button type="submit" id="UpdatePharmacyProduct" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
