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
                <form action="{{ route('inserteducation.info')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Education Details Section -->
                <h4>Education Details</h4>
                <div class="container bg-light text-dark my-4 py-3">
                    <div class="row">
                        <div class="col-md-4">
                            <label for = "level_of_education">Level of Education</label>
                            <input type="text" name="level_of_education" id="level_of_education" placeholder="Level of Education" class="@error('level_of_education') is-invalid @enderror">
                            @error('level_of_education')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "degree_title">Degree Title</label>
                            <input type="text" name="degree_title" id="degree_title" placeholder="Degree Title" class="@error('degree_title') is-invalid @enderror">
                            @error('degree_title')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "group">Group</label>
                            <input type="text" name="group" id="group" placeholder="Group" class="@error('group') is-invalid @enderror">
                            @error('group')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "institution_name">Institution Name</label>
                            <input type="text" name="institution_name" id="institution_name" placeholder="Institution Name" class="@error('institution_name') is-invalid @enderror">
                            @error('institution_name')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "result">Result</label>
                            <input type="text" name="result" id="result" placeholder="Result" class="@error('result') is-invalid @enderror">
                            @error('result')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "scale">Scale</label>
                            <input type="decimal" name="scale" id="scale" placeholder="Scale" class="@error('scale') is-invalid @enderror">
                            @error('scale')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "cgpa">CGPA</label>
                            <input type="decimal" name="cgpa" id="cgpa" placeholder="CGPA" class="@error('cgpa') is-invalid @enderror">
                            @error('cgpa')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "batch">Batch</label>
                            <input type="integer" name="batch" id="batch" placeholder="Batch" class="@error('batch') is-invalid @enderror">
                            @error('batch')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <div class="col-md-4">
                            <label for = "passing_year">Passing Year</label>
                            <input type="integer" name="passing_year" id="passing_year" placeholder="Passing Year" class="@error('passing_year') is-invalid @enderror">
                            @error('passing_year')<strong class="text-danger">{{ $message }}</strong>@enderror
                        </div>
                        <!-- <div>
                            <button type = "button" name = "addEducation" id = "addEducation" class="btn btn-primary">Add+</button>
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
