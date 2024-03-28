@section('style')
    <style>
        .modal-subject {
            width: 80%;
        }
        #search{
            width: 100%;
            margin: 0;
        }
    </style>
@endsection

<div id="addTransaction" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading">
            <h3 class="center">Payment Receive From Client</h3>
            <span class="close-modal" data-modal-id="addTransaction">&times;</span>
        </div>

        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Payment Receive From Client</h3>
                    </div>
                </div>

                <!-- form start -->
                <form id="AddPartyForm" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="date">Date</label>
                                        <input type="text" name="date" class="form-control" id="date"
                                            value="{{ date('Y-m-d') }}" disabled>
                                        <span class="text-danger error" id="date_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="tranId">Transaction Id</label>
                                        <input type="text" name="tranId" class="form-control" id="tranId">
                                        <span class="text-danger error" id="tranId_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="location">Location</label>
                                        <input type="text" name="location" class="form-control" id="location"
                                            autocomplete="off">
                                        <div id="location-list">
                                            <ul>

                                            </ul>
                                        </div>
                                        <span class="text-danger error" id="location_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="with">Transaction With</label>
                                        <select name="with" id="with">
                                            <option>Select Transaction With</option>
                                            <option value="newspaper client">Newpaper Client</option>
                                            <option value="advertisement client">Advertisement Client</option>
                                            <option value="magazine client">Magazine Client</option>
                                        </select>
                                        <span class="text-danger error" id="head_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="user">Transaction User</label>
                                        <input type="text" name="user" class="form-control" id="user" autocomplete="off">
                                        <div id="user-list">
                                            <ul>

                                            </ul>
                                        </div>
                                        <span class="text-danger error" id="user_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="discount">Discount</label>
                                        <input type="text" name="discount" class="form-control" id="discount">
                                        <span class="text-danger error" id="discount_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="amount">Amount</label>
                                        <input type="text" name="amount" class="form-control" id="amount">
                                        <span class="text-danger error" id="amount_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="totAmount">Total</label>
                                        <input type="text" name="totAmount" class="form-control" id="totAmount"
                                            readonly>
                                        <span class="text-danger error" id="totAmount_error"></span>
                                    </div>
                                </div>
                                <div class="center">
                                    <button type="submit" id="InsertParty" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                            <div class="row due-grid">
                                <div class="col-md-12">
                                    <div class="transaction_grid">
                                        <table class="show-table">
                                            <thead>
                                                <tr>
                                                    <th>SL:</th>
                                                    <th>Transaction Id</th>
                                                    <th>Bill Amount</th>
                                                    <th>Due</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                            <tfoot>
                                                
                                            </tfoot>
                                        </table>
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
