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
        <form action="{{ route('show.organizationinfo')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @foreach($employeeinfo as $item)

            <!-- Display Organization Details -->
        <h4>Organization Details</h4>
            <div class="container bg-light text-dark my-4 py-3">
                <div class="row">
                    <div class="col-md-4">
                        <p>Joining Date: {{ $item->joiningDetail->joining_date }}</p>
                    </div>
                    <div class="col-md-4">
                        <p>Joining Location: {{ $item->joiningDetail->joining_location }}</p>
                    </div>
                    <div class="col-md-4">
                        <p>Department: {{ $item->joiningDetail->department }}</p>
                    </div>
                    <div class="col-md-4">
                        <p>Designation: {{ $item->joiningDetail->designation }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </form>
    </div>
</div>

</body>
</html>