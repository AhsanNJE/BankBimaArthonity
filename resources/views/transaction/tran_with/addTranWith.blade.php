@section('style')
    <style>
        #search{
            width: 100%;
            margin: 0;
        }
    </style>
@endsection

<div id="addTranWith" class="modal-container">
    <div class="modal-subject">
        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Add Tran With</h3>
                        <span class="close-modal" data-modal-id="addTranWith">&times;</span>
                    </div>
                </div>
                
                <!-- form start -->
                <form id="AddTranWithForm" method="post">
                    @csrf
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Tran With Name</label>
                                        <input type="text" name="name" class="form-control" id="name">
                                        <span class="text-danger error" id="name_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="type">User Type</label>
                                        <select name="type" id="type">
                                            <option value="">Select User Type</option>
                                            <option value="Client">Client</option>
                                            <option value="Supplier">Supplier</option>
                                            <option value="Employee">Employee</option>
                                            <option value="Bank">Bank</option>
                                            <option value="Others">Others</option>
                                        </select>
                                        <span class="text-danger error" id="type_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="tranType">Transaction Type</label>
                                        <select name="tranType" id="tranType">
                                            <option value="">Select Transaction Type</option>
                                            @foreach ($types as $type)
                                                <option value="{{ $type->id }}">{{ $type->type_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger error" id="tranType_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="tranMethod">Transaction Method</label>
                                        <select name="tranMethod" id="tranMethod">
                                            <option value="">Select Transaction Method</option>
                                            <option value="Receive">Receive</option>
                                            <option value="Payment">Payment</option>
                                            <option value="Both">Both</option>
                                        </select>
                                        <span class="text-danger error" id="tranMethod_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="center">
                                <button type="submit" id="InsertTranWith" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
