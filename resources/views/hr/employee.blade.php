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
<div id= "NewEmployee" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading">
            <h3 class="center">Add Employee</h3>
            <span class="close-modal" data-modal-id="NewEmployee">&times;</span>
        </div>

        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Add Employee</h3>
                    </div>
                </div>
                
                <!-- form start -->
                <form action="{{ route('insert.info')}}" method="POST" enctype="multipart/form-data">
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
    
                <!-- Education Details Section -->
                <h4>Education Details</h4>
                <div class="container bg-light text-dark my-4 py-3">
                    <div class="row">
                        <div class="col-md-4">
                            <label for = "level_of_education">Level of Education</label>
                            <input type="text" name="level_of_education" id="level_of_education" placeholder="Level of Education" class="@error('level_of_education') is-invalid @enderror">
                            @error('level_of_education')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "degree_title">Degree Title</label>
                            <input type="text" name="degree_title" id="degree_title" placeholder="Degree Title" class="@error('degree_title') is-invalid @enderror">
                            @error('degree_title')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "group">Group</label>
                            <input type="text" name="group" id="group" placeholder="Group" class="@error('group') is-invalid @enderror">
                            @error('group')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "institution_name">Institution Name</label>
                            <input type="text" name="institution_name" id="institution_name" placeholder="Institution Name" class="@error('institution_name') is-invalid @enderror">
                            @error('institution_name')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "result">Result</label>
                            <input type="text" name="result" id="result" placeholder="Result" class="@error('result') is-invalid @enderror">
                            @error('result')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "scale">Scale</label>
                            <input type="decimal" name="scale" id="scale" placeholder="Scale" class="@error('scale') is-invalid @enderror">
                            @error('scale')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "cgpa">CGPA</label>
                            <input type="decimal" name="cgpa" id="cgpa" placeholder="CGPA" class="@error('cgpa') is-invalid @enderror">
                            @error('cgpa')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "batch">Batch</label>
                            <input type="integer" name="batch" id="batch" placeholder="Batch" class="@error('batch') is-invalid @enderror">
                            @error('batch')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "passing_year">Passing Year</label>
                            <input type="integer" name="passing_year" id="passing_year" placeholder="Passing Year" class="@error('passing_year') is-invalid @enderror">
                            @error('passing_year')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <!-- <div>
                            <button type = "button" name = "addEducation" id = "addEducation" class="btn btn-primary">Add+</button>
                        </div> -->
                    </div>
                </div>


                <!-- Training Details Section -->
                <h4>Training Details</h4>
                <div class="container bg-light text-dark my-4 py-3">
                    <div class="row">
                        <div class="col-md-4">
                            <label for = "training_title">Training Title</label>
                            <input type="text" name="training_title" id="training_title" placeholder="Training Title" class="@error('training_title') is-invalid @enderror">
                            @error('training_title')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "country">Country</label>
                            <input type="text" name="country" id="country" placeholder="Country" class="@error('country') is-invalid @enderror">
                            @error('country')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "topic">Topic</label>
                            <input type="text" name="topic" id="topic" placeholder="Topic" class="@error('topic') is-invalid @enderror">
                            @error('topic')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "institution_name1">Institution Name</label>
                            <input type="text" name="institution_name1" id="institution_name1" placeholder="Institution Name" class="@error('institution_name1') is-invalid @enderror">
                            @error('institution_name1')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for="start_date">Start Date</label>
                            <input type="date" name="start_date" id="start_date" placeholder="Start Date" class="@error('start_date') is-invalid @enderror">
                            @error('start_date')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for="end_date">End Date</label>
                            <input type="date" name="end_date" id="end_date" placeholder="End Date" class="@error('end_date') is-invalid @enderror">
                            @error('end_date')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "training_year">Training Year</label>
                            <input type="integer" name="training_year" id="training_year" placeholder="Training Year" class="@error('training_year') is-invalid @enderror">
                            @error('training_year')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <!-- <div>
                            <button type = "button" name = "addTraining" id = "addTraining" class="btn btn-primary">Add+</button>
                        </div> -->
                    </div>
                </div>
    
                <!-- Experience Details Section -->
                <h4>Experience Details</h4>
                <div class="container bg-light text-dark my-4 py-3">
                    <div class="row">
                        <div class="col-md-4">
                            <label for = "company_name">Company Name</label>
                            <input type="text" name="company_name" id="company_name" placeholder="Company Name" class="@error('company_name') is-invalid @enderror">
                            @error('company_name')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "designation">Designation</label>
                            <input type="text" name="designation" id="designation" placeholder="Designation" class="@error('designation') is-invalid @enderror">
                            @error('designation')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for="start_date">Start Date</label>
                            <input type="date" name="start_date" id="start_date" placeholder="Start Date" class="@error('start_date') is-invalid @enderror">
                            @error('start_date')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for="end_date">End Date</label>
                            <input type="date" name="end_date" id="end_date" placeholder="End Date" class="@error('end_date') is-invalid @enderror">
                            @error('end_date')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "department">Department</label>
                            <input type="text" name="department" id="department" placeholder="Department" class="@error('department') is-invalid @enderror">
                            @error('department')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "company_location">Company Location</label>
                            <input type="text" name="company_location" id="company_location" placeholder="Company Location" class="@error('company_location') is-invalid @enderror">
                            @error('company_location')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <!-- <div>
                            <button type = "button" name = "addExperience" id = "addExperience" class="btn btn-primary">Add+</button>
                        </div> -->
                    </div>
                </div>
    
                <!-- Joining Details Section -->
                <h4>Joining Details</h4>
                <div class="container bg-light text-dark my-4 py-3">
                    <div class="row">
                        <div class="col-md-4">
                            <label for = "joining_date">Joining Date</label>
                            <input type="date" name="joining_date" id="joining_date" placeholder="Joining Date" class="@error('joining_date') is-invalid @enderror">
                            @error('joining_date')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "joining_location">Joining Location</label> 
                            <input type="text" name="joining_location" id="joining_location" placeholder="Joining Location" class="@error('joining_location') is-invalid @enderror">
                            @error('joining_location')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "department1">Department</label>
                            <input type="text" name="department1" id="department1" placeholder="Department" class="@error('department1') is-invalid @enderror">
                            @error('department1')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "designation1">Designation</label>
                            <input type="text" name="designation1" id="designation1" placeholder="Designation" class="@error('designation1') is-invalid @enderror">
                            @error('designation1')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                    </div>
                </div>
                <div class="center">
                    <button type="submit" id="NewEmployee" class="btn btn-primary">Save</button>
                </div>
                </form>
             </div>
        </div>
    </div>
</div>
</body>
</html>
