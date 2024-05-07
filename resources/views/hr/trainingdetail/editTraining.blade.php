
<div id="editTrainingDetail" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading">
            <h3 class="center">Edit Employee Training Detail</h3>
            <span class="close-modal" data-modal-id="editTrainingDetail">&times;</span>
        </div>

        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Edit Employee Training Detail</h3>
                    </div>
                </div>
                
                <!-- form start -->
                <form id="EditTrainingForm" class="training-form" action="{{ route('update.employee.training') }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="id" id="id">
                                <input type="hidden" name="empId" id="empId">
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label for = "update_training_title">Training Title</label>
                                            <input type="text" name="training_title" id="update_training_title" class="form-control">
                                            <span class="text-danger error" id="update_training_title_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for = "update_country">Country</label>
                                            <input type="text" name="country" id="update_country" class="form-control">
                                            <span class="text-danger error" id="update_country_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for = "update_topic">Topic</label>
                                            <input type="text" name="topic" id="update_topic" class="form-control">
                                            <span class="text-danger error" id="update_topic_error"></span>
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
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for = "update_training_year">Training Year</label>
                                            <input type="integer" name="training_year" id="update_training_year" class="form-control">
                                            <span class="text-danger error" id="update_training_year_error"></span>
                                        </div>
                                    </div>
                            </div>
                            <div class="center">
                                <button type="submit" id="UpdateTraining" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
