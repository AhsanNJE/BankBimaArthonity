<div id="editBankModal" class="modal-container">
    <div class="modal-subject">
        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Edit Bank</h3>
                        <span class="close-modal" data-modal-id="editBankModal">&times;</span>
                    </div>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form id="EditBankForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="id" id="id">
                                @foreach ($tranwith as $with)
                                    <input type="hidden" name="type" id="updatetype" value="{{$with->id}}">
                                @endforeach
                                <div class="form-group">
                                    <label for="updateName">Bank Name</label>
                                    <input type="text" name="name" class="form-control" id="updateName">
                                    <span class="text-danger error" id="update_name_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="updateEmail">Email</label>
                                    <input type="text" name="email" class="form-control" id="updateEmail">
                                    <span class="text-danger error" id="update_email_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="updatePhone">Phone</label>
                                    <input type="text" name="phone" class="form-control" id="updatePhone">
                                    <span class="text-danger error" id="update_phone_error"></span>
                                </div>
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
                                <div class="form-group">
                                    <label for="updateAddress">Address</label>
                                    <input type="text" name="address" class="form-control" id="updateAddress">
                                    <span class="text-danger error" id="update_address_error"></span>
                                </div>
                            </div>
                            <div class="center">
                                <button type="submit" class="btn btn-primary" id="EditBank">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>