@section('style')
    <style>
        .modal-subject {
            width: 75%;
        }
        label {
            font-size: 16px !important;
            font-weight: normal !important;
        }
        .container {
        background-color: #E8E8E8!important; 
        }
    </style>
@endsection

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div id= "EmployeePersonal" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading">
            <h3 class="center">Add Employee Personal Detail</h3>
            <span class="close-modal" data-modal-id="EmployeePersonal">&times;</span>
        </div>

        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Add Employee Personal Detail</h3>
                    </div>
                </div>
                
                <!-- form start -->
                <form id="AddPersonalDetailForm" action="{{ route('insertpersonal.info')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Personal Details Section -->    
                <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for = "name">Name</label>
                                        <input type="text" name="name" id="name" class="form-control">
                                        <span class="text-danger error" id="name_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for = "fathers_name">Father's Name</label>
                                        <input type="text" name="fathers_name" id="fathers_name" class="form-control">
                                        <span class="text-danger error" id="fathers_name_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for = "mothers_name">Mother's Name</label>
                                        <input type="text" name="mothers_name" id="mothers_name" class="form-control">
                                        <span class="text-danger error" id="mothers_name_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for = "dob">Date of Birth</label>
                                        <input type="date" name="date_of_birth" id="date_of_birth" class="form-control">
                                        <span class="text-danger error" id="date_of_birth_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for = "gender">Gender</label>
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
                                        <label for = "religion">Religion</label>
                                        <input type="text" name="religion" id="religion" class="form-control">
                                        <span class="text-danger error" id="religion_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for = "marital_status">Marital Status</label>
                                        <input type="text" name="marital_status" id="marital_status" class="form-control">
                                        <span class="text-danger error" id="marital_status_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for = "nationality">Nationality</label>
                                        <input type="text" name="nationality" id="nationality" class="form-control">
                                        <span class="text-danger error" id="nationality_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for = "nid_no">Nid No.</label>
                                        <input type="text" name="nid_no" id="nid_no" class="form-control">
                                        <span class="text-danger error" id="nid_no_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for = "phn_no">Phone No.</label>
                                        <input type="text" name="phn_no" id="phn_no" class="form-control">
                                        <span class="text-danger error" id="phn_no_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for = "blood_group">Blood Group</label>
                                        <input type="text" name="blood_group" id="blood_group" class="form-control">
                                        <span class="text-danger error" id="blood_group_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for = "email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control">
                                        <span class="text-danger error" id="email_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for = "location">Location</label>
                                        <input type="text" name="location" id="location" class="form-control">
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
                                            @foreach ($tranwith as $with)
                                                <option value="{{$with->id}}">{{$with->tran_with_name}}</option>                                                
                                            @endforeach
                                        </select>
                                        <span class="text-danger error" id="type_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for = "address">Address</label>
                                        <input type="text" name="address" id="address" class="form-control">
                                        <span class="text-danger error" id="address_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input type="file" name="image" id="image" class="form-control">
                                        <span class="text-danger error" id="image_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="center">
                                <button type="submit" id="InsertPersonal" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>    
                </form>
             </div>
        </div>
    </div>
</div>
</body>
</html>
