<div id="addEmployee" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading">
            <h3 class="center">Add Employee</h3>
            <span class="close-modal" data-modal-id="addEmployee">&times;</span>
        </div>

        <div class="center">
            <div class="card card-primary col-md-10">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Add Employee</h3>
                    </div>
                </div>
                
                <!-- form start -->
                <form id="AddEmployeeForm" method="post">
                    @csrf
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="unitName">Unit Name</label>
                                        <input type="text" name="unitName" class="form-control" id="unitName">
                                        <span class="text-danger error" id="unitName_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="center">
                                <button type="submit" id="addEmployee" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
