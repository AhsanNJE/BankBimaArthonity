@section('style')
    <style>
        .modal-subject {
            width: 75%;
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
    <title>Document</title>
</head>
<body>
<div id= "NewEmployee" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading">
            <h3 class="center">Add Employee</h3>
            <span class="close-modal" data-modal-id="NewEmployee">&times;</span>
        </div>

        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Add Employee</h3>
                    </div>
                </div>
                
                <!-- form start -->
                <form action="{{ route('inserttraining.info')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Training Details Section -->
                <h4>Training Details</h4>
                <div class="container bg-light text-dark my-4 py-3">
                    <div class="row">
                        <div class="col-md-4">
                            <label for = "training_title">Training Title</label>
                            <input type="text" name="training_title" id="training_title" placeholder="Training Title" class="@error('training_title') is-invalid @enderror">
                            @error('training_title')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "country">Country</label>
                            <input type="text" name="country" id="country" placeholder="Country" class="@error('country') is-invalid @enderror">
                            @error('country')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "topic">Topic</label>
                            <input type="text" name="topic" id="topic" placeholder="Topic" class="@error('topic') is-invalid @enderror">
                            @error('topic')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "institution_name1">Institution Name</label>
                            <input type="text" name="institution_name1" id="institution_name1" placeholder="Institution Name" class="@error('institution_name1') is-invalid @enderror">
                            @error('institution_name1')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for="start_date">Start Date</label>
                            <input type="date" name="start_date" id="start_date" placeholder="Start Date" class="@error('start_date') is-invalid @enderror">
                            @error('start_date')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for="end_date">End Date</label>
                            <input type="date" name="end_date" id="end_date" placeholder="End Date" class="@error('end_date') is-invalid @enderror">
                            @error('end_date')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "training_year">Training Year</label>
                            <input type="integer" name="training_year" id="training_year" placeholder="Training Year" class="@error('training_year') is-invalid @enderror">
                            @error('training_year')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <!-- <div>
                            <button type = "button" name = "addTraining" id = "addTraining" class="btn btn-primary">Add+</button>
                        </div> -->
                    </div>
                  </div>
                  <div class="center">
                    <button type="submit" id="NewEmployee" class="btn btn-primary">Save</button>
                </div>
                </form>
             </div>
        </div>
    </div>
</div>
</body>
</html>
