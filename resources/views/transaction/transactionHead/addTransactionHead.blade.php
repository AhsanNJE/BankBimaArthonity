<div id="addTransactionHead" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading">
            <h3 class="center">Add Transaction Heads</h3>
            <span class="close-modal" data-modal-id="addTransactionHead">&times;</span>
        </div>

        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Add Transaction Head</h3>
                    </div>
                </div>
                
                <!-- form start -->
                <form id="AddTransactionHeadForm" method="post">
                    @csrf
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="headName">Transaction Head</label>
                                        <input type="text" name="headName" class="form-control" id="headName">
                                        <span class="text-danger error" id="headName_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="groupe">Transaction Groupe</label>
                                        <select name="groupe" id="groupe">
                                            <option value="">Select Transaction Groupe</option>
                                            @foreach ($groupes as $groupe)
                                                <option value="{{ $groupe->id }}">{{ $groupe->tran_groupe_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger error" id="groupe_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="center">
                                <button type="submit" id="InsertTransactionHead" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
