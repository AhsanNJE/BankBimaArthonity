
<div id="editEducationDetail" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading">
            <h3 class="center">Edit Employee Education Detail</h3>
            <span class="close-modal" data-modal-id="editEducationDetail">&times;</span>
        </div>

        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Edit Employee Education Detail</h3>
                    </div>
                </div>
                
                <!-- form start -->
                <form id="EditEducationForm" class="education-form" action="{{ route('update.employee.education') }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="id" id="id">
                                <input type="hidden" name="empId" id="empId">
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label for = "update_level_of_education">Level of Education</label>
                                            <input type="text" name="level_of_education" id="update_level_of_education" class="form-control">
                                            <span class="text-danger error" id="update_level_of_education_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for = "update_degree_title">Degree Title</label>
                                            <input type="text" name="degree_title" id="update_degree_title" class="form-control">
                                            <span class="text-danger error" id="update_degree_title_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for = "update_group">Group</label>
                                            <input type="text" name="group" id="update_group" class="form-control">
                                            <span class="text-danger error" id="update_group_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for = "update_institution_name">Institution Name</label>
                                            <input type="text" name="institution_name" id="update_institution_name" class="form-control">
                                            <span class="text-danger error" id="update_institution_name_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for = "update_result">Result</label>
                                            <input type="text" name="result" id="update_result" class="form-control">
                                            <span class="text-danger error" id="update_result_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for = "update_scale">Scale</label>
                                            <input type="decimal" name="scale" id="update_scale" class="form-control">
                                            <span class="text-danger error" id="update_scale_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for = "update_cgpa">CGPA</label>
                                            <input type="decimal" name="cgpa" id="update_cgpa" class="form-control">
                                            <span class="text-danger error" id="update_cgpa_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for = "update_batch">Batch</label>
                                            <input type="integer" name="batch" id="update_batch" class="form-control">
                                            <span class="text-danger error" id="update_batch_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for = "update_passing_year">Passing Year</label>
                                            <input type="integer" name="passing_year" id="update_passing_year" class="form-control">
                                            <span class="text-danger error" id="update_passing_year_error"></span>
                                        </div>
                                    </div>
                            </div>
                            <div class="center">
                                <button type="submit" id="UpdateEducation" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
