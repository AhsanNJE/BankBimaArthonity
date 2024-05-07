@section('style')
    <style>
        .modal-subject {
            width: 75%;
        }
        label {
            font-size: 16px !important;
            font-weight: normal !important;
        }
        .container {
        background-color: #E8E8E8!important; 
        }
    </style>
@endsection

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div id= "EmployeeTraining" class="modal-container">
    <div class="modal-subject">
        <div class="modal-heading">
            <h3 class="center">Add Training Detail</h3>
            <span class="close-modal" data-modal-id="EmployeeTraining">&times;</span>
        </div>

        <div class="center">
            <div class="card card-primary col-md-12">
                <div class="card-header">
                    <div class="center">
                        <h3 class="card-title">Add Training Detail</h3>
                    </div>
                </div>
                <div id="formContainer">
                    <div class="row">
                        <div class="col-md-6">  
                            <div class="form-group">   
                                <label for="with">Employee Type</label>
                                <select name="with" id="with">
                                    <option value="">Select Employee Type</option>
                                    @foreach ($tranwith as $with)
                                        <option value="{{$with->id}}">{{$with->tran_with_name}}</option>                                                
                                    @endforeach
                                </select>
                                <span class="text-danger error" id="with_error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user">Name</label>
                                <input type="text" name="user" class="form-control" id="user" autocomplete="off">
                                <div id="user-list">
                                    <ul>

                                    </ul>
                                </div>
                                <span class="text-danger error" id="user_error"></span>
                            </div>
                        </div>
                    </div>
                    <!-- form start -->
                    <form id='form2' class='training-form' action="{{ route('inserttraining.info')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Training Details Section -->
                        <div class="center">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for = "training_title">Training Title</label>
                                            <input type="text" name="training_title" id="training_title" class="form-control">
                                            <span class="text-danger error" id="training_title_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for = "country">Country</label>
                                            <input type="text" name="country" id="country" class="form-control">
                                            <span class="text-danger error" id="country_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for = "topic">Topic</label>
                                            <input type="text" name="topic" id="topic" class="form-control">
                                            <span class="text-danger error" id="topic_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for = "institution_name">Institution Name</label>
                                            <input type="text" name="institution_name" id="institution_name" class="form-control">
                                            <span class="text-danger error" id="institution_name_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="start_date">Start Date</label>
                                            <input type="date" name="start_date" id="start_date" class="form-control">
                                            <span class="text-danger error" id="start_date_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="end_date">End Date</label>
                                            <input type="date" name="end_date" id="end_date" class="form-control">
                                            <span class="text-danger error" id="end_date_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for = "training_year">Training Year</label>
                                            <input type="integer" name="training_year" id="training_year" class="form-control">
                                            <span class="text-danger error" id="training_year_error"></span>
                                        </div>
                                    </div>
                                <!-- Forms will be dynamically added here -->
                            </div>
                        </div>
                    </div>
                </form>
                </div>
                <div>
                    <button type = "button" name = "addTraining" id = "addTraining" class="btn btn-primary">Add+</button>
                </div>
                <div class="center">
                    <button type="submit" id="InsertTraining" class="btn btn-primary">Save</button>
                </div>
            </div>         
        </div>
    </div>
</div>
</body>
</html>
