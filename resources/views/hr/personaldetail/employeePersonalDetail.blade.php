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
                <form action="{{ route('insertpersonal.info')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Personal Details Section -->
                <h4>Personal Details</h4>    
                <div class="container bg-light text-dark my-4 py-3">
                    <div class="row">
                        <div class="col-md-4">
                            <label for = "name">Name</label>
                            <input type="text" name="name" id="name" placeholder="Name" class="@error('name') is-invalid @enderror">
                            @error('name')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "fathers_name">Father's Name</label>
                            <input type="text" name="fathers_name" id="fathers_name" placeholder="Father's Name" class="@error('fathers_name') is-invalid @enderror">
                            @error('fathers_name')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "mothers_name">Mother's Name</label>
                            <input type="text" name="mothers_name" id="mothers_name" placeholder="Mother's Name" class="@error('mothers_name') is-invalid @enderror">
                            @error('mothers_name')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "dob">Date of Birth</label>
                            <input type="date" name="date_of_birth" id="date_of_birth" placeholder="Date of Birth" class="@error('date_of_birth') is-invalid @enderror">
                            @error('date_of_birth')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "gender">Gender</label>
                            <select name="gender" id="gender" class="@error('gender') is-invalid @enderror">
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="others">Others</option>
                            </select>
                            @error('gender')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "religion">Religion</label>
                            <input type="text" name="religion" id="religion" placeholder="Religion" class="@error('religion') is-invalid @enderror">
                            @error('religion')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "marital_status">Marital Status</label>
                            <input type="text" name="marital_status" id="marital_status" placeholder="Marital Status" class="@error('marital_status') is-invalid @enderror">
                            @error('marital_status')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "nationality">Nationality</label>
                            <input type="text" name="nationality" id="nationality" placeholder="Nationality" class="@error('nationality') is-invalid @enderror">
                            @error('nationality')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "phn_no">Phone No.</label>
                            <input type="text" name="phn_no" id="phn_no" placeholder="Phone No." class="@error('phn_no') is-invalid @enderror">
                            @error('phn_no')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "blood_group">Blood Group</label>
                            <input type="text" name="blood_group" id="blood_group" placeholder="Blood Group" class="@error('blood_group') is-invalid @enderror">
                            @error('blood_group')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "email">Email</label>
                            <input type="email" name="email" id="email" placeholder="Email" class="@error('email') is-invalid @enderror">
                            @error('email')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "location_id">Location Id</label>
                            <input type="text" name="location_id" id="location_id" placeholder="Location Id" class="@error('location_id') is-invalid @enderror">
                            @error('location_id')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "tran_user_type">Tran User Type</label>
                            <input type="text" name="tran_user_type" id="tran_user_type" placeholder="Tran User Type" class="@error('tran_user_type') is-invalid @enderror">
                            @error('tran_user_type')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "address">Address</label>
                            <input type="text" name="address" id="address" placeholder="Address" class="@error('address') is-invalid @enderror">
                            @error('address')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for="image">Image</label>
                            <input type="file" name="image" id="image" placeholder="Image" class="@error('image') is-invalid @enderror">
                            @error('image')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                    </div>
                </div>
                <div class="center">
                    <button type="submit" id="EmployeePersonal" class="btn btn-primary">Save</button>
                </div>
                </form>
             </div>
        </div>
    </div>
</div>
</body>
</html>
