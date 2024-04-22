<form action="{{ route('show.educationinfo')}}" method="POST" enctype="multipart/form-data">
@csrf
<!-- Display Education Details -->
@foreach($employeeeducation as $item)
<div class="general">
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
</form>