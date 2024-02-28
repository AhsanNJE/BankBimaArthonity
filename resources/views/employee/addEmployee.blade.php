@section('style')
    <style>
        .modal-subject {
            width: 60%;
        }
    </style>
@endsection


<div id="addEmployee" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading">
            <h3 class="center">Add Employee</h3>
            <span class="close-modal" data-modal-id="addEmployee">&times;</span>
        </div>

        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Add Employee</h3>
                    </div>
                </div>
                
                <!-- form start -->
                <form id="AddEmployeeForm" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control" id="name">
                                        <span class="text-danger error" id="name_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" name="email" class="form-control" id="email">
                                        <span class="text-danger error" id="email_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" name="phone" class="form-control" id="phone">
                                        <span class="text-danger error" id="phone_error"></span>
                                    </div>
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type">Employee Type</label>
                                        <select name="type" id="type">
                                            <option value="">Select Employee Type</option>
                                            <option value="regular employee">Regular</option>
                                            <option value="district employee">District Employee</option>
                                            <option value="bit pion">Bit Pione</option>
                                        </select>
                                        <span class="text-danger error" id="type_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="department">Department</label>
                                        <input type="text" name="department" class="form-control" id="department" autocomplete="off">
                                        <div id="department-list">
                                            <ul>

                                            </ul>
                                        </div>
                                        <span class="text-danger error" id="department_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="designation">Designation</label>
                                        <input type="text" name="designation" class="form-control" id="designation" autocomplete="off">
                                        <div id="designation-list">
                                            <ul>

                                            </ul>
                                        </div>
                                        <span class="text-danger error" id="designation_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dob">Date of Birth</label>
                                        <input type="date" name="dob" class="form-control" id="dob">
                                        <span class="text-danger error" id="dob_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nid">NID</label>
                                        <input type="text" name="nid" class="form-control" id="nid">
                                        <span class="text-danger error" id="nid_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" name="address" class="form-control" id="address">
                                        <span class="text-danger error" id="address_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input type="file" name="image" class="form-control" id="image">
                                        <span class="text-danger error" id="image_error"></span>
                                        <img src="#" alt="Selected Image" id="previewImage" style="display: none; width:200px; height:200px;">
                                    </div>
                                </div>
                            </div>
                            <div class="center">
                                <button type="submit" id="InsertEmployee" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
