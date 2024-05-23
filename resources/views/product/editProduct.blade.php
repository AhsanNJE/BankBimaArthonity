<div id="editProduct" class="modal-container">
    <div class="modal-subject">
        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Edit Product</h3>
                        <span class="close-modal" data-modal-id="editProduct">&times;</span>
                    </div>
                </div>

                <form id="EditProductForm" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="id" id="id">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="update_product_name">Product Name</label>
                                        <input type="text" name="product_name" class="form-control" id="update_product_name">
                                        <span class="text-danger error" id="update_product_name_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for = "updateLocation">Location</label>
                                        <input type="text" name="location" id="updateLocation" class="form-control">
                                        <div id="update-location">
                                            <ul>

                                            </ul>
                                        </div>
                                        <span class="text-danger error" id="update_location_error"></span>
                                    </div>
                                </div>
                        
                                <div class="center">
                                    <button type="submit" id="updateProduct" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>