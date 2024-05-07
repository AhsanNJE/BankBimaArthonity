<div id="addDesignation" class="modal-container">
    <div class="modal-subject">
        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Add Designation</h3>
                        <span class="close-modal" data-modal-id="addDesignation">&times;</span>
                    </div>
                </div>
                
                <!-- form start -->
                <form id="AddDesignationForm" method="post">
                    @csrf
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="designations">Designation</label>
                                        <input type="text" name="designations" class="form-control" id="designations">
                                        <span class="text-danger error" id="designations_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="department">Department</label>
                                        <input type="text" name="department" class="form-control" id="department" autocomplete="off">
                                        <div id="department-list">
                                            <ul>

                                            </ul>
                                        </div>
                                        <span class="text-danger error" id="department_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="center">
                                <button type="submit" id="InsertDesignation" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
