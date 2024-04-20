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
<div id= "EmployeeOrganization" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading">
            <h3 class="center">Add Organization Detail</h3>
            <span class="close-modal" data-modal-id="EmployeeOrganization">&times;</span>
        </div>

        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Add Organization Detail</h3>
                    </div>
                </div>
                
                <!-- form start -->
                <form action="{{ route('insertorganization.info')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                <!-- Organization Details Section -->
                <h4>Organization Details</h4>
                <div class="container bg-light text-dark my-4 py-3">
                    <div class="row">
                        <div class="col-md-4">
                            <label for = "joining_date">Joining Date</label>
                            <input type="date" name="joining_date" id="joining_date" placeholder="Joining Date" class="@error('joining_date') is-invalid @enderror">
                            @error('joining_date')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "joining_location">Joining Location</label> 
                            <input type="text" name="joining_location" id="joining_location" placeholder="Joining Location" class="@error('joining_location') is-invalid @enderror">
                            @error('joining_location')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "department1">Department</label>
                            <input type="text" name="department1" id="department1" placeholder="Department" class="@error('department1') is-invalid @enderror">
                            @error('department1')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "designation1">Designation</label>
                            <input type="text" name="designation1" id="designation1" placeholder="Designation" class="@error('designation1') is-invalid @enderror">
                            @error('designation1')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                    </div>
                </div>
                <div class="center">
                    <button type="submit" id="EmployeeOrganization" class="btn btn-primary">Save</button>
                </div>
                </form>
             </div>
        </div>
    </div>
</div>
</body>
</html>
