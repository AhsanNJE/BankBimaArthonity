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
        <form action="{{ route('show.educationinfo')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Display Personal Details -->
        @foreach($employeeeducation as $item)

            <!-- Display Education Details -->
        <h4>Educational Details</h4>
            <div class="container bg-light text-dark my-4 py-3">
                <div class="row">
                    <div class="col-md-4">
                        <p>Level of Education: {{ $item->educationDetail->level_of_education }}</p>
                    </div>
                    <div class="col-md-4">
                        <p>Degree Title: {{ $item->educationDetail->degree_title }}</p>
                    </div>
                    <div class="col-md-4">
                        <p>Group: {{ $item->educationDetail->group }}</p>
                    </div>
                    <div class="col-md-4">
                        <p>Institution Name: {{ $item->educationDetail->institution_name }}</p>
                    </div>
                    <div class="col-md-4">
                        <p>Result: {{ $item->educationDetail->result }}</p>
                    </div>
                    <div class="col-md-4">
                        <p>Scale: {{ $item->educationDetail->scale }}</p>
                    </div>
                    <div class="col-md-4">
                        <p>CGPA: {{ $item->educationDetail->cgpa }}</p>
                    </div>
                    <div class="col-md-4">
                        <p>Batch : {{ $item->educationDetail->batch }}</p>
                    </div>
                    <div class="col-md-4">
                        <p>Passing Year: {{ $item->educationDetail->passing_year }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </form>
    </div>
</div>

</body>
</html>