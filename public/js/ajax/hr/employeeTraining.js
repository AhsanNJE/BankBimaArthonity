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

    ///////////// ------------------ Edit Employee Ajax Part Start ---------------- /////////////////////////////
    $(document).on('click', '.editEmployee', function () {
        let modalId = $(this).data('modal-id');
        let id = $(this).data('id');
        $.ajax({
            url: `/admin/employees/edit/employees`,
            method: 'GET',
            data: { id:id },
            success: function (res) {
                $('#id').val(id);
                $('#empId').val(res.employee.user_id);
                $('#updateName').val(res.employee.user_name);
                $('#updateName').focus();
                $('#updateEmail').val(res.employee.user_email);
                $('#updatePhone').val(res.employee.user_phone);

                // Create options dynamically
                $('#updateGender').empty();
                $('#updateGender').append(`<option value="male" ${res.employee.gender === 'male' ? 'selected' : ''}>Male</option>
                                         <option value="female" ${res.employee.gender === 'female' ? 'selected' : ''}>Female</option>
                                         <option value="others" ${res.employee.gender === 'others' ? 'selected' : ''}>Others</option>`);

                $('#updateLocation').val(res.employee.location.upazila);
                $('#updateLocation').attr('data-id',res.employee.loc_id);

                // Create options dynamically
                $('#updateType').empty();
                $.each(res.tranwith, function (key, withs) {
                    $('#updateType').append(`<option value="${withs.id}" ${res.employee.tran_user_type === withs.id ? 'selected' : ''}>${withs.tran_with_name}</option>`);
                });

                $('#updateDepartment').val(res.employee.department.dept_name);
                $('#updateDepartment').attr('data-id',res.employee.dept_id);
                $('#updateDesignation').val(res.employee.designation.designation);
                $('#updateDesignation').attr('data-id',res.employee.designation_id);
                $('#updateDob').val(res.employee.dob);
                $('#updateNid').val(res.employee.nid);
                $('#updateAddress').val(res.employee.address);
                $('#updatePreviewImage').attr('src',`/storage/profiles/${res.employee.image}?${new Date().getTime()} `).show();

                var modal = document.getElementById(modalId);
                modal.style.display = 'block';
            },
            error: function (err) {
                console.log(err);
            }
        });
    });



    /////////////// ------------------ Update Employees Ajax Part Start ---------------- /////////////////////////////
    $(document).on('submit', '#EditEmployeeForm', function (e) {
        e.preventDefault();
        let locations = $('#updateLocation').attr('data-id');
        let department = $('#updateDepartment').attr('data-id');
        let designation = $('#updateDesignation').attr('data-id');
        let formData = new FormData(this);
        formData.append('location',locations);
        formData.append('department',department);
        formData.append('designation',designation);
        $.ajax({
            url: `/admin/employees/update/employees`,
            method: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            beforeSend:function() {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#editEmployee').hide();
                    $('#EditEmployeeForm')[0].reset();
                    $('#search').val('');
                    $('.employee').load(location.href + ' .employee');
                    toastr.success('Employee Updated Successfully', 'Updated!');
                }
            },
            error: function (err) {
                let error = err.responseJSON;
                $.each(error.errors, function (key, value) {
                    $('#update_' + key + "_error").text(value);
                })
            }
        });
    });


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