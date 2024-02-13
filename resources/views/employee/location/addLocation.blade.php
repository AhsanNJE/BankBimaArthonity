<div id="addLocation" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading">
            <h3 class="center">Add Location</h3>
            <span class="close-modal" data-modal-id="addLocation">&times;</span>
        </div>

        <div class="center">
            <div class="card card-primary col-md-10">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Add Location</h3>
                    </div>
                </div>
                
                <!-- form start -->
                <form id="AddLocationForm" method="post">
                    @csrf
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="division">Division</label>
                                        <input type="text" name="division" class="form-control" id="division">
                                        <span class="text-danger error" id="division_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="district">District</label>
                                        <input type="text" name="district" class="form-control" id="district">
                                        <span class="text-danger error" id="district_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="thana">Thana</label>
                                        <input type="text" name="thana" class="form-control" id="thana">
                                        <span class="text-danger error" id="thana_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="center">
                                <button type="submit" id="InsertLocation" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
