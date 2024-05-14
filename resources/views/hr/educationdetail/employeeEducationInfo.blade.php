<ul>
    @foreach($personaldetail as $item)
        @if ($loop->first)
        <li data-id="1">Personal Details</li>
        <div class="personal">
            <div class="details-head">
                <div class="image-round">
                    <img src="/storage/profiles/{{ $item->image !== null ? $item->image : ($item->gender == 'female' ? 'female.png' : 'male.png') }}" alt="" height="100px" width="100px">
                </div> 
                <div class="highlight">
                    <span class="name"> {{$item->name}} </span><br>
                </div>   
            </div>
            
            <div class="details-table" style="">
                <div class="row each-row">
                    <div class="col-md-2 bold">Name</div> 
                    <div class="col-md-4">{{ $item->name }}</div>
                    <div class="col-md-2 bold">Father's Name</div> 
                    <div class="col-md-4">{{ $item->fathers_name }}</div>
                </div>
                <div class="row each-row">
                    <div class="col-md-2 bold">Mother's Name</div> 
                    <div class="col-md-4">{{ $item->mothers_name }}</div>
                    <div class="col-md-2 bold">Date of Birth</div> 
                    <div class="col-md-4">{{ $item->date_of_birth }}</div>
                </div>
                <div class="row each-row">
                    <div class="col-md-2 bold">Gender</div> 
                    <div class="col-md-4">{{ $item->gender }}</div>
                    <div class="col-md-2 bold">Religion</div> 
                    <div class="col-md-4">{{ $item->religion }}</div>
                </div>
                <div class="row each-row">
                    <div class="col-md-2 bold">Marital Status</div> 
                    <div class="col-md-4">{{ $item->marital_status }}</div>
                    <div class="col-md-2 bold">Nationality</div> 
                    <div class="col-md-4">{{ $item->nationality }}</div>
                </div>
                <div class="row each-row">
                    <div class="col-md-2 bold">Phone Number</div> 
                    <div class="col-md-4">{{ $item->phn_no }}</div>
                    <div class="col-md-2 bold">Nid No.</div> 
                    <div class="col-md-4">{{ $item->nid_no }}</div>
                    
                </div>
                <div class="row each-row">
                    <div class="col-md-2 bold">Blood Group</div> 
                    <div class="col-md-4">{{ $item->blood_group }}</div>
                    <div class="col-md-2 bold">Email</div> 
                    <div class="col-md-4">{{ $item->email }}</div>
                </div>
                <div class="row each-row">
                    <div class="col-md-2 bold">Address</div> 
                    <div class="col-md-4">{{ $item->address }}</div>
                </div>
            </div>
        </div>
        
    

        <li data-id="2">Education Details</li> 
        @endif
    @endforeach 


    @if($employeeeducation->isEmpty())
        <div class="education">
            <div class="details-table" style="">
                <div class="row each-row"> 
                    <div>No Education Details Available!</div>
                </div>
            </div>
        </div>
    @else

        @foreach($employeeeducation as $item)
        <div class="education">
            <div class="details-table" style="">
                <div class="row each-row">
                    <div class="col-md-2 bold">Level of Education</div> 
                    <div class="col-md-4">{{ $item->level_of_education }}</div>
                    <div class="col-md-2 bold">Degree Title</div> 
                    <div class="col-md-4">{{ $item->degree_title }}</div>
                </div>
                <div class="row each-row">
                    <div class="col-md-2 bold">Group</div> 
                    <div class="col-md-4">@isset($item->group)
                                            {{ $item->group }}
                                        @else
                                            Group unavailable
                                        @endisset</div>
                    <div class="col-md-2 bold">Institution Name</div> 
                    <div class="col-md-4">{{ $item->institution_name }}</div>
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
                    <div class="col-md-4">{{ $item->cgpa }}</div>
                    <div class="col-md-2 bold">Batch</div> 
                    <div class="col-md-4">@isset($item->batch)
                                            {{ $item->batch }}
                                        @else
                                            Batch unavailable
                                        @endisset</div>
                </div>
                <div class="row each-row">
                    <div class="col-md-2 bold">Passing Year</div> 
                    <div class="col-md-4">{{ $item->passing_year }}</div>
                </div>
            </div>
        </div>  
        @endforeach 
    @endif
</ul
