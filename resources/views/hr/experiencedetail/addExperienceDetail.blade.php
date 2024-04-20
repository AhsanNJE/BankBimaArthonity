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
<div id= "EmployeeExperience" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading">
            <h3 class="center">Add Experience Detail</h3>
            <span class="close-modal" data-modal-id="EmployeeExperience">&times;</span>
        </div>

        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Add Experience Detail</h3>
                    </div>
                </div>
                
                <!-- form start -->
                <form action="{{ route('insertexperience.info')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Experience Details Section -->
                <h4>Experience Details</h4>
                <div class="container bg-light text-dark my-4 py-3">
                    <div class="row">
                        <div class="col-md-4">
                            <label for = "company_name">Company Name</label>
                            <input type="text" name="company_name" id="company_name" placeholder="Company Name" class="@error('company_name') is-invalid @enderror">
                            @error('company_name')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "designation">Designation</label>
                            <input type="text" name="designation" id="designation" placeholder="Designation" class="@error('designation') is-invalid @enderror">
                            @error('designation')<strong class="text-danger">{{ $message }}</strong>@enderror
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
                            <label for = "department">Department</label>
                            <input type="text" name="department" id="department" placeholder="Department" class="@error('department') is-invalid @enderror">
                            @error('department')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "company_location">Company Location</label>
                            <input type="text" name="company_location" id="company_location" placeholder="Company Location" class="@error('company_location') is-invalid @enderror">
                            @error('company_location')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div>
                            <button type = "button" name = "addExperience" id = "addExperience" class="btn btn-primary">Add+</button>
                        </div>
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
