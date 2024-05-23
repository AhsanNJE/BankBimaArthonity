<div id="addPhamacyProduct" class="modal-container">
    <div class="modal-subject">
        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Add Pharmacy Product</h3>
                        <span class="close-modal" data-modal-id="addPhamacyProduct">&times;</span>
                    </div>
                </div>
                
                <!-- form start -->
                <form id="addPhamacyProductForm" method="post">
                    @csrf
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="headName">Transaction Head</label>
                                        <input type="text" name="headName" class="form-control" id="headName">
                                        <span class="text-danger error" id="headName_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="groupe">Transaction Groupe</label>
                                        <select name="groupe" id="groupe">
                                            <option value="">Select Transaction Groupe</option>
                                            @foreach ($groupes as $groupe)
                                                <option value="{{ $groupe->id }}">{{ $groupe->tran_groupe_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger error" id="groupe_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="category">Category Name</label>
                                        <select name="category" id="category">
                                            <option value="">Select Category Name</option>
                                            @foreach ($categorys as $category)
                                                <option value="{{ $category->id }}">{{ $category->category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger error" id="groupe_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="manufacture">Manufacture Name</label>
                                        <select name="manufacture" id="manufacture">
                                            <option value="">Select Manufacture Name</option>
                                            @foreach ($manufactures as $manufacture)
                                                <option value="{{ $manufacture->id }}">{{ $manufacture->manufacturer_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger error" id="groupe_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="itemform">Item Form Name</label>
                                        <select name="itemform" id="itemform">
                                            <option value="">Select Item Form Name</option>
                                            @foreach ($itemforms as $itemform)
                                                <option value="{{ $itemform->id }}">{{ $itemform->form_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger error" id="groupe_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="unite">Unite Name</label>
                                        <select name="unite" id="unite">
                                            <option value="">Select Unite Name</option>
                                            @foreach ($unites as $unite)
                                                <option value="{{ $unite->id }}">{{ $unite->unite_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger error" id="groupe_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="center">
                                <button type="submit" id="InsertPharmacyProduct" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
