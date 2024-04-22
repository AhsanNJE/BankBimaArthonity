
<ul>
    {{-- Personal Details Part Starts --}}
    <li data-id="1">Personal Details</li>
    <div class="personal">
        <div class="details-head">
            <div class="image-round">
                <img src="/storage/profiles/{{ $employee->image !== null ? $employee->image : ($employee->gender == 'female' ? 'female.png' : 'male.png') }}" alt="" height="100px" width="100px">
            </div> 
            <div class="highlight">
                <span class="name"> {{$employee->user_name}} </span><br>
                <span class="designation"> {{$employee->organizationDetail->Designation->designation}} </span>
            </div>   
        </div>
        <div class="details-table" style="">
            <div class="row each-row"> 
                <div class="col-md-2 bold">Name</div>
                <div class="col-md-4">{{$employee->user_name}}</div>
                <div class="col-md-2 bold">Father's Name</div>
                <div class="col-md-4">{{$employee->personalDetail->fathers_name}}</div>
            </div>
            <div class="row each-row"> 
                <div class="col-md-2 bold">Mother's Name</div>
                <div class="col-md-4">{{$employee->personalDetail->mothers_name}}</div>
                <div class="col-md-2 bold">DOB</div>
                <div class="col-md-4">{{$employee->personalDetail->date_of_birth}}</div>
            </div>
            <div class="row each-row"> 
                <div class="col-md-2 bold">Gender</div>
                <div class="col-md-4">{{$employee->personalDetail->gender}}</div>
                <div class="col-md-2 bold">Religion</div>
                <div class="col-md-4">{{ $employee->personalDetail->religion}}</div>
            </div>
            <div class="row each-row"> 
                <div class="col-md-2 bold">Marital Status</div>
                <div class="col-md-4">{{$employee->personalDetail->marital_status}}</div>
                <div class="col-md-2 bold">Nationality</div>
                <div class="col-md-4">{{$employee->personalDetail->nationality}}</div>
            </div>
            <div class="row each-row"> 
                <div class="col-md-2 bold">Phone Number</div>
                <div class="col-md-4">{{$employee->personalDetail->phn_no}}</div>
                <div class="col-md-2 bold">Blood Group</div>
                <div class="col-md-4">{{$employee->personalDetail->blood_group}}</div>
            </div>
            <div class="row each-row"> 
                <div class="col-md-2 bold">Email</div>
                <div class="col-md-4">{{$employee->personalDetail->email}}</div>
                <div class="col-md-2 bold">Address</div>
                <div class="col-md-4">{{$employee->personalDetail->address}}</div>
            </div>
        </div>
    </div>


    {{-- Education Details part starts --}}
    <li data-id="2">Education Details</li>
    <div class="education">
        <div class="details-table" style="">
            <div class="row each-row"> 
                <div class="col-md-2 bold">Level of Education</div>
                <div class="col-md-4">{{$employee->educationDetail->level_of_education}}</div>
                <div class="col-md-2 bold">Degree Title</div>
                <div class="col-md-4">{{$employee->educationDetail->degree_title}}</div>
            </div>
            <div class="row each-row"> 
                <div class="col-md-2 bold">Group</div>
                <div class="col-md-4">{{$employee->educationDetail->group}}</div>
                <div class="col-md-2 bold">Institution Name</div>
                <div class="col-md-4">{{$employee->educationDetail->institution_name}}</div>
            </div>
            <div class="row each-row"> 
                <div class="col-md-2 bold">Result</div>
                <div class="col-md-4">{{$employee->educationDetail->result}}</div>
                <div class="col-md-2 bold">Scale</div>
                <div class="col-md-4">{{$employee->educationDetail->scale}}</div>
            </div>
            <div class="row each-row"> 
                <div class="col-md-2 bold">CGPA</div>
                <div class="col-md-4">{{$employee->educationDetail->cgpa}}</div>
                <div class="col-md-2 bold">Batch</div>
                <div class="col-md-4">{{$employee->educationDetail->batch}}</div>
            </div>
            <div class="row each-row"> 
                <div class="col-md-2 bold">Passing Year</div>
                <div class="col-md-4">{{$employee->educationDetail->passing_year}}</div>
            </div>
        </div>
    </div>


    {{-- Training Details part starts --}}
    <li data-id="3">Training Details</li>
    <div class="training">
        <div class="details-table" style="">
            <div class="row each-row"> 
                <div class="col-md-2 bold">Training Title</div>
                <div class="col-md-4">{{$employee->trainingDetail->training_title}}</div>
                <div class="col-md-2 bold">Country</div>
                <div class="col-md-4">{{$employee->trainingDetail->country}}</div>
            </div>
            <div class="row each-row"> 
                <div class="col-md-2 bold">Topic</div>
                <div class="col-md-4">{{$employee->trainingDetail->topic}}</div>
                <div class="col-md-2 bold">Institution Name</div>
                <div class="col-md-4">{{$employee->trainingDetail->institution_name}}</div>
            </div>
            <div class="row each-row"> 
                <div class="col-md-2 bold">Start Date</div>
                <div class="col-md-4">{{$employee->trainingDetail->start_date}}</div>
                <div class="col-md-2 bold">End Date</div>
                <div class="col-md-4">{{$employee->trainingDetail->end_date}}</div>
            </div>
            <div class="row each-row"> 
                <div class="col-md-2 bold">Training Year</div>
                <div class="col-md-4">{{$employee->trainingDetail->training_year}}</div>
            </div>
        </div>
    </div>


    <!-- {{-- Experience Details part starts --}}
    <li data-id="3">Experience Details</li>
    <div class="experience">
        <div class="details-table" style="">
            <div class="row each-row"> 
                <div class="col-md-2 bold">Company Name</div>
                <div class="col-md-4">{{$employee->experienceDetail->company_name}}</div>
                <div class="col-md-2 bold">Designation</div>
                <div class="col-md-4">{{$employee->experienceDetail->Designation->designation}}</div>
            </div>
            <div class="row each-row"> 
                <div class="col-md-2 bold">Start Date</div>
                <div class="col-md-4">{{$employee->experienceDetail->start_date}}</div>
                <div class="col-md-2 bold">End Date</div>
                <div class="col-md-4">{{$employee->experienceDetail->end_date}}</div>
            </div>
            <div class="row each-row"> 
                <div class="col-md-2 bold">Department</div>
                <div class="col-md-4">{{$employee->experienceDetail->Department->dept_name}}</div>
                <div class="col-md-2 bold">Company Location</div>
                <div class="col-md-4">{{$employee->experienceDetail->Location->upazila}}</div>
            </div>
        </div>
    </div> -->


    {{-- Organization Details part starts --}}
    <li data-id="3">Organization Details</li>
    <div class="organization">
        <div class="details-table" style="">
            <div class="row each-row"> 
                <div class="col-md-2 bold">Joining Date</div>
                <div class="col-md-4">{{$employee->organizationDetail->joining_date}}</div>
                <div class="col-md-2 bold">Joining Location</div>
                <div class="col-md-4">{{$employee->organizationDetail->Location->upazila}}</div>
            </div>
            <div class="row each-row"> 
                <div class="col-md-2 bold">Department</div>
                <div class="col-md-4">{{$employee->organizationDetail->Department->dept_name}}</div>
                <div class="col-md-2 bold">Designation</div>
                <div class="col-md-4">{{$employee->organizationDetail->Designation->designation}}</div>
            </div>
        </div>
    </div>
</ul>