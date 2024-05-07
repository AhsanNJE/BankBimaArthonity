<div id="showPayrollDetails" class="modal-container">
    <div class="modal-subject">
        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Payroll Details</h3>
                        <span class="close-modal" data-modal-id="showPayrollDetails">&times;</span>
                    </div>
                </div>
                <table class="show-table payroll-grid">
                    <thead>
                        <tr>
                            <th>Sl:</th>
                            <th>Payroll Category</th>
                            <th>Amount</th>
                            <th>Month</th>
                            <th>Year</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
                <!-- form start -->
                <form id="EditPayrollForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="center">
                        <div class="card-body">
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label for="employee">Employee Name</label>
                                <input type="text" name="user" class="form-control" id="employee" readonly>
                            </div>
                            <div class="form-group">
                                <label for="head">Payroll Category</label>
                                <select name="head" id="head">
                                    <option value="">Select Payroll Category</option>
                                </select>
                                <span class="text-danger error" id="head_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <input type="text" name="amount" class="form-control" id="amount">
                                <span class="text-danger error" id="amount_error"></span>
                            </div>
                            <div class="center">
                                <button type="submit" class="btn btn-primary" id="EditPayroll">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>