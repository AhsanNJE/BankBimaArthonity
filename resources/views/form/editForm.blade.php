<div id="editForm" class="modal-container">
    <div class="modal-subject">
        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Edit Form</h3>
                        <span class="close-modal" data-modal-id="editForm">&times;</span>
                    </div>
                </div>

                <form id="EditFormForm" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="id" id="id">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="update_form_name">Form Name</label>
                                        <input type="text" name="form_name" class="form-control" id="update_form_name">
                                        <span class="text-danger error" id="update_form_name_error"></span>
                                    </div>
                                </div>
                        
                                <div class="center">
                                    <button type="submit" id="updateForm" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>