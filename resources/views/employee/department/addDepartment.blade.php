<div id="addDepartment" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading">
            <h3 class="center">Add Department</h3>
            <span class="close-modal" data-modal-id="addDepartment">&times;</span>
        </div>

        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Add Department</h3>
                    </div>
                </div>
                
                <!-- form start -->
                <form id="AddDepartmentForm" method="post">
                    @csrf
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="deptName">Department Name</label>
                                        <input type="text" name="deptName" class="form-control" id="deptName">
                                        <span class="text-danger error" id="deptName_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="center">
                                <button type="submit" id="InsertDepartment" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
