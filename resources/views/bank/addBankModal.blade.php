@section('style')
<style>
    .modal-subject {
        width: 40%;
    }

    .details .caption {
        background: #0b5baa;
    }
</style>
@endsection

<div id="addBankModal" class="modal-container">
    <div class="modal-subject">
        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Add Bank</h3>
                        <span class="close-modal" data-modal-id="addBankModal">&times;</span>
                    </div>
                </div>
                <!-- form start -->
                <form id="AddBankForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                @foreach ($tranwith as $with)
                                    <input type="hidden" name="type" id="type" value="{{$with->id}}">
                                @endforeach
                                <div class="form-group">
                                    <label for="name">Bank Name</label>
                                    <input type="text" name="name" class="form-control" id="name">
                                    <span class="text-danger error" id="name_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" class="form-control" id="email">
                                    <span class="text-danger error" id="email_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" name="phone" class="form-control" id="phone">
                                    <span class="text-danger error" id="phone_error"></span>
                                </div>
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
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" name="address" class="form-control" id="address">
                                    <span class="text-danger error" id="address_error"></span>
                                </div>
                            </div>
                            <div class="center">
                                <button type="submit" class="btn btn-primary" id="InsertBank">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>