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
<div id= "editOrganization" class="modal-container">
    <div class="modal-subject">

        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Edit Organization Detail</h3>
                        <span class="close-modal" data-modal-id="editOrganization">&times;</span>
                    </div>
                </div>
                <br>
                <!-- form start -->
                <form id="EditOrganizationDetailForm" action="{{ route('insertorganization.info')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <!-- Insert Organization Details Section -->
                        <div class="center">
                            <div class="card-body">
                                <div class="row">
                                    <input type="hidden" name="id" id="id">
                                    <input type="hidden" name="emp_id" id="emp_id">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for = "update_joining_date">Joining Date</label>
                                            <input type="date" name="joining_date" id="update_joining_date" class="form-control">
                                            <span class="text-danger error" id="update_joining_date_error"></span>
                                        </div>
                                    </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for = "updatLocation">Joining Location</label> 
                                        <input type="text" name="location" id="updateLocation" class="form-control">
                                        <div id="update-location">
                                                    <ul>

                                                    </ul>
                                        </div> 
                                        <span class="text-danger error" id="update_location_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for = "updateDepartment">Department</label>
                                        <input type="text" name="department" id="updateDepartment"  class="form-control">
                                        <div id="update-department">
                                            <ul>

                                            </ul>
                                        </div>
                                        <span class="text-danger error" id="update_department_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for = "updateDesignation">Designation</label>
                                        <input type="text" name="designation" id="updateDesignation"  class="form-control">
                                        <div id="update-designation">
                                            <ul>

                                            </ul>
                                        </div>
                                        <span class="text-danger error" id="update_designation_error"></span>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                 <div class="center">
                    <button type="submit" id="UpdateOrganization" class="btn btn-primary">Save</button>
                </div>
                </div> 
                </form>
             </div>
        </div>
    </div>
</div>
</body>
</html>
