@section('style')
<style>
    #search {
        width: 100%;
        margin: 0;
    }
</style>
@endsection

<div id="addNegativeAdjustment" class="modal-container">
    <div class="modal-subject">
        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Add Negative Adjustment</h3>
                        <span class="close-modal" data-modal-id="addNegativeAdjustment">&times;</span>
                    </div>
                </div>

                <!-- form start -->
                <form id="AddNegativeAdjustmentForm" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="within" style="display: none"> </div>
                                    <div id="groupein" style="display: none">
                                        @foreach ($groupes as $groupe)
                                        <input type="checkbox" id="groupe[]" class="groupe-checkbox" name="groupe"
                                            value="{{$groupe->id}}" checked>
                                        @endforeach
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="date">Date</label>
                                                <input type="text" name="date" class="form-control" id="date"
                                                    value="{{ date('Y-m-d') }}" disabled>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="store">Store</label>
                                                <input type="text" name="store" class="form-control" id="store"
                                                    autocomplete="off">
                                                <div id="store-list">
                                                    <ul>

                                                    </ul>
                                                </div>
                                                <span class="text-danger error" id="store_error"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="head">Product</label>
                                                <input type="text" name="head" id="head" class="form-control">
                                                <div id="head-list">
                                                    <ul>

                                                    </ul>
                                                </div>
                                                <span class="text-danger error" id="head_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="quantity">Quantity</label>
                                                <input type="text" name="quantity" class="form-control" id="quantity" value="1">
                                                <span class="text-danger error" id="quantity_error"></span>
                                            </div>
                                        </div>
                                        <div class="center">
                                            <button type="submit" id="InsertTransaction" class="btn btn-success">Add</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>    
                </form>
            </div>
        </div>
    </div>
</div>