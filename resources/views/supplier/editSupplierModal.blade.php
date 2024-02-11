<div id="editSupplierModal" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading">
            <h3 class="center">Edit Supplier</h3>
            <span class="close-modal" data-modal-id="editSupplierModal">&times;</span>
        </div>

        <div class="center">
            <div class="card card-primary col-md-10">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Edit Supplier</h3>
                    </div>
                </div>

                <form id="EditSupplierForm" method="post">
                    @csrf 
                    @method('put')
                    <div class="center">
                        <div class="card-body">
                            <input type="hidden" name="id" class="form-control"  id="id">
                            <div class="form-group">
                                <label for="updateSupplierName">Supplier Name</label>
                                <input type="text" name="supplierName" class="form-control"  id="updateSupplierName">
                                <span class="text-danger error" id="update_supplierName_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="updateSupplierEmail">Supplier Email</label>
                                <input type="text" name="supplierEmail" class="form-control"  id="updateSupplierEmail">
                                <span class="text-danger error" id="update_supplierEmail_error"></span>
                            </div>
                            
                            <div class="form-group">
                                <label for="updateSupplierContact">Supplier Contact</label>
                                <input type="text" name="supplierContact" class="form-control"  id="updateSupplierContact">
                                <span class="text-danger error" id="update_supplierContact_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="updateSupplierAddress">Supplier Address</label>
                                <input type="text" name="supplierAddress" class="form-control"  id="updateSupplierAddress">
                                <span class="text-danger error" id="update_supplierAddress_error"></span>
                            </div>
                            <div class="center">
                                <button type="submit" id="updateSupplier" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


