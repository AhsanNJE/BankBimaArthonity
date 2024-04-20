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
        <form action="{{ route('show.personalinfo')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @foreach($employeeinfo as $item)

        <!-- Display Training Details -->
        <h4>Training Details</h4>
            <div class="container bg-light text-dark my-4 py-3">
                <div class="row">
                    <div class="col-md-4">
                        <p>Training Title: {{ $item->trainingDetail->training_title }}</p>
                    </div>
                    <div class="col-md-4">
                        <p>Country: {{ $item->trainingDetail->country }}</p>
                    </div>
                    <div class="col-md-4">
                        <p>Topic: {{ $item->trainingDetail->topic }}</p>
                    </div>
                    <div class="col-md-4">
                        <p>Institution Name: {{ $item->trainingDetail->institution_name }}</p>
                    </div>
                    <div class="col-md-4">
                        <p>Start Date : {{ $item->trainingDetail->start_date }}</p>
                    </div>
                    <div class="col-md-4">
                        <p>End Date : {{ $item->trainingDetail->end_date }}</p>
                    </div>
                    <div class="col-md-4">
                        <p>Training Year: {{ $item->trainingDetail->training_year }}</p>
                    </div>
                    </div>
                </div>
            </div>    
            @endforeach
        </form>
    </div>
</div>
</body>
</html>