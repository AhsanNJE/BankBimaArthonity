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
        

        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Add Experience Detail</h3>
                        <span class="close-modal" data-modal-id="EmployeeExperience">&times;</span>
                    </div>
                </div>
                <br>
                <div id="formContainer">
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
                    </div>
                    <!-- form start -->
                    <form id='form3' class='experience-form' action="{{ route('insertexperience.info')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Education Details Section -->
                        <div class="center">
                            <div class="card-body">
                                <div class="row"> 
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for = "company_name">Company Name</label>
                                            <input type="text" name="company_name" id="company_name" class="form-control">
                                            <span class="text-danger error" id="company_name_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for = "department">Department</label>
                                            <input type="text" name="department" id="department" class="form-control">
                                            <span class="text-danger error" id="department_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for = "designation">Designation</label>
                                            <input type="text" name="designation" id="designation" class="form-control">
                                            <span class="text-danger error" id="designation_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for = "company_location">Company Address</label>
                                            <input type="text" name="company_location" id="company_location"  class="form-control">
                                            <span class="text-danger error" id="company_location_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="start_date">Start Date</label>
                                            <input type="date" name="start_date" id="start_date" class="form-control">
                                            <span class="text-danger error" id="start_date_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="end_date">End Date</label>
                                            <input type="date" name="end_date" id="end_date" class="form-control">
                                            <span class="text-danger error" id="end_date_error"></span>
                                        </div>
                                    </div>
                                    <!-- Forms will be dynamically added here -->
                                </div>
                            </div>
                        </div> 
                    </form>
                </div>
                <div>
                    <button type = "button" name = "addExperience" id = "addExperience" class="btn btn-primary">Add+</button>
                </div>
                <div class="center">
                    <button type="submit" id="InsertExperience" class="btn btn-primary">Save</button>
                </div>
             </div>
        </div>
    </div>
</div>
</body>
</html>
