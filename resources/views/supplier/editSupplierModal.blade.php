<div id="editSupplierModal" class="modal-container">
    <div class="modal-subject">
        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Edit Supplier</h3>
                        <span class="close-modal" data-modal-id="editSupplierModal">&times;</span>
                    </div>
                </div>

                <form id="EditSupplierForm" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="id" id="id">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="updateType">Type</label>
                                        <select name="type" id="updateType">
                                            {{-- options will be display dynamically --}}
                                        </select>
                                        <span class="text-danger error" id="update_type_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="updateName">Client Name</label>
                                        <input type="text" name="name" class="form-control" id="updateName">
                                        <span class="text-danger error" id="update_name_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="updateEmail">Email</label>
                                        <input type="text" name="email" class="form-control" id="updateEmail">
                                        <span class="text-danger error" id="update_email_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="updatePhone">Phone</label>
                                        <input type="text" name="phone" class="form-control" id="updatePhone">
                                        <span class="text-danger error" id="update_phone_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="updateGender">Gender</label>
                                        <select name="gender" id="updateGender">
                                            <option value="">Select Gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="others">Others</option>
                                        </select>
                                        <span class="text-danger error" id="update_gender_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="updateAddress">Address</label>
                                        <input type="text" name="address" class="form-control" id="updateAddress">
                                        <span class="text-danger error" id="update_address_error"></span>
                                    </div>
                                </div>
                                <div class="center">
                                    <button type="submit" id="updateSupplier" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>