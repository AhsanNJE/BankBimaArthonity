@section('style')
    <style>
        .modal-subject {
            width: 85%;
        }
        label {
            font-size: 16px !important;
            font-weight: normal !important;
        }
        .container {
        background-color: #E8E8E8!important; 
        }
    </style>
@endsection

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Employee Information</title>
</head>
<body>
<div class="container">
 <div class="center">
        <form action="{{ route('show.experienceinfo')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @foreach($employeeinfo as $item)
        
        <!-- Display Experience Details -->
        <h4>Experience Details</h4>
            <div class="container bg-light text-dark my-4 py-3">
                <div class="row">
                    <div class="col-md-4">
                        <p>Company Name: {{ $item->experienceDetail->company_name }}</p>
                    </div>
                    <div class="col-md-4">
                        <p>Designation: {{ $item->experienceDetail->designation }}</p>
                    </div>
                    <div class="col-md-4">
                        <p>Start Date : {{ $item->experienceDetail->start_date }}</p>
                    </div>
                    <div class="col-md-4">
                        <p>End Date : {{ $item->experienceDetail->end_date }}</p>
                    </div>
                    <div class="col-md-4">
                        <p>Department: {{ $item->experienceDetail->department }}</p>
                    </div>
                    <div class="col-md-4">
                        <p>Company Location: {{ $item->experienceDetail->company_location }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </form>
    </div>
</div>

</body>
</html>