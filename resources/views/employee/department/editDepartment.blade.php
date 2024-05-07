<div id="editDepartment" class="modal-container">
    <div class="modal-subject">
        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Edit Department</h3>
                        <span class="close-modal" data-modal-id="editDepartment">&times;</span>
                    </div>
                </div>
                
                <!-- form start -->
                <form id="EditDepartmentForm" method="post">
                    @csrf
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" name="id" id="id">
                                    <div class="form-group">
                                        <label for="updateDeptName">Department Name</label>
                                        <input type="text" name="deptName" class="form-input" id="updateDeptName">
                                        <span class="text-danger error" id="update_deptName_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="center">
                                <button type="submit" id="UpdateDepartment" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
