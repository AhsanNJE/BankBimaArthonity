<form action="{{ route('show.educationinfo')}}" method="POST" enctype="multipart/form-data">
@csrf
<!-- Display Education Details -->
@foreach($employeeeducation as $item)
<div class="general">
    @if ($loop->first)
        <div class="details-head">
            <div class="image-round">
                <img src="/storage/profiles/{{ $item->user->image !== null ? $item->user->image : ($item->user->gender == 'female' ? 'female.png' : 'male.png') }}" alt="" height="100px" width="100px">
            </div> 
            <div class="highlight">
                <span class="name"> {{$item->user->user_name}} </span><br>
            </div>   
        </div>
        <ul>
        <li data-id="1">Personal Details</li>
        <div class="details-table" style="">
            <div class="row each-row">
                <div class="col-md-2 bold">Name</div> 
                <div class="col-md-4 bold">{{ $item->personalDetail->name }}</div>
                <div class="col-md-2 bold">Father's Name</div> 
                <div class="col-md-4 bold">{{ $item->personalDetail->fathers_name }}</div>
            </div>
            <div class="row each-row">
                <div class="col-md-2 bold">Mother's Name</div> 
                <div class="col-md-4 bold">{{ $item->personalDetail->mothers_name }}</div>
                <div class="col-md-2 bold">Date of Birth</div> 
                <div class="col-md-4 bold">{{ $item->personalDetail->date_of_birth }}</div>
            </div>
            <div class="row each-row">
                <div class="col-md-2 bold">Gender</div> 
                <div class="col-md-4 bold">{{ $item->personalDetail->gender }}</div>
                <div class="col-md-2 bold">Religion</div> 
                <div class="col-md-4 bold">{{ $item->personalDetail->religion }}</div>
            </div>
            <div class="row each-row">
                <div class="col-md-2 bold">Marital Status</div> 
                <div class="col-md-4 bold">{{ $item->personalDetail->marital_status }}</div>
                <div class="col-md-2 bold">Nationality</div> 
                <div class="col-md-4 bold">{{ $item->personalDetail->nationality }}</div>
            </div>
            <div class="row each-row">
                <div class="col-md-2 bold">Phone Number</div> 
                <div class="col-md-4 bold">{{ $item->personalDetail->phn_no }}</div>
                <div class="col-md-2 bold">Blood Group</div> 
                <div class="col-md-4 bold">{{ $item->personalDetail->blood_group }}</div>
            </div>
            <div class="row each-row">
                <div class="col-md-2 bold">Email</div> 
                <div class="col-md-4 bold">{{ $item->personalDetail->email }}</div>
                <div class="col-md-2 bold">Address</div> 
                <div class="col-md-4 bold">{{ $item->personalDetail->address }}</div>
            </div>
        </div>
    </div>
    @endif

    <li data-id="1">Education Details</li>
    <div class="details-table" style="">
        <div class="row each-row">
            <div class="col-md-2 bold">Level of Education</div> 
            <div class="col-md-4 bold">{{ $item->level_of_education }}</div>
            <div class="col-md-2 bold">Degree Title</div> 
            <div class="col-md-4 bold">{{ $item->degree_title }}</div>
        </div>
        <div class="row each-row">
            <div class="col-md-2 bold">Group</div> 
            <div class="col-md-4 bold">{{ $item->group }}</div>
            <div class="col-md-2 bold">Institution Name</div> 
            <div class="col-md-4 bold">{{ $item->institution_name }}</div>
        </div>
        <div class="row each-row">
            <div class="col-md-2 bold">Result</div> 
            <div class="col-md-4 bold">{{ $item->result }}</div>
            <div class="col-md-2 bold">Scale</div> 
            <div class="col-md-4 bold">{{ $item->scale }}</div>
        </div>
        <div class="row each-row">
            <div class="col-md-2 bold">CGPA</div> 
            <div class="col-md-4 bold">{{ $item->cgpa }}</div>
            <div class="col-md-2 bold">Batch</div> 
            <div class="col-md-4 bold">{{ $item->batch }}</div>
        </div>
        <div class="row each-row">
            <div class="col-md-2 bold">Passing Year</div> 
            <div class="col-md-4 bold">{{ $item->passing_year }}</div>
        </div>
    </div>
</div>    
    @endforeach
</ul>
</form>