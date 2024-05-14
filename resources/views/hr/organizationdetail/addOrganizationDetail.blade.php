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
       
        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Add Organization Detail</h3>
                        <span class="close-modal" data-modal-id="EmployeeOrganization">&times;</span>
                    </div>
                </div>
                <br>
                <!-- form start -->
                <form id="AddOrganizationDetailForm" action="{{ route('insertorganization.info')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Insert Organization Details Section -->
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
                                    <label for = "joining_date">Joining Date</label>
                                    <input type="date" name="joining_date" id="joining_date" class="form-control">
                                    <span class="text-danger error" id="joining_date_error"></span>
                                </div>
                            </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for = "location">Joining Location</label> 
                                <input type="text" name="location" id="location" class="form-control">
                                <div id="location-list">
                                            <ul>

                                            </ul>
                                </div> 
                                <span class="text-danger error" id="location_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for = "department">Department</label>
                                <input type="text" name="department" id="department"  class="form-control">
                                <div id="department-list">
                                    <ul>

                                    </ul>
                                </div>
                                <span class="text-danger error" id="department_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for = "designation">Designation</label>
                                <input type="text" name="designation" id="designation"  class="form-control">
                                <div id="designation-list">
                                    <ul>

                                    </ul>
                                </div>
                                <span class="text-danger error" id="designation_error"></span>
                            </div>
                        </div>
                    </div>
                    </div>
                 </div>
                 <div class="center">
                    <button type="submit" id="InsertOrganization" class="btn btn-primary">Save</button>
                </div>
                </div> 
                </form>
             </div>
        </div>
    </div>
</div>
</body>
</html>
