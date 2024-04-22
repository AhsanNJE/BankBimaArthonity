//Education Detail Input Field Empty Error
$(document).on('submit', '#AddEducationDetailForm', function (e) {
    e.preventDefault();
    let user = $('#user').attr('data-id');
    let formData = new FormData(this);
    formData.append('user', user === undefined ? '' : user);
    
    $.ajax({
        url: "/insert/education/info",
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
                $('#AddEducationDetailForm')[0].reset();
                $('#name').focus();
                $('#user').removeAttr('data-id');
                $('#search').val('');
                $('.employee').load(location.href + ' .employee');
                $('#previewImage').attr('src',`#`).hide();
                toastr.success('Education Detail Added Successfully', 'Added!');
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

    //Show Employee Education Details on details modal
    $(document).on('click', '.EmployeeEducationDetails', function (e) {
        let modal = $(this).attr('data-modal-id');
        let id = $(this).attr('data-id');
        $.ajax({
            url: "/new/employee/education",
            method: 'GET',
            data: {id:id},
            success: function (res) {
                $("#"+ modal).show();
                $('.employeeeducationdetails').html(res.data)
            },
            error: function (err) {
                console.log(err)
            }
        });
    });
    
    var formIndex = 2; // Initialize form index

    $('#addEducation').click(function() {
        var form = createForm(formIndex); // Create a new form
        $('#formContainer').append(form); // Append the form to the container
        formIndex++; // Increment form index
    });

    $('#InsertEducation').click(function() {
        // Serialize and submit all forms
        $('.education-form').each(function() {
            let user = $('#user').attr('data-id');
            var formData = $(this).serialize();
            formData += '&user=' + encodeURIComponent(user === undefined ? '' : user);
            // Submit the form data via AJAX
            $.ajax({
                url: '/insert/education/info', // Change this to your endpoint
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
            class: 'education-form'
        });

        // Add form fields
        form.append(`
        <div class="row">  
        <div class="col-md-6">
            <div class="form-group">
                <label for = "level_of_education">Level of Education</label>
                <input type="text" name="level_of_education" id="level_of_education" class="form-control">
                <span class="text-danger error" id="level_of_education_error"></span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for = "degree_title">Degree Title</label>
                <input type="text" name="degree_title" id="degree_title" class="form-control">
                <span class="text-danger error" id="degree_title_error"></span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for = "group">Group</label>
                <input type="text" name="group" id="group" class="form-control">
                <span class="text-danger error" id="group_error"></span>
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
                <label for = "result">Result</label>
                <input type="text" name="result" id="result" class="form-control">
                <span class="text-danger error" id="result_error"></span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for = "scale">Scale</label>
                <input type="decimal" name="scale" id="scale" class="form-control">
                <span class="text-danger error" id="scale_error"></span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for = "cgpa">CGPA</label>
                <input type="decimal" name="cgpa" id="cgpa" class="form-control">
                <span class="text-danger error" id="cgpa_error"></span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for = "batch">Batch</label>
                <input type="integer" name="batch" id="batch" class="form-control">
                <span class="text-danger error" id="batch_error"></span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for = "passing_year">Passing Year</label>
                <input type="integer" name="passing_year" id="passing_year" class="form-control">
                <span class="text-danger error" id="passing_year_error"></span>
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

document.getElementById('addEducation').addEventListener('click', function() {
    var container = document.getElementById('dynamicContainer');
    var newFields = document.createElement('div');
    newFields.innerHTML = `@include('education_fields')`;
    container.appendChild(newFields);
});