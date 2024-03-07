<div id="editTranWith" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading">
            <h3 class="center">Edit Tran With</h3>
            <span class="close-modal" data-modal-id="editTranWith">&times;</span>
        </div>

        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Edit Tran With</h3>
                    </div>
                </div>
                
                <!-- form start -->
                <form id="EditTranWithForm" method="post">
                    @csrf
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" name="id" id="id">
                                    <div class="form-group">
                                        <label for="updateName">Tran With Name</label>
                                        <input type="text" name="name" class="form-input" id="updateName">
                                        <span class="text-danger error" id="update_name_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-groupe">
                                        <label for="updateType">Type</label>
                                        <select name="type" id="updateType">
                                            {{-- options will be import dynamically --}}
                                        </select>
                                        <span class="text-danger error" id="update_type_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="center">
                                <button type="submit" id="UpdateTranWith" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
