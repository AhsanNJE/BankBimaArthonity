@section('style')
    <style>
        #search{
            width: 100%;
            margin: 0;
        }
    </style>
@endsection

<div id="addStore" class="modal-container">
    <div class="modal-subject">
        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Add Store</h3>
                        <span class="close-modal" data-modal-id="addStore">&times;</span>
                    </div>
                </div>

                <form id="AddStoreForm" method="post">
                    @csrf
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="store_name">Store Name</label>
                                        <input type="text" name="store_name" class="form-control" id="store_name">
                                        <span class="text-danger error" id="store_name_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for = "division">Division</label>
                                        <select name="division" id="division">
                                            <option value="">Select Division</option>
                                            <option value="Dhaka">Dhaka</option>
                                            <option value="Mymensingh ">Mymensingh </option>
                                            <option value="Sylhet">Sylhet</option>
                                            <option value="Chattogram">Chattogram</option>
                                            <option value="Barishal ">Barishal </option>
                                            <option value="Khulna">Khulna</option>
                                            <option value="Rajshahi ">Rajshahi </option>
                                            <option value="Rangpur">Rangpur</option>
                                        </select>
                                        <span class="text-danger error" id="division_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for = "location">Location</label>
                                        <input type="text" name="location" id="location" class="form-control">
                                        <div id="location-list">
                                            <ul>

                                            </ul>
                                        </div>
                                        <span class="text-danger error" id="location_error"></span>
                                    </div>
                                </div>
                                
                                <div class="center">
                                    <button type="submit" id="InsertStore" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>