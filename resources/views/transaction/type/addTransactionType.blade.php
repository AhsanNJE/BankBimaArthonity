<div id="addTransactionType" class="modal-container">
    <div class="modal-subject">
        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Add Transaction Types</h3>
                        <span class="close-modal" data-modal-id="addTransactionType">&times;</span>
                    </div>
                </div>
                
                <!-- form start -->
                <form id="AddTransactionTypeForm" method="post">
                    @csrf
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="typeName">Transaction Type Name</label>
                                        <input type="text" name="typeName" class="form-control" id="typeName">
                                        <span class="text-danger error" id="typeName_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="center">
                                <button type="submit" id="InsertTransactionType" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
