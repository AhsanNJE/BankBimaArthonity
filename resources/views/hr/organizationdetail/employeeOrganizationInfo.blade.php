<form action="{{ route('show.organizationinfo')}}" method="POST" enctype="multipart/form-data">
@csrf
<!-- Display Organization Details -->
@foreach($employeeorganization as $item)
<div class="general">
    <div class="details-head">
        <div class="image-round">
            <img src="/storage/profiles/{{ $item->image !== null ? $item->image : ($item->gender == 'female' ? 'female.png' : 'male.png') }}" alt="" height="100px" width="100px">
        </div> 
        <div class="highlight">
            <span class="name"> {{$item->user->user_name}} </span><br>
        </div>   
    </div>
    <div class="details-table" style="">
        <div class="row each-row">
            <div class="col-md-2 bold">Joining Date</div> 
            <div class="col-md-4 bold">{{ $item->joining_date }}</div>
            <div class="col-md-2 bold">Joining Location</div> 
            <div class="col-md-4 bold">{{ $item->Location->upazila }}</div>
        </div>
        <div class="row each-row">
            <div class="col-md-2 bold">Department</div> 
            <div class="col-md-4 bold">{{ $item->Department->dept_name }}</div>
            <div class="col-md-2 bold">Designation</div> 
            <div class="col-md-4 bold">{{ $item->Designation->designation }}</div>
        </div>
    </div>
</div>    
    @endforeach
</form>