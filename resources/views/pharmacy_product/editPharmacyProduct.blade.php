<div id="editPharmacyProduct" class="modal-container">
    <div class="modal-subject">
        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Edit Pharmacy Product</h3>
                        <span class="close-modal" data-modal-id="editPharmacyProduct">&times;</span>
                    </div>
                </div>
                
                <!-- form start -->
                <form id="EditPharmacyProductForm" method="post">
                    @csrf
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" name="id" id="id">
                                    <div class="form-group">
                                        <label for="updateHeadName">Transaction Head</label>
                                        <input type="text" name="headName" class="form-control" id="updateHeadName">
                                        <span class="text-danger error" id="update_headName_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="updateGroupe">Transaction Groupe</label>
                                        <select name="groupe" id="updateGroupe">
                                            {{-- options will be display dynamically --}}
                                        </select>
                                        <span class="text-danger error" id="update_groupe_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="updatecategory">Category Name</label>
                                        <select name="category" id="updatecategory">
                                            {{-- options will be display dynamically --}}
                                        </select>
                                        <span class="text-danger error" id="update_groupe_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="updatemanufacture">Manufacture Name</label>
                                        <select name="manufacture" id="updatemanufacture">
                                            {{-- options will be display dynamically --}}
                                        </select>
                                        <span class="text-danger error" id="update_groupe_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="updateitemform">Item Form Name</label>
                                        <select name="itemform" id="updateitemform">
                                            {{-- options will be display dynamically --}}
                                        </select>
                                        <span class="text-danger error" id="update_groupe_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="updateunite">Unite Name</label>
                                        <select name="unite" id="updateunite">
                                            {{-- options will be display dynamically --}}
                                        </select>
                                        <span class="text-danger error" id="update_groupe_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="center">
                                <button type="submit" id="UpdatePharmacyProduct" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
