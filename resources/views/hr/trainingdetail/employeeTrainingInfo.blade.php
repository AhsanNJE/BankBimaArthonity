<ul>
    @foreach($employeetraining as $item)
    @if ($loop->first)
    <li data-id="1">Personal Details</li>
    <div class="personal">
        <div class="details-head">
            <div class="image-round">
                <img src="/storage/profiles/{{ $item->user->image !== null ? $item->user->image : ($item->user->gender == 'female' ? 'female.png' : 'male.png') }}" alt="" height="100px" width="100px">
            </div> 
            <div class="highlight">
                <span class="name"> {{$item->user->user_name}} </span><br>
            </div>   
        </div>
        
        <div class="details-table" style="">
            <div class="row each-row">
                <div class="col-md-2 bold">Name</div> 
                <div class="col-md-4">{{ $item->personalDetail->name }}</div>
                <div class="col-md-2 bold">Father's Name</div> 
                <div class="col-md-4">{{ $item->personalDetail->fathers_name }}</div>
            </div>
            <div class="row each-row">
                <div class="col-md-2 bold">Mother's Name</div> 
                <div class="col-md-4">{{ $item->personalDetail->mothers_name }}</div>
                <div class="col-md-2 bold">Date of Birth</div> 
                <div class="col-md-4">{{ $item->personalDetail->date_of_birth }}</div>
            </div>
            <div class="row each-row">
                <div class="col-md-2 bold">Gender</div> 
                <div class="col-md-4">{{ $item->personalDetail->gender }}</div>
                <div class="col-md-2 bold">Religion</div> 
                <div class="col-md-4">{{ $item->personalDetail->religion }}</div>
            </div>
            <div class="row each-row">
                <div class="col-md-2 bold">Marital Status</div> 
                <div class="col-md-4">{{ $item->personalDetail->marital_status }}</div>
                <div class="col-md-2 bold">Nationality</div> 
                <div class="col-md-4">{{ $item->personalDetail->nationality }}</div>
            </div>
            <div class="row each-row">
                <div class="col-md-2 bold">Phone Number</div> 
                <div class="col-md-4">{{ $item->personalDetail->phn_no }}</div>
                <div class="col-md-2 bold">Nid No.</div> 
                <div class="col-md-4">{{ $item->personalDetail->nid_no }}</div>
                
            </div>
            <div class="row each-row">
                <div class="col-md-2 bold">Blood Group</div> 
                <div class="col-md-4">{{ $item->personalDetail->blood_group }}</div>
                <div class="col-md-2 bold">Email</div> 
                <div class="col-md-4">{{ $item->personalDetail->email }}</div>
            </div>
            <div class="row each-row">
                <div class="col-md-2 bold">Address</div> 
                <div class="col-md-4">{{ $item->personalDetail->address }}</div>
            </div>
        </div>
    </div>
    <li data-id="2">Training Details</li>
    @endif
    <div class="training">
        <div class="details-table" style="">
            <div class="row each-row">
                <div class="col-md-2 bold">Training Title</div>
                <div class="col-md-4">{{ $item->training_title }}</div>
                <div class="col-md-2 bold">Country</div>
                <div class="col-md-4">@isset($item->country)
                                        {{ $item->country }}
                                    @else
                                        No country available
                                    @endisset</div>
            </div>
            <div class="row each-row">
                <div class="col-md-2 bold">Topic</div>
                <div class="col-md-4">{{ $item->topic }}</div>
                <div class="col-md-2 bold">Institution Name</div>
                <div class="col-md-4">{{ $item->institution_name }}</div>
            </div>
            <div class="row each-row">
                <div class="col-md-2 bold">Start Date</div>
                <div class="col-md-4">@isset($item->start_date)
                                        {{ $item->start_date }}
                                    @else
                                        No start date available
                                    @endisset</div>
                <div class="col-md-2 bold">End Date</div>
                <div class="col-md-4">@isset($item->end_date)
                                        {{ $item->end_date }}
                                    @else
                                        No end date available
                                    @endisset</div>
            </div>
            <div class="row each-row">
                <div class="col-md-2 bold">Training Year</div>
                <div class="col-md-4">{{ $item->training_year }}</div>
            </div>
        </div>
    </div>    
    @endforeach
</ul>
