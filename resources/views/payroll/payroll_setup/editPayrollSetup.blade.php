<div id="editPayrollSetup" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading">
            <h3 class="center">Edit Payroll Setup</h3>
            <span class="close-modal" data-modal-id="editPayrollSetup">&times;</span>
        </div>

        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Edit Payroll Setup</h3>
                    </div>
                </div>
                <!-- form start -->
                <form id="EditPayrollForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="center">
                        <div class="card-body">
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label for="updateWith">Employee Type</label>
                                <select name="with" id="updateWith">
                                    <option value="">Select employee Type</option>
                                </select>
                                <span class="text-danger error" id="update_with_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="updateUser">Employee Name</label>
                                <input type="text" name="user" class="form-control" id="updateUser" autocomplete="off">
                                <div id="update-user">
                                    <ul>

                                    </ul>
                                </div>
                                <span class="text-danger error" id="update_user_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="updateHead">Payroll Category</label>
                                <select name="head" id="updateHead">
                                    <option value="">Select Payroll Category</option>
                                </select>
                                <span class="text-danger error" id="update_head_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="updateAmount">Amount</label>
                                <input type="text" name="amount" class="form-control" id="updateAmount">
                                <span class="text-danger error" id="update_amount_error"></span>
                            </div>
                            <div class="center">
                                <button type="submit" class="btn btn-primary" id="UpdatePayroll">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>