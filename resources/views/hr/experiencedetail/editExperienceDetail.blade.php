
<div id="editExperienceDetail" class="modal-container">
    <div class="modal-subject">
           <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Edit Employee Experience Detail</h3>
                        <span class="close-modal" data-modal-id="editExperienceDetail">&times;</span>
                    </div>
                </div>
                <br>
                <!-- form start -->
                <form id="EditExperienceForm" class="experience-form" action="{{ route('update.employee.experience') }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="id" id="id">
                                <input type="hidden" name="empId" id="empId">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for = "update_company_name">Company Name</label>
                                        <input type="text" name="company_name" id="update_company_name" class="form-control">
                                        <span class="text-danger error" id="update_company_name_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for = "update_department">Department</label>
                                        <input type="text" name="department" id="update_department" class="form-control">
                                        <span class="text-danger error" id="update_department_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for = "update_designation">Designation</label>
                                        <input type="text" name="designation" id="update_designation" class="form-control">
                                        <span class="text-danger error" id="update_designation_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for = "update_company_location">Company Address</label>
                                        <input type="text" name="company_location" id="update_company_location"  class="form-control">
                                        <span class="text-danger error" id="update_company_location_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="update_start_date">Start Date</label>
                                        <input type="date" name="start_date" id="update_start_date" class="form-control">
                                        <span class="text-danger error" id="update_start_date_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="update_end_date">End Date</label>
                                        <input type="date" name="end_date" id="update_end_date" class="form-control">
                                        <span class="text-danger error" id="update_end_date_error"></span>
                                    </div>
                                </div>
                                <div class="center">
                                    <button type="submit" id="UpdateExperience" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
