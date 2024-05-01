

<!-- Display Personal Details -->
@foreach($employeepersonal as $item)
<div class="general">
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
    @endforeach