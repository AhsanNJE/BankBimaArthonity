@section('style')
    <style>
        .modal-subject {
            width: 75%;
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
<div id="editPersonal" class="modal-container">
    <div class="modal-subject">
        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Edit Employee Personal Detail</h3>
                        <span class="close-modal" data-modal-id="editPersonal">&times;</span>
                    </div>
                </div>
                <br>
                <!-- form start -->
                <form id="EditPersonalDetailForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <!-- Personal Details Section -->    
                <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="id" id="id">
                                <input type="hidden" name="employee_id" id="employee_id">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for = "update_name">Name</label>
                                        <input type="text" name="name" id="update_name" class="form-control">
                                        <span class="text-danger error" id="update_name_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for = "update_fathers_name">Father's Name</label>
                                        <input type="text" name="fathers_name" id="update_fathers_name" class="form-control">
                                        <span class="text-danger error" id="update_fathers_name_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for = "update_mothers_name">Mother's Name</label>
                                        <input type="text" name="mothers_name" id="update_mothers_name" class="form-control">
                                        <span class="text-danger error" id="update_mothers_name_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for = "update_date_of_birth">Date of Birth</label>
                                        <input type="date" name="date_of_birth" id="update_date_of_birth" class="form-control">
                                        <span class="text-danger error" id="update_date_of_birth_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for = "update_gender">Gender</label>
                                        <select name="gender" id="update_gender">
                                            
                                        </select>
                                        <span class="text-danger error" id="update_gender_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for = "update_religion">Religion</label>
                                        <input type="text" name="religion" id="update_religion" class="form-control">
                                        <span class="text-danger error" id="update_religion_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for = "update_marital_status">Marital Status</label>
                                        <input type="text" name="marital_status" id="update_marital_status" class="form-control">
                                        <span class="text-danger error" id="update_marital_status_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for = "update_nationality">Nationality</label>
                                        <input type="text" name="nationality" id="update_nationality" class="form-control">
                                        <span class="text-danger error" id="update_nationality_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for = "update_nid_no">Nid No.</label>
                                        <input type="text" name="nid_no" id="update_nid_no" class="form-control">
                                        <span class="text-danger error" id="update_nid_no_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for = "update_phn_no">Phone No.</label>
                                        <input type="text" name="phn_no" id="update_phn_no" class="form-control">
                                        <span class="text-danger error" id="update_phn_no_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for = "update_blood_group">Blood Group</label>
                                        <input type="text" name="blood_group" id="update_blood_group" class="form-control">
                                        <span class="text-danger error" id="update_blood_group_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for = "update_email">Email</label>
                                        <input type="email" name="email" id="update_email" class="form-control">
                                        <span class="text-danger error" id="update_email_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
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
                                <div class="col-md-6">  
                                    <div class="form-group">   
                                        <label for="update_type">Employee Type</label>
                                        <select name="type" id="update_type">
                                            <option value="">Select Employee Type</option>
                                            @foreach ($tranwith as $with)
                                                <option value="{{$with->id}}">{{$with->tran_with_name}}</option>                                                
                                            @endforeach
                                        </select>
                                        <span class="text-danger error" id="update_type_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for = "update_address">Address</label>
                                        <input type="text" name="address" id="update_address" class="form-control">
                                        <span class="text-danger error" id="update_address_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="update_image">Image</label>
                                        <input type="file" name="image" id="update_image" class="form-control">
                                        <span class="text-danger error" id="update_image_error"></span>
                                        <img src="#" alt="Selected Image" id="update_preview_image" style="display: none; width:200px; height:200px;">
                                    </div>
                                </div>
                            </div>
                            <div class="center">
                                <button type="submit" id="UpdatePersonal" class="btn btn-primary">Save</button>
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
