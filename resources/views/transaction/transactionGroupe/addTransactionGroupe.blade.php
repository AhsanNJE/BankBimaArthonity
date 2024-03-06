<div id="addTransactionGroupe" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading">
            <h3 class="center">Add Transaction Groupes</h3>
            <span class="close-modal" data-modal-id="addTransactionGroupe">&times;</span>
        </div>

        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Add Transaction Groupes</h3>
                    </div>
                </div>
                
                <!-- form start -->
                <form id="AddTransactionGroupeForm" method="post">
                    @csrf
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="groupeName">Transaction Groupe Name</label>
                                        <input type="text" name="groupeName" class="form-control" id="groupeName">
                                        <span class="text-danger error" id="groupeName_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-groupe">
                                        <label for="type">Groupe Type</label>
                                        <select name="type" id="type">
                                            <option value="" >Select Transaction With</option>
                                            <option value="Receive">Receive</option>
                                            <option value="Payment">Payment</option>
                                            <option value="Invoice">Invoice</option>
                                            <option value="Both">Both</option>
                                        </select>
                                        <span class="text-danger error" id="type_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="center">
                                <button type="submit" id="InsertTransactionGroupe" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
