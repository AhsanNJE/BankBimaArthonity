@section('style')
<style>
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
                    <input type="hidden" name="tranId" class="form-control" id="tranId">
                    @foreach ($tranwith as $with)
                        <input type="hidden" name="with" id="with" value="{{$with->id}}">
                    @endforeach
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="text" name="date" class="form-control" id="date" value="{{ date('Y-m-d') }}"
                            disabled>
                        <span class="text-danger error" id="date_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="user">Transaction User</label>
                        <input type="text" name="user" class="form-control" id="user" autocomplete="off">
                        <div id="user-list">
                            <ul>

                            </ul>
                        </div>
                        <span class="text-danger error" id="user_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" name="location" class="form-control" id="location" autocomplete="off">
                        <div id="location-list">
                            <ul>

                            </ul>
                        </div>
                        <span class="text-danger error" id="location_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="text" name="amount" class="form-control" id="amount">
                        <span class="text-danger error" id="amount_error"></span>
                    </div>
                    <div class="center">
                        <button type="submit" id="InsertDeposit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>