@section('style')
    <style>
        #search{
            width: 100%;
            margin: 0;
        }
    </style>
@endsection

<div id="addForm" class="modal-container">
    <div class="modal-subject">
        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Add Form</h3>
                        <span class="close-modal" data-modal-id="addForm">&times;</span>
                    </div>
                </div>

                <form id="AddFormForm" method="post">
                    @csrf
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="form_name">Form Type</label>
                                        <input type="text" name="form_name" class="form-control" id="form_name">
                                        <span class="text-danger error" id="form_name_error"></span>
                                    </div>
                                </div>
                                
                                <div class="center">
                                    <button type="submit" id="InsertForm" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>