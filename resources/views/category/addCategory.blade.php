@section('style')
    <style>
        #search{
            width: 100%;
            margin: 0;
        }
    </style>
@endsection

<div id="addCategory" class="modal-container">
    <div class="modal-subject">
        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Add Category</h3>
                        <span class="close-modal" data-modal-id="addCategory">&times;</span>
                    </div>
                </div>

                <form id="AddCategoryForm" method="post">
                    @csrf
                    <div class="center">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="category_name">Category Name</label>
                                        <input type="text" name="category_name" class="form-control" id="category_name">
                                        <span class="text-danger error" id="category_name_error"></span>
                                    </div>
                                </div>
                                
                                <div class="center">
                                    <button type="submit" id="InsertCategory" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>