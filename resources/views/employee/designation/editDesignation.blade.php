<div id="editDesignation" class="modal-container">
    <div class="modal-subject">
        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Edit Designation</h3>
                        <span class="close-modal" data-modal-id="editDesignation">&times;</span>
                    </div>
                </div>
                
                <!-- form start -->
                <form id="EditDesignationForm" method="post">
                    @csrf
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" name="id" id="id">
                                    <div class="form-group">
                                        <label for="updateDesignations">Designation</label>
                                        <input type="text" name="designations" class="form-control" id="updateDesignations">
                                        <span class="text-danger error" id="update_designations_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="updateDepartment">Department</label>
                                        <input type="text" name="department" class="form-control" id="updateDepartment" autocomplete="off">
                                        <div id="update-department">
                                            <ul>

                                            </ul>
                                        </div>
                                        <span class="text-danger error" id="update_department_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="center">
                                <button type="submit" id="UpdateDesignation" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
