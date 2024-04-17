@section('style')
    <style>
        .modal-subject {
            width: 60%;
        }
    </style>
@endsection


<div id="EmployeeEdit" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading">
            <h3 class="center">Edit Employee</h3>
            <span class="close-modal" data-modal-id="EmployeeEdit">&times;</span>
        </div>

        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Edit Employee</h3>
                    </div>
                </div>
                
                <!-- form start -->
                <form id="EmployeeEditForm" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <h4>Personal Details</h4>    
                <div class="container bg-light text-dark my-4 py-3">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="employee_id" id="employee_id">
                            <label for = "update_name">Name</label>
                            <input type="text" name="name" id="update_name" placeholder="Name" class="@error('name') is-invalid @enderror">
                            @error('name')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "update_fathers_name">Father's Name</label>
                            <input type="text" name="fathers_name" id="update_fathers_name" placeholder="Father's Name" class="@error('fathers_name') is-invalid @enderror">
                            @error('fathers_name')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "update_mothers_name">Mother's Name</label>
                            <input type="text" name="mothers_name" id="update_mothers_name" placeholder="Mother's Name" class="@error('mothers_name') is-invalid @enderror">
                            @error('mothers_name')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "update_date_of_birth">Date of Birth</label>
                            <input type="date" name="date_of_birth" id="update_date_of_birth" placeholder="Date of Birth" class="@error('date_of_birth') is-invalid @enderror">
                            @error('date_of_birth')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "update_gender">Gender</label>
                            <select name="gender" id="update_gender" class="@error('gender') is-invalid @enderror">
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="others">Others</option>
                            </select>
                            @error('gender')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "update_religion">Religion</label>
                            <input type="text" name="religion" id="update_religion" placeholder="Religion" class="@error('religion') is-invalid @enderror">
                            @error('religion')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "update_marital_status">Marital Status</label>
                            <input type="text" name="marital_status" id="update_marital_status" placeholder="Marital Status" class="@error('marital_status') is-invalid @enderror">
                            @error('marital_status')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "update_nationality">Nationality</label>
                            <input type="text" name="nationality" id="update_nationality" placeholder="Nationality" class="@error('nationality') is-invalid @enderror">
                            @error('nationality')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "update_phn_no">Phone No.</label>
                            <input type="text" name="phn_no" id="update_phn_no" placeholder="Phone No." class="@error('phn_no') is-invalid @enderror">
                            @error('phn_no')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "update_blood_group">Blood Group</label>
                            <input type="text" name="blood_group" id="update_blood_group" placeholder="Blood Group" class="@error('blood_group') is-invalid @enderror">
                            @error('blood_group')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "update_email">Email</label>
                            <input type="email" name="email" id="update_email" placeholder="Email" class="@error('email') is-invalid @enderror">
                            @error('email')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "update_address">Address</label>
                            <input type="text" name="address" id="update_address" placeholder="Address" class="@error('address') is-invalid @enderror">
                            @error('address')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for="update_image">Image</label>
                            <input type="file" name="image" id="update_image" placeholder="Image" class="@error('image') is-invalid @enderror">
                            @error('image')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                    </div>
                </div>
    
                <!-- Education Details Section -->
                <h4>Education Details</h4>
                <div class="container bg-light text-dark my-4 py-3">
                    <div class="row">
                        <div class="col-md-4">
                            <label for = "update_level_of_education">Level of Education</label>
                            <input type="text" name="inputs[0][level_of_education]" id="update_level_of_education" placeholder="Level of Education" class="@error('level_of_education') is-invalid @enderror">
                            @error('level_of_education')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "update_degree_title">Degree Title</label>
                            <input type="text" name="inputs[0][degree_title]" id="update_degree_title" placeholder="Degree Title" class="@error('degree_title') is-invalid @enderror">
                            @error('degree_title')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "update_group">Group</label>
                            <input type="text" name="inputs[0][group]" id="update_group" placeholder="Group" class="@error('group') is-invalid @enderror">
                            @error('group')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "update_institution_name">Institution Name</label>
                            <input type="text" name="inputs[0][institution_name]" id="update_institution_name" placeholder="Institution Name" class="@error('institution_name') is-invalid @enderror">
                            @error('institution_name')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "update_result">Result</label>
                            <input type="text" name="inputs[0][result]" id="update_result" placeholder="Result" class="@error('result') is-invalid @enderror">
                            @error('result')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "update_scale">Scale</label>
                            <input type="decimal" name="inputs[0][scale]" id="update_scale" placeholder="Scale" class="@error('scale') is-invalid @enderror">
                            @error('scale')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "update_cgpa">CGPA</label>
                            <input type="decimal" name="inputs[0][cgpa]" id="update_cgpa" placeholder="CGPA" class="@error('cgpa') is-invalid @enderror">
                            @error('cgpa')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "update_batch">Batch</label>
                            <input type="integer" name="inputs[0][batch]" id="update_batch" placeholder="Batch" class="@error('batch') is-invalid @enderror">
                            @error('batch')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "update_passing_year">Passing Year</label>
                            <input type="integer" name="inputs[0][passing_year]" id="update_passing_year" placeholder="Passing Year" class="@error('passing_year') is-invalid @enderror">
                            @error('passing_year')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div>
                            <button type = "button" name = "addEducation" id = "addEducation" class="btn btn-primary">Add+</button>
                        </div>
                    </div>
                </div>


                <!-- Training Details Section -->
                <h4>Training Details</h4>
                <div class="container bg-light text-dark my-4 py-3">
                    <div class="row">
                        <div class="col-md-4">
                            <label for = "update_training_title">Training Title</label>
                            <input type="text" name="training_title" id="update_training_title" placeholder="Training Title" class="@error('training_title') is-invalid @enderror">
                            @error('training_title')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "update_country">Country</label>
                            <input type="text" name="country" id="update_country" placeholder="Country" class="@error('country') is-invalid @enderror">
                            @error('country')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "update_topic">Topic</label>
                            <input type="text" name="topic" id="update_topic" placeholder="Topic" class="@error('topic') is-invalid @enderror">
                            @error('topic')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "update_institution_name1">Institution Name</label>
                            <input type="text" name="institution_name1" id="update_institution_name1" placeholder="Institution Name" class="@error('institution_name1') is-invalid @enderror">
                            @error('institution_name1')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for="update_start_date">Start Date</label>
                            <input type="date" name="start_date" id="update_start_date" placeholder="Start Date" class="@error('start_date') is-invalid @enderror">
                            @error('start_date')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for="update_end_date">End Date</label>
                            <input type="date" name="end_date" id="update_end_date" placeholder="End Date" class="@error('end_date') is-invalid @enderror">
                            @error('end_date')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "update_training_year">Training Year</label>
                            <input type="integer" name="training_year" id="update_training_year" placeholder="Training Year" class="@error('training_year') is-invalid @enderror">
                            @error('training_year')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div>
                            <button type = "button" name = "addTraining" id = "addTraining" class="btn btn-primary">Add+</button>
                        </div>
                    </div>
                </div>
    
                <!-- Experience Details Section -->
                <h4>Experience Details</h4>
                <div class="container bg-light text-dark my-4 py-3">
                    <div class="row">
                        <div class="col-md-4">
                            <label for = "update_company_name">Company Name</label>
                            <input type="text" name="company_name" id="update_company_name" placeholder="Company Name" class="@error('company_name') is-invalid @enderror">
                            @error('company_name')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "update_designation">Designation</label>
                            <input type="text" name="designation" id="update_designation" placeholder="Designation" class="@error('designation') is-invalid @enderror">
                            @error('designation')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for="update_start_date">Start Date</label>
                            <input type="date" name="start_date" id="update_start_date" placeholder="Start Date" class="@error('start_date') is-invalid @enderror">
                            @error('start_date')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for="update_end_date">End Date</label>
                            <input type="date" name="end_date" id="update_end_date" placeholder="End Date" class="@error('end_date') is-invalid @enderror">
                            @error('end_date')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "update_department">Department</label>
                            <input type="text" name="department" id="update_department" placeholder="Department" class="@error('department') is-invalid @enderror">
                            @error('department')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "update_company_location">Company Location</label>
                            <input type="text" name="company_location" id="update_company_location" placeholder="Company Location" class="@error('company_location') is-invalid @enderror">
                            @error('company_location')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div>
                            <button type = "button" name = "addExperience" id = "addExperience" class="btn btn-primary">Add+</button>
                        </div>
                    </div>
                </div>
    
                <!-- Joining Details Section -->
                <h4>Joining Details</h4>
                <div class="container bg-light text-dark my-4 py-3">
                    <div class="row">
                        <div class="col-md-4">
                            <label for = "update_joining_date">Joining Date</label>
                            <input type="date" name="joining_date" id="update_joining_date" placeholder="Joining Date" class="@error('joining_date') is-invalid @enderror">
                            @error('joining_date')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "update_joining_location">Joining Location</label> 
                            <input type="text" name="joining_location" id="update_joining_location" placeholder="Joining Location" class="@error('joining_location') is-invalid @enderror">
                            @error('joining_location')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "update_department1">Department</label>
                            <input type="text" name="department1" id="update_department1" placeholder="Department" class="@error('department1') is-invalid @enderror">
                            @error('department1')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "update_designation1">Designation</label>
                            <input type="text" name="designation1" id="update_designation1" placeholder="Designation" class="@error('designation1') is-invalid @enderror">
                            @error('designation1')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                    </div>
                </div>
                <div class="center">
                    <button type="submit" id="EmployeeEdit" class="btn btn-primary">Save</button>
                </div>
                </form>
             </div>
        </div>
    </div>
</div>

