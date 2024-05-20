<div id="editStore" class="modal-container">
    <div class="modal-subject">
        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Edit Store</h3>
                        <span class="close-modal" data-modal-id="editStore">&times;</span>
                    </div>
                </div>

                <form id="EditStoreForm" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="id" id="id">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="update_store_name">Store Name</label>
                                        <input type="text" name="store_name" class="form-control" id="update_store_name">
                                        <span class="text-danger error" id="update_store_name_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for = "update_division">Gender</label>
                                        <select name="division" id="update_division">
                                            
                                        </select>
                                        <span class="text-danger error" id="update_division_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for = "updateLocation">Location</label>
                                        <input type="text" name="location" id="updateLocation" class="form-control">
                                        <div id="update-location">
                                            <ul>

                                            </ul>
                                        </div>
                                        <span class="text-danger error" id="update_location_error"></span>
                                    </div>
                                </div>
                        
                                <div class="center">
                                    <button type="submit" id="updateStore" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>