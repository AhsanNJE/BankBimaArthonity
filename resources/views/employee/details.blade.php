<ul>
    {{-- General Info Part Starts --}}
    <li>General Information</li>
    <div class="general">
        <div class="details-head">
            <div class="image-round">
                <img src="/storage/profiles/{{$employee->image}}" alt="" height="100px" width="100px">
            </div> 
            <div class="highlight">
                <span class="name"> {{$employee->user_name}} </span><br>
                <span class="designation"> {{$employee->designation->designation}} </span>
            </div>   
        </div>
        <div class="details-table" style="">
            <div class="row each-row"> 
                <div class="col-md-2 bold">Name</div>
                <div class="col-md-4">{{$employee->user_name}}</div>
                <div class="col-md-2 bold">Work Location</div>
                <div class="col-md-4">{{$employee->location->upazila}}, {{$employee->location->district}}, {{$employee->location->division}} </div>
            </div>
            <div class="row each-row"> 
                <div class="col-md-2 bold">Gender</div>
                <div class="col-md-4">{{$employee->gender}}</div>
                <div class="col-md-2 bold">DOB</div>
                <div class="col-md-4">{{$employee->dob}}</div>
            </div>
            <div class="row each-row"> 
                <div class="col-md-2 bold">Employee Type</div>
                <div class="col-md-4">{{$employee->tran_user_type}}</div>
                <div class="col-md-2 bold">Department</div>
                <div class="col-md-4">{{ $employee->department->dept_name}}</div>
            </div>
        </div>
    </div>


    {{-- contact info part starts --}}
    <li>Contact Information</li>
    <div class="contact">

    </div>


    {{-- Address info part starts --}}
    <li>Address Information</li>
    <div class="address">
            
    </div>


    {{-- Payroll info part starts --}}
    <li>Payroll Information</li>
    <div class="payroll">
            
    </div>


    {{-- Other info part starts --}}
    <li>Others Information</li>
    <div class="others">
            
    </div>
</ul>