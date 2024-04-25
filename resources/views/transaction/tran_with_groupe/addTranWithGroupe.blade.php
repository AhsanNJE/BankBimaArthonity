<div id="addTranWithGroupe" class="modal-container">
    <div class="modal-subject">
        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Add Tranwith Groupes</h3>
                        <span class="close-modal" data-modal-id="addTranWithGroupe">&times;</span>
                    </div>
                </div>

                <!-- form start -->
                <form id="AddTranWithGroupeForm" method="post">
                    @csrf
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group">
                                    <label for="with">Tran With</label>
                                    <select name="with" id="with">
                                        <option value="">Select Tranwith</option>
                                        @foreach ($tranwith as $with)
                                            <option value="{{$with->id}}">{{$with->tran_with_name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error" id="with_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="groupe">Transaction Groupe</label>
                                    <select name="groupe" id="groupe">
                                        <option value="">Select Transaction Groupe</option>
                                        @foreach ($groupes as $groupe)
                                            <option value="{{ $groupe->id }}">{{ $groupe->tran_groupe_name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error" id="groupe_error"></span>
                                </div>
                            </div>
                            <div class="center">
                                <button type="submit" id="InsertTranWithGroupe" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>