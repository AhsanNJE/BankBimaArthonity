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
<div id= "EmployeeEducation" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading">
            <h3 class="center">Add Education Detail</h3>
            <span class="close-modal" data-modal-id="EmployeeEducation">&times;</span>
        </div>

        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Add Education Detail</h3>
                    </div>
                </div>
                
                <!-- form start -->
                <form id="AddEducationDetailForm" action="{{ route('inserteducation.info')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Education Details Section -->
                <div class="center">
                    <div class="card-body">
                        <div class="row">
                        <div class="col-md-6">  
                                <div class="form-group">   
                                    <label for="with">Employee Type</label>
                                    <select name="with" id="with">
                                        <option value="">Select Employee Type</option>
                                        @foreach ($tranwith as $with)
                                            <option value="{{$with->id}}">{{$with->tran_with_name}}</option>                                                
                                        @endforeach
                                    </select>
                                    <span class="text-danger error" id="with_error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user">Name</label>
                                    <input type="text" name="user" class="form-control" id="user" autocomplete="off">
                                    <div id="user-list">
                                        <ul>

                                        </ul>
                                    </div>
                                    <span class="text-danger error" id="user_error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for = "level_of_education">Level of Education</label>
                                    <input type="text" name="level_of_education[]" id="level_of_education" class="form-control">
                                    <span class="text-danger error" id="level_of_education_error"></span>
                                </div>
                            </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for = "degree_title">Degree Title</label>
                                <input type="text" name="degree_title[]" id="degree_title" class="form-control">
                                <span class="text-danger error" id="degree_title_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for = "group">Group</label>
                                <input type="text" name="group[]" id="group" class="form-control">
                                <span class="text-danger error" id="group_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for = "institution_name">Institution Name</label>
                                <input type="text" name="institution_name[]" id="institution_name" class="form-control">
                                <span class="text-danger error" id="institution_name_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for = "result">Result</label>
                                <input type="text" name="result[]" id="result" class="form-control">
                                <span class="text-danger error" id="result_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for = "scale">Scale</label>
                                <input type="decimal" name="scale[]" id="scale" class="form-control">
                                <span class="text-danger error" id="scale_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for = "cgpa">CGPA</label>
                                <input type="decimal" name="cgpa[]" id="cgpa" class="form-control">
                                <span class="text-danger error" id="cgpa_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for = "batch">Batch</label>
                                <input type="integer" name="batch[]" id="batch" class="form-control">
                                <span class="text-danger error" id="batch_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for = "passing_year">Passing Year</label>
                                <input type="integer" name="passing_year[]" id="passing_year" class="form-control">
                                <span class="text-danger error" id="passing_year_error"></span>
                            </div>
                        </div>
                    </div>
                        <div>
                            <button type = "button" name = "addEducation" id = "addEducation" class="btn btn-primary">Add+</button>
                        </div>
                    </div>
                 </div>
                 <div class="center">
                    <button type="submit" id="InsertEducation" class="btn btn-primary">Save</button>
                </div>
                </div> 
                </form>
             </div>
        </div>
    </div>
</div>
</body>
</html>
