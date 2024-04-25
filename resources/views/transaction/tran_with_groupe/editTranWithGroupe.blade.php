<div id="editTranWithGroupe" class="modal-container">
    <div class="modal-subject">
        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Edit Tranwith Groupe</h3>
                        <span class="close-modal" data-modal-id="editTranWithGroupe">&times;</span>
                    </div>
                </div>

                <!-- form start -->
                <form id="EditTranWithGroupeForm" method="post">
                    @csrf
                    @method('PUT')
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="id" id="id">
                                <div class="form-group">
                                    <label for="updateWith">Tran With</label>
                                    <select name="with" id="updateWith">
                                        <option value="">Select Tranwith</option>

                                    </select>
                                    <span class="text-danger error" id="update_with_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="updateGroupe">Transaction Groupe</label>
                                    <select name="groupe" id="updateGroupe">
                                        <option value="">Select Transaction Groupe</option>

                                    </select>
                                    <span class="text-danger error" id="update_groupe_error"></span>
                                </div>
                            </div>
                            <div class="center">
                                <button type="submit" id="UpdateTranWithGroupe" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>