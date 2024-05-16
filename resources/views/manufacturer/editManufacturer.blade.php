<div id="editManufacturer" class="modal-container">
    <div class="modal-subject">
        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Edit Manufacturer</h3>
                        <span class="close-modal" data-modal-id="editManufacturer">&times;</span>
                    </div>
                </div>

                <form id="EditManufacturerForm" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="id" id="id">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="update_manufacturer_name">Manufacturer Name</label>
                                        <input type="text" name="manufacturer_name" class="form-control" id="update_manufacturer_name">
                                        <span class="text-danger error" id="update_manufacturer_name_error"></span>
                                    </div>
                                </div>
                        
                                <div class="center">
                                    <button type="submit" id="updateManufacturer" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>