<div id="addSupplierModal" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading">
            <h3 class="center">Add Supplier</h3>
            <span class="close-modal" data-modal-id="addSupplierModal">&times;</span>
        </div>

        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Add Supplier</h3>
                    </div>
                </div>

                <form id="AddSupplierForm" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type">Supplier Type</label>
                                        <select name="type" id="type">
                                            <option value="">Select Supplier Type</option>
                                            <option value="food supplier">Food Supplier</option>
                                            <option value="stationary supplier">Stationary Supplier</option>
                                        </select>
                                        <span class="text-danger error" id="type_error"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" id="name">
                                    <span class="text-danger error" id="name_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" class="form-control" id="email">
                                    <span class="text-danger error" id="email_error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" name="phone" class="form-control" id="phone">
                                    <span class="text-danger error" id="phone_error"></span>
                                </div>
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
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" name="address" class="form-control" id="address">
                                    <span class="text-danger error" id="address_error"></span>
                                </div>
                                <div class="center">
                                    <button type="submit" id="InsertSupplier" class="btn btn-primary">Submit</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
