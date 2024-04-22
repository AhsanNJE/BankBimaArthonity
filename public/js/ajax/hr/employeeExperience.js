//Experience Detail Input Field Empty Error
$(document).on('submit', '#AddExperienceDetailForm', function (e) {
    e.preventDefault();
    let user = $('#user').attr('data-id');
    let locations = $('#location').attr('data-id');
    let department = $('#department').attr('data-id');
    let designation = $('#designation').attr('data-id');
    let formData = new FormData(this);
    formData.append('user', user === undefined ? '' : user);
    formData.append('location', locations === undefined ? '' : locations);
    formData.append('department', department === undefined ? '' : department);
    formData.append('designation', designation === undefined ? '' : designation);
    
    $.ajax({
        url: "/insert/experience/info",
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
                $('#AddExperienceDetailForm')[0].reset();
                $('#name').focus();
                $('#user').removeAttr('data-id');
                $('#location').removeAttr('data-id');
                $('#department').removeAttr('data-id');
                $('#designation').removeAttr('data-id');
                $('#search').val('');
                $('.employee').load(location.href + ' .employee');
                $('#previewImage').attr('src',`#`).hide();
                toastr.success('Experience Detail Added Successfully', 'Added!');
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
    //Show Employee Experience Details on details modal
    $(document).on('click', '.EmployeeExperienceDetails', function (e) {
        let modal = $(this).attr('data-modal-id');
        let id = $(this).attr('data-id');
        $.ajax({
            url: "/new/employee/experience",
            method: 'GET',
            data: {id:id},
            success: function (res) {
                $("#"+ modal).show();
                $('.employeeexperiencedetails').html(res.data)
            },
            error: function (err) {
                console.log(err)
            }
        });
    });

    var formIndex = 2; // Initialize form index

    $('#addExperience').click(function() {
        var form = createForm(formIndex); // Create a new form
        $('#formContainer').append(form); // Append the form to the container
        formIndex++; // Increment form index
    });

    $('#InsertExperience').click(function() {
        // Serialize and submit all forms
        $('.experience-form').each(function() {
            let user = $('#user').attr('data-id');
            let locations = $('#location').attr('data-id');
            let department = $('#department').attr('data-id');
            let designation = $('#designation').attr('data-id');
            var formData = $(this).serialize();
            formData += '&user=' + encodeURIComponent(user === undefined ? '' : user);
            formData.append('location', locations === undefined ? '' : locations);
            formData.append('department', department === undefined ? '' : department);
            formData.append('designation', designation === undefined ? '' : designation);
            // Submit the form data via AJAX
            $.ajax({
                url: '/insert/experience/info', // Change this to your endpoint
                method: 'POST',
                data: formData,
                success: function(response) {
                    console.log(response);
                    $('#user').removeAttr('data-id');
                    $('#location').removeAttr('data-id');
                    $('#department').removeAttr('data-id');
                    $('#designation').removeAttr('data-id');
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
            class: 'experience-form'
        });

        // Add form fields
        form.append(`
        <div class="row">  
            <div class="col-md-6">
                <div class="form-group">
                    <label for = "company_name">Company Name</label>
                    <input type="text" name="company_name" id="company_name" class="form-control">
                    <span class="text-danger error" id="company_name_error"></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for = "department">Department</label>
                    <input type="text" name="department" id="department" class="form-control">
                    <div id="department-list">
                        <ul>

                        </ul>
                    </div>
                    <span class="text-danger error" id="department_error"></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for = "designation">Designation</label>
                    <input type="text" name="designation" id="designation" class="form-control">
                    <div id="designation-list">
                        <ul>

                        </ul>
                    </div>
                    <span class="text-danger error" id="designation_error"></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for = "location">Company Location</label>
                    <input type="text" name="location" id="location"  class="form-control">
                    <div id="location-list">
                        <ul>

                        </ul>
                    </div>
                    <span class="text-danger error" id="location_error"></span>
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
