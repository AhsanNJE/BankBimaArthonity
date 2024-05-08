

@if(!$employee && !$employee->personalDetail && !$education->isNotEmpty() && !$training->isNotEmpty() && !$experience->isNotEmpty() && !$employee->organizationDetail)
    <div class="details-table">
        <div class="row each-row"> 
            <div class="col-md-12 text-center bold">Employee details do not exist.</div>
        </div>
    </div>
@else

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
                <div class="col-md-4 ">{{ $employee->personalDetail->phn_no }}</div>
                <div class="col-md-2 bold">Nid No.</div> 
                <div class="col-md-4 ">{{ $employee->personalDetail->nid_no }}</div>
                
            </div>
            <div class="row each-row">
                <div class="col-md-2 bold">Blood Group</div> 
                <div class="col-md-4 ">{{ $employee->personalDetail->blood_group }}</div>
                <div class="col-md-2 bold">Email</div> 
                <div class="col-md-4 ">{{ $employee->personalDetail->email }}</div>
            </div>
            <div class="row each-row">
                <div class="col-md-2 bold">Address</div> 
                <div class="col-md-4 ">{{ $employee->personalDetail->address }}</div>
            </div>
        </div>
        </div>
    </div>


    <li data-id="2">Education Details</li>
    @if($education->isNotEmpty())
        @foreach($education as $employees)
        {{-- Education Details part starts --}}
        <div class="education">
            <div class="details-table" style="">
                <div class="row each-row"> 
                    <div class="col-md-2 bold">Level of Education</div>
                    <div class="col-md-4">{{$employees->level_of_education}}</div>
                    <div class="col-md-2 bold">Degree Title</div>
                    <div class="col-md-4">{{$employees->degree_title}}</div>
                </div>
                <div class="row each-row"> 
                    <div class="col-md-2 bold">Group</div>
                    <div class="col-md-4">@isset($item->group)
                                            {{ $item->group }}
                                        @else
                                            Group unavailable
                                        @endisset</div>
                    <div class="col-md-2 bold">Institution Name</div>
                    <div class="col-md-4">{{$employees->institution_name}}</div>
                </div>
                <div class="row each-row"> 
                    <div class="col-md-2 bold">Result</div>
                    <div class="col-md-4">@isset($item->result)
                                            {{ $item->result }}
                                        @else
                                            Result unavailable
                                        @endisset</div>
                    <div class="col-md-2 bold">Scale</div>
                    <div class="col-md-4">@isset($item->scale)
                                            {{ $item->scale }}
                                        @else
                                            Scale unavailable
                                        @endisset</div>
                </div>
                <div class="row each-row"> 
                    <div class="col-md-2 bold">CGPA</div>
                    <div class="col-md-4">{{$employees->cgpa}}</div>
                    <div class="col-md-2 bold">Batch</div>
                    <div class="col-md-4">@isset($item->batch)
                                            {{ $item->batch }}
                                        @else
                                            Batch unavailable
                                        @endisset</div>
                </div>
                <div class="row each-row"> 
                    <div class="col-md-2 bold">Passing Year</div>
                    <div class="col-md-4">{{$employees->passing_year}}</div>
                </div>
            </div>
        </div>
        @endforeach
    @else
    <div class="education">
        <div class="details-table" style="">
            <div class="row each-row"> 
                <div>No Education Details Available!</div>
            </div>
        </div>
    </div>
    @endif


    {{-- Training Details part starts --}}
    <li data-id="3">Training Details</li>
    @if($training->isNotEmpty())
        @foreach($training as $employees)
        <div class="training">
            <div class="details-table" style="">
                <div class="row each-row"> 
                    <div class="col-md-2 bold">Training Title</div>
                    <div class="col-md-4">{{$employees->training_title}}</div>
                    <div class="col-md-2 bold">Country</div>
                    <div class="col-md-4">@isset($item->country)
                                            {{ $item->country }}
                                        @else
                                            Country unavailable
                                        @endisset</div>
                </div>
                <div class="row each-row"> 
                    <div class="col-md-2 bold">Topic</div>
                    <div class="col-md-4">{{$employees->topic}}</div>
                    <div class="col-md-2 bold">Institution Name</div>
                    <div class="col-md-4">{{$employees->institution_name}}</div>
                </div>
                <div class="row each-row"> 
                    <div class="col-md-2 bold">Start Date</div>
                    <div class="col-md-4">@isset($item->start_date)
                                            {{ $item->start_date }}
                                        @else
                                            Start date unavailable
                                        @endisset</div>
                    <div class="col-md-2 bold">End Date</div>
                    <div class="col-md-4">@isset($item->end_date)
                                            {{ $item->end_date }}
                                        @else
                                            End date unavailable
                                        @endisset</div>
                </div>
                <div class="row each-row"> 
                    <div class="col-md-2 bold">Training Year</div>
                    <div class="col-md-4">{{$employees->training_year}}</div>
                </div>
            </div>
        </div>
        @endforeach
    @else
    <div class="training">
        <div class="details-table" style="">
            <div class="row each-row"> 
                <div>No Training Details Available!</div>
            </div>
        </div>
    </div>
    @endif


    
    {{-- Experience Details part starts --}}
    <li data-id="4">Experience Details</li>
    @if($experience->isNotEmpty())
        @foreach($experience as $employees)
        <div class="experience">
            <div class="details-table" style="">
                <div class="row each-row"> 
                    <div class="col-md-2 bold">Company Name</div>
                    <div class="col-md-4">{{$employees->company_name}}</div>
                    <div class="col-md-2 bold">Designation</div>
                    <div class="col-md-4">{{$employees->designation}}</div>
                </div>
                <div class="row each-row"> 
                    <div class="col-md-2 bold">Start Date</div>
                    <div class="col-md-4">@isset($item->start_date)
                                        {{ $item->start_date }}
                                    @else
                                        Start date unavailable
                                    @endisset</div>
                    <div class="col-md-2 bold">End Date</div>
                    <div class="col-md-4">@isset($item->end_date)
                                        {{ $item->end_date }}
                                    @else
                                        End date unavailable
                                    @endisset</div>
                </div>
                <div class="row each-row"> 
                    <div class="col-md-2 bold">Department</div>
                    <div class="col-md-4">{{$employees->department}}</div>
                    <div class="col-md-2 bold">Company Location</div>
                    <div class="col-md-4">{{$employees->company_location}}</div>
                </div>
            </div>
        </div>
        @endforeach
    @else
    <div class="experience">
        <div class="details-table" style="">
            <div class="row each-row"> 
                <div>No Experience Details Available!</div>
            </div>
        </div>
    </div>
    @endif


    {{-- Organization Details part starts --}}
    <li data-id="5">Organization Details</li>
    @isset($employee->organizationDetail)
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
    @else
    <div class="organization">
        <div class="details-table" style="">
            <div class="row each-row"> 
                <div>No Organization Details Available!</div>
            </div>
        </div>
    </div>
    @endif

    {{-- Payroll details part starts --}}
    <li data-id="6">Payroll Details</li>
    <div class="payroll">
        <table class="show-table">
            <thead>
                <tr>
                    <th>Income Description</th>
                    <th>Income Rate</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payroll as $pay)
                    <tr>
                        <td>{{ $pay->Head->tran_head_name }}</td>
                        <td>{{ $pay->amount }} Tk.</td>
                    </tr>   
                @endforeach
            </tbody>
        </table>
    </div>
@endif
</ul>