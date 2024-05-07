@section('style')
<style>
    .modal-subject {
        width: 80%;
    }

    #search {
        width: 100%;
        margin: 0;
    }
</style>
@endsection

<div id="addBankDeposit" class="modal-container">
    <div class="modal-subject">
        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Add Bank Deposit</h3>
                        <span class="close-modal" data-modal-id="addBankDeposit">&times;</span>
                    </div>
                </div>

                <!-- form start -->
                <form id="AddDepositForm" method="post">
                    @csrf
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
                        @foreach ($tranwith as $with)
                        <input type="hidden" name="with" id="with" value="{{$with->id}}">
                        @endforeach
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
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="head">Transaction Head</label>
                                <select name="head" id="head">
                                    <option value="">Select Transaction Head</option>
                                    @foreach ($heads as $head)
                                    <option value="{{$head->id}}">{{$head->tran_head_name}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error" id="head_error"></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <input type="text" name="amount" class="form-control" id="amount">
                                <span class="text-danger error" id="amount_error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="center">
                        <button type="submit" id="InsertDeposit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>