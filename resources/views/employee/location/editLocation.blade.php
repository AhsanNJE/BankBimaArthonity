<div id="editLocation" class="modal-container">
    <div class="modal-subject">
        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Edit Location</h3>
                        <span class="close-modal" data-modal-id="editLocation">&times;</span>
                    </div>
                </div>
                
                <!-- form start -->
                <form id="EditLocationForm" method="post">
                    @csrf
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" name="id" id="id">
                                    <div class="form-group">
                                        <label for="updateDivision">Division</label>
                                        <input type="text" name="division" class="form-control" id="updateDivision">
                                        <span class="text-danger error" id="update_division_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="updateDistrict">District</label>
                                        <input type="text" name="district" class="form-control" id="updateDistrict">
                                        <span class="text-danger error" id="update_district_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="updateUpazila">Upazila</label>
                                        <input type="text" name="upazila" class="form-control" id="updateUpazila">
                                        <span class="text-danger error" id="update_upazila_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="center">
                                <button type="submit" id="UpdateLocation" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
