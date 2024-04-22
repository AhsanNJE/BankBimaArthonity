//Training Detail Input Field Empty Error
$(document).on('submit', '#AddTrainingDetailForm', function (e) {
    e.preventDefault();
    let user = $('#user').attr('data-id');
    let formData = new FormData(this);
    formData.append('user', user === undefined ? '' : user);
    $.ajax({
        url: "/insert/training/info",
        method: 'POST',
        processData: false,
        contentType: false,
        cache: false,
        data: formData,
        beforeSend:function() {
            $(document).find('span.error').text('');  
        },
        success: function (res) {
            console.log(res)
            if (res.status == "success") {
                $('#AddTrainingDetailForm')[0].reset();
                $('#name').focus();
                $('#user').removeAttr('data-id');
                $('#search').val('');
                $('.employee').load(location.href + ' .employee');
                $('#previewImage').attr('src',`#`).hide();
                toastr.success('Training Detail Added Successfully', 'Added!');
            }
        },
        error: function (err) {
            console.log(err)
            let error = err.responseJSON;
            $.each(error.errors, function (key, value) {
                $('#' + key + "_error").text(value);
            });
        }
    });
});

$(document).ready(function () {

    //Show Employee Training Details on details modal
    $(document).on('click', '.EmployeeTrainingDetails', function (e) {
        let modal = $(this).attr('data-modal-id');
        let id = $(this).attr('data-id');
        $.ajax({
            url: "/new/employee/training",
            method: 'GET',
            data: {id:id},
            success: function (res) {
                $("#"+ modal).show();
                $('.employeetrainingdetails').html(res.data)
            },
            error: function (err) {
                console.log(err)
            }
        });
    });

    var formIndex = 2; // Initialize form index

    $('#addTraining').click(function() {
        var form = createForm(formIndex); // Create a new form
        $('#formContainer').append(form); // Append the form to the container
        formIndex++; // Increment form index
    });

    $('#InsertTraining').click(function() {
        // Serialize and submit all forms
        $('.training-form').each(function() {
            let user = $('#user').attr('data-id');
            var formData = $(this).serialize();
            formData += '&user=' + encodeURIComponent(user === undefined ? '' : user);
            // Submit the form data via AJAX
            $.ajax({
                url: '/insert/training/info', // Change this to your endpoint
                method: 'POST',
                data: formData,
                success: function(response) {
                    console.log(response);
                    $('#user').removeAttr('data-id');
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });

    // Function to create a new form
    function createForm(index) {
        var form = $('<form>', {
            id: 'form' + index,
            class: 'training-form'
        });

        // Add form fields
        form.append(`
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
        </div>`);
        return form;
    }

    /////////////// ------------------ Delete Employee ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#delete', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        if (confirm('Are You Sure to Delete This Employee ??')) {
            $.ajax({
                url: `/employees/delete`,
                method: 'DELETE',
                data: { id:id },
                success: function (res) {
                    if (res.status == "success") {
                        $('.employee').load(location.href + ' .employee');
                        $('#search').val('');
                        toastr.success('Employee Deleted Successfully', 'Deleted!');
                    }
                }
            });
        }
    });
});