<div id="addClientModal" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading">
            <h3 class="center">Add Client</h3>
            <span class="close-modal" data-modal-id="addClientModal">&times;</span>
        </div>

        <div class="center">
            <div class="card card-primary col-md-10">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Add Client</h3>
                    </div>
                </div>
                <!-- form start -->
                <form id="AddClientForm" method="POST">
                    @csrf
                    @method('POST')
                    <div class="center">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="clientName">Client Name</label>
                                <input type="text" name="clientName" class="form-control" id="clientName">
                                <span class="text-danger error" id="clientName_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="contact">Contact</label>
                                <input type="text" name="contact" class="form-control" id="contact">
                                <span class="text-danger error" id="contact_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" class="form-control" id="email">
                                <span class="text-danger error" id="email_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" name="address" class="form-control" id="address">
                                <span class="text-danger error" id="address_error"></span>
                            </div>
                            <div class="center">
                                <button type="submit" class="btn btn-primary" id="addClient">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
