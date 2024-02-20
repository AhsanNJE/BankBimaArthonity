@section('style')
    <style>
        .modal-subject {
            width: 60%;
        }
    </style>
@endsection


<div id="editEmployee" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading">
            <h3 class="center">Edit Employee</h3>
            <span class="close-modal" data-modal-id="editEmployee">&times;</span>
        </div>

        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Edit Employee</h3>
                    </div>
                </div>
                
                <!-- form start -->
                <form id="EditEmployeeForm" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="id" id="id">
                                <input type="hidden" name="empId" id="empId">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="updateName">Name</label>
                                        <input type="text" name="name" class="form-control" id="updateName">
                                        <span class="text-danger error" id="update_name_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="updateEmail">Email</label>
                                        <input type="text" name="email" class="form-control" id="updateEmail">
                                        <span class="text-danger error" id="update_email_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="updatePhone">Phone</label>
                                        <input type="text" name="phone" class="form-control" id="updatePhone">
                                        <span class="text-danger error" id="update_phone_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="updateGender">Gender</label>
                                        <select name="gender" id="updateGender">
                                            {{-- options will be display dynamically --}}
                                        </select>
                                        <span class="text-danger error" id="update_gender_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="updateLocation">Location</label>
                                        <input type="text" name="location" class="form-control" id="updateLocation" autocomplete="off">
                                        <div id="update-location">
                                            <ul>

                                            </ul>
                                        </div>
                                        <span class="text-danger error" id="update_location_error"></span>
                                    </div>
                                </div>
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
                                        <label for="updateDepartment">Department</label>
                                        <input type="text" name="department" class="form-control" id="updateDepartment" autocomplete="off">
                                        <div id="update-department">
                                            <ul>

                                            </ul>
                                        </div>
                                        <span class="text-danger error" id="update_department_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="updateDesignation">Designation</label>
                                        <input type="text" name="designation" class="form-control" id="updateDesignation" autocomplete="off">
                                        <div id="update-designation">
                                            <ul>

                                            </ul>
                                        </div>
                                        <span class="text-danger error" id="update_designation_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="updateDob">Date of Birth</label>
                                        <input type="date" name="dob" class="form-control" id="updateDob">
                                        <span class="text-danger error" id="update_dob_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="updateNid">Nid</label>
                                        <input type="text" name="nid" class="form-control" id="updateNid">
                                        <span class="text-danger error" id="update_nid_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="updateAddress">Address</label>
                                        <input type="text" name="address" class="form-control" id="updateAddress">
                                        <span class="text-danger error" id="update_address_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="updateImage">Image</label>
                                        <input type="file" name="image" class="form-control" id="updateImage">
                                        <span class="text-danger error" id="update_image_error"></span>
                                        <img src="#" alt="Selected Image" id="updatePreviewImage" style="display: none;">
                                    </div>
                                </div>
                            </div>
                            <div class="center">
                                <button type="submit" id="UpdateEmployee" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
