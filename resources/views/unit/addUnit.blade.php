@section('style')
    <style>
        #search{
            width: 100%;
            margin: 0;
        }
    </style>
@endsection

<div id="addUnit" class="modal-container">
    <div class="modal-subject">
        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Add Unit</h3>
                        <span class="close-modal" data-modal-id="addUnit">&times;</span>
                    </div>
                </div>

                <form id="AddUnitForm" method="post">
                    @csrf
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="unit_name">Unit Type</label>
                                        <input type="text" name="unit_name" class="form-control" id="unit_name">
                                        <span class="text-danger error" id="unit_name_error"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product">Products</label>
                                        <input type="text" name="product" class="form-control" id="product" autocomplete="off">
                                        <div id="product-list">
                                            <ul>

                                            </ul>
                                        </div>
                                        <span class="text-danger error" id="product_error"></span>
                                    </div>
                                </div>
                    
                                <div class="center">
                                    <button type="submit" id="InsertUnit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>