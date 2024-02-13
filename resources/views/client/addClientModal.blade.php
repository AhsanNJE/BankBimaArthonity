<div id="addClientModal" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading">
            <h3 class="center">Add Client</h3>
            <span class="close-modal" data-modal-id="addClientModal">&times;</span>
        </div>

        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Add Client</h3>
                    </div>
                </div>
                <!-- form start -->
                <form id="AddClientForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group">
                                    <label for="name">Client Name</label>
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">Gender</label>
                                        <select name="gender" id="gender">
                                            <option value="">Select Gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="others">Others</option>
                                        </select>
                                        <span class="text-danger error" id="gender_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="location">Location</label>
                                        <input type="text" name="location" class="form-control" id="location" autocomplete="off">
                                        <div id="location-list">
                                            <ul>
    
                                            </ul>
                                        </div>
                                        <span class="text-danger error" id="location_error"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" name="address" class="form-control" id="address">
                                    <span class="text-danger error" id="address_error"></span>
                                </div>
                            </div>
                            <div class="center">
                                <button type="submit" class="btn btn-primary" id="InsertClient">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
