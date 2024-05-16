@section('style')
    <style>
        #search{
            width: 100%;
            margin: 0;
        }
    </style>
@endsection

<div id="addManufacturer" class="modal-container">
    <div class="modal-subject">
        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Add Manufacturer</h3>
                        <span class="close-modal" data-modal-id="addManufacturer">&times;</span>
                    </div>
                </div>

                <form id="AddManufacturerForm" method="post">
                    @csrf
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="manufacturer_name">Manufacturer Name</label>
                                        <input type="text" name="manufacturer_name" class="form-control" id="manufacturer_name">
                                        <span class="text-danger error" id="manufacturer_name_error"></span>
                                    </div>
                                </div>
                                
                                <div class="center">
                                    <button type="submit" id="InsertManufacturer" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>