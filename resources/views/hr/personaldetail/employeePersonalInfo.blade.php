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
        <!-- Display Personal Details -->
        @foreach($employeeinfo as $item)
        <h4>Personal Details</h4>
            <div class="container bg-light text-dark my-4 py-3">
                <div class="row">
                    <div class="col-md-4">
                        <p>Name: {{ $item->name }}</p>
                    </div>
                    <div class="col-md-4">
                        <p>Father's Name: {{ $item->fathers_name }}</p>
                    </div>
                    <div class="col-md-4">
                        <p>Mother's Name: {{ $item->mothers_name }}</p>
                    </div>
                    <div class="col-md-4">
                        <p>Date of Birth: {{ $item->date_of_birth }}</p>
                    </div>
                    <div class="col-md-4">
                        <p>Gender: {{ $item->gender }}</p>
                    </div>
                    <div class="col-md-4">
                        <p>Religion: {{ $item->religion }}</p>
                    </div>
                    <div class="col-md-4">
                        <p>Marital Status: {{ $item->marital_status }}</p>
                    </div>
                    <div class="col-md-4">
                        <p>Nationality: {{ $item->nationality }}</p>
                    </div>
                    <div class="col-md-4">
                        <p>Phone Number: {{ $item->phn_no }}</p>
                    </div>
                    <div class="col-md-4">
                        <p>Blood Group: {{ $item->blood_group }}</p>
                    </div>
                    <div class="col-md-4">
                        <p>Email: {{ $item->email }}</p>
                    </div>
                    <div class="col-md-4">
                        <p>Address: {{ $item->address }}</p>
                    </div>
                </div>
            </div>    

            <!-- Display Education Details -->
        <!-- <h4>Educational Details</h4>
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
             -->

            <!-- Display Training Details -->
        <!-- <h4>Training Details</h4>
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
            </div>     -->

            <!-- Display Experience Details -->
        <!-- <h4>Experience Details</h4>
            <div class="container bg-light text-dark my-4 py-3">
                <div class="row">
                    <div class="col-md-4">
                        <p>Company Name: {{ $item->experienceDetail->company_name }}</p>
                    </div>
                    <div class="col-md-4">
                        <p>Designation: {{ $item->experienceDetail->designation }}</p>
                    </div>
                    <div class="col-md-4">
                        <p>Start Date : {{ $item->trainingDetail->start_date }}</p>
                    </div>
                    <div class="col-md-4">
                        <p>End Date : {{ $item->trainingDetail->end_date }}</p>
                    </div>
                    <div class="col-md-4">
                        <p>Department: {{ $item->experienceDetail->department }}</p>
                    </div>
                    <div class="col-md-4">
                        <p>Company Location: {{ $item->experienceDetail->company_location }}</p>
                    </div>
                </div>
            </div> -->


            <!-- Display Joining Details -->
        <!-- <h4>Joining Details</h4>
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
            </div> -->
            @endforeach
        </form>
    </div>
</div>

</body>
</html>