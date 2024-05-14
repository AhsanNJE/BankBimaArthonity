<div id="editBankTransaction" class="modal-container">
    <div class="modal-subject">
        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Edit Bank Withdraw</h3>
                        <span class="close-modal" data-modal-id="editBankTransaction">&times;</span>
                    </div>
                </div>
                
                <!-- form start -->
                <form id="EditWithdrawForm" method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="id">
                    @foreach ($tranwith as $with)
                        <input type="hidden" name="with" id="updateWith" value="{{$with->id}}">
                    @endforeach
                    <div class="form-group">
                        <label for="updateDate">Date</label>
                        <input type="text" name="date" class="form-control" id="updateDate" value="{{ date('Y-m-d') }}"
                            disabled>
                        <span class="text-danger error" id="update_date_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="updateUser">Transaction User</label>
                        <input type="text" name="user" class="form-control" id="updateUser" autocomplete="off">
                        <div id="update-user">
                            <ul>

                            </ul>
                        </div>
                        <span class="text-danger error" id="update_user_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="updateLocation">Location</label>
                        <input type="text" name="location" class="form-control" id="updateLocation" autocomplete="off">
                        <div id="update-location">
                            <ul>

                            </ul>
                        </div>
                        <span class="text-danger error" id="update_location_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="updateAmount">Amount</label>
                        <input type="text" name="amount" class="form-control" id="updateAmount">
                        <span class="text-danger error" id="update_amount_error"></span>
                    </div>
                    <div class="center">
                        <button type="submit" id="UpdateWithdraw" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>