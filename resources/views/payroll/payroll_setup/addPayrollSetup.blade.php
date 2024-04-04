<div id="addPayrollSetup" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading">
            <h3 class="center">Add Payroll Setup</h3>
            <span class="close-modal" data-modal-id="addPayrollSetup">&times;</span>
        </div>

        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Add Payroll Setup</h3>
                    </div>
                </div>
                <!-- form start -->
                <form id="AddPayrollForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="center">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="with">Employee Type</label>
                                <select name="with" id="with">
                                    <option value="">Select employee Type</option>
                                    @foreach ($tranwith as $with)
                                        <option value="{{$with->id}}">{{$with->tran_with_name}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error" id="with_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="user">Employee Name</label>
                                <input type="text" name="user" class="form-control" id="user" autocomplete="off">
                                <div id="user-list">
                                    <ul>

                                    </ul>
                                </div>
                                <span class="text-danger error" id="user_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="head">Payroll Category</label>
                                <select name="head" id="head">
                                    <option value="">Select Payroll Category</option>
                                    @foreach ($heads as $head)
                                    <option value="{{$head->id}}">{{$head->tran_head_name}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error" id="head_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <input type="text" name="amount" class="form-control" id="amount">
                                <span class="text-danger error" id="amount_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="date">Select Date</label>
                                <input type="date" name="date" class="form-control" id="date">
                                <span class="text-danger error" id="date_error"></span>
                            </div>
                            <div class="center">
                                <button type="submit" class="btn btn-primary" id="InsertPayroll">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>