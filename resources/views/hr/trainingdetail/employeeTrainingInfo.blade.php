<form action="{{ route('show.personalinfo')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <!-- Display Training Details -->
    @foreach($employeetraining as $item)
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
                <div class="col-md-2 bold">Training Title</div>
                <div class="col-md-4 bold">{{ $item->training_title }}</div>
                <div class="col-md-2 bold">Country</div>
                <div class="col-md-4 bold">{{ $item->country }}</div>
            </div>
            <div class="row each-row">
                <div class="col-md-2 bold">Topic</div>
                <div class="col-md-4 bold">{{ $item->topic }}</div>
                <div class="col-md-2 bold">Institution Name</div>
                <div class="col-md-4 bold">{{ $item->institution_name }}</div>
            </div>
            <div class="row each-row">
                <div class="col-md-2 bold">Start Date</div>
                <div class="col-md-4 bold">{{ $item->start_date }}</div>
                <div class="col-md-2 bold">End Date</div>
                <div class="col-md-4 bold">{{ $item->end_date }}</div>
            </div>
            <div class="row each-row">
                <div class="col-md-2 bold">Training Year</div>
                <div class="col-md-4 bold">{{ $item->training_year }}</div>
            </div>
        </div>
    </div>    
    @endforeach
</form>
    