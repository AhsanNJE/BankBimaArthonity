
<ul>
    {{-- General Info Part Starts --}}
    <li data-id="1">General Information</li>
    <div class="general">
        <div class="details-head">
            <div class="image-round">
                <img src="/storage/profiles/{{ $employee->image !== null ? $employee->image : ($employee->gender == 'female' ? 'female.png' : 'male.png') }}" alt="" height="100px" width="100px">
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
                <div class="col-md-4">{{$employee->Withs->tran_with_name}}</div>
                <div class="col-md-2 bold">Department</div>
                <div class="col-md-4">{{ $employee->department->dept_name}}</div>
            </div>
            <div class="row each-row"> 
                <div class="col-md-2 bold">NID</div>
                <div class="col-md-4">{{$employee->nid}}</div>
            </div>
        </div>
    </div>


    {{-- contact info part starts --}}
    <li data-id="2">Contact Information</li>
    <div class="contact">
        <div class="details-table" style="">
            <div class="row each-row"> 
                <div class="col-md-2 bold">Email</div>
                <div class="col-md-4">{{$employee->user_email}}</div>
            </div>
            <div class="row each-row"> 
                <div class="col-md-2 bold">Contact No</div>
                <div class="col-md-4">{{$employee->user_phone}}</div>
            </div>
        </div>
    </div>


    {{-- Address info part starts --}}
    <li data-id="3">Address Information</li>
    <div class="address">
        <div class="details-table" style="">
            <div class="row each-row"> 
                <div class="col-md-3 bold">Permanent Address</div>
                <div class="col-md-9">{{$employee->address}}</div>
            </div>
            <div class="row each-row"> 
                <div class="col-md-3 bold">Present Address</div>
                {{-- <div class="col-md-9">{{$employee->user_phone}}</div> --}}
            </div>
        </div>
    </div>


    {{-- Payroll info part starts --}}
    <li data-id="4">Payroll Information</li>
    <div class="payroll">
        
    </div>


    {{-- Other info part starts --}}
    <li data-id="5">Others Information</li>
    <div class="others">
            
    </div>
</ul>