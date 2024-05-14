$(document).ready(function () {

    var formIndex = 2; // Initialize form index

    $('#addTraining').click(function() {
        var form = createForm(formIndex); // Create a new form
        $('#formContainer').append(form); // Append the form to the container
        formIndex++; // Increment form index
    });
    
    //Training Form Field Empty and Insert Data in Add Form 
    $('#InsertTraining').on('click', function() {
        // Check if forms have already been submitted
        if ($(this).data('submitted')) {
            // Forms already submitted, do nothing
            return;
        }
    
        // Mark the button as submitted
        $(this).data('submitted', true);
    
        // Start submitting forms sequentially
        submitForm($('.training-form').first());
    });
    

    var isFirstFormInserted = false;

    // Function to submit forms sequentially
    function submitForm(form) {
        if (!form.length) {
            // No more forms to submit
            if (isFirstFormInserted) {
                // Remove all forms except the first one
                removeAllFormsExceptFirst();
            }
            return;
        }

        let user = $('#user').attr('data-id');
        let formData = new FormData(form[0]);
        formData.append('user', user === undefined ? '' : user);

        $.ajax({
            url: "/insert/training/info",
            method: 'POST',
            processData: false,
            contentType: false,
            cache: false,
            data: formData,
            beforeSend: function() {
                form.find('span.error').text(''); // Clear errors
            },
            success: function(res) {
                console.log(res);
                if (res.status === "success") {
                    form[0].reset(); // Reset the current form
                    form.find('#name').focus(); // Set focus

                    // Clear errors and fields within the current form
                    form.find('.text-danger').text('');
                    form.find('#user').removeAttr('data-id');
                    form.find('#search').val('');

                    toastr.success('Training Detail Added Successfully', 'Added!');
                    if (!isFirstFormInserted) {
                        isFirstFormInserted = true;
                    }
                }

                // Submit the next form recursively only if the first form was inserted successfully
                if (isFirstFormInserted) {
                    submitForm(form.next('.training-form'));
                }
            },
            error: function(err) {
                console.log(err);
                let error = err.responseJSON;
                $.each(error.errors, function(key, value) {
                    form.find('#' + key + "_error").text(value); // Set error messages
                });
            }
        });
    }

    // Function to remove all forms except the first one
    function removeAllFormsExceptFirst() {
        $('.training-form').not(':first').remove();
    }

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
                    <label for = "training_title">Training Title<span class="red">*</span></label>
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
                    <label for = "topic">Topic<span class="red">*</span></label>
                    <input type="text" name="topic" id="topic" class="form-control">
                    <span class="text-danger error" id="topic_error"></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for = "institution_name">Institution Name<span class="red">*</span></label>
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
                    <label for = "training_year">Training Year<span class="red">*</span></label>
                    <input type="integer" name="training_year" id="training_year" class="form-control">
                    <span class="text-danger error" id="training_year_error"></span>
                </div>
            </div>
    </div>`);
    return form;
}

    // Show Button part
    $(document).on('click', '.emp_trainingDetail', function (e) {
        let id = $(this).attr('data-id');
        let $detailsRow = $(`#detailstraining${id}`);
        let $button = $(this); // Reference to the clicked button
    
        if ($detailsRow.is(':visible')) {
            // If the row is visible, hide it, change button text to "Show", and remove caret rotation
            $detailsRow.hide();
            $button.find('.fa-chevron-circle-right').removeClass('rotate');
        } else {
            // Fetch data and show it, then change button text to "Hide", and add caret rotation
            $.ajax({
                url: "/employee/training",
                method: 'GET',
                data: {id:id},
                success: function (res) {
                    console.log(res);
                    $detailsRow.find('td').html(res.data);
                    $detailsRow.show();
                    $button.find('.fa-chevron-circle-right').addClass('rotate');
                },
                error: function (err) {
                    console.log(err);
                }
            });
        }
    });

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

 

    // Show Employee Details List Toggle Functionality
    $(document).on('click', '.employeetrainingdetails li', function(e){
        let id = $(this).attr('data-id');
        if(id == 1){
            if($('.personal').is(':visible')){
                $('.personal').hide()
            }
            else{
                $('.personal').show();
            }
        }
        else if(id == 2){
            if($('.training').is(':visible')){
                $('.training').hide()
            }
            else{
                $('.training').show();
            }
        }
    });

    // Edit Button Click Event
    $(document).on('click', '.editTrainingDetail', function () {
        let modalId = $(this).data('modal-id');
        let id = $(this).attr('data-id');
        let formId = $(this).data('form-id'); // Get the form ID associated with the clicked edit button

        // Fetch form data for the corresponding form ID
        $.ajax({
            url: `/edit/employee/training`,
            method: 'GET',
            data: { id: id }, // Send the form ID to the server
            success: function (res) {
                // Populate modal fields with fetched form data
                $('#id').val(res.employee.id);
                $('#empId').val(res.employee.emp_id);
                $('#update_training_title').val(res.employee.training_title);
                $('#update_country').val(res.employee.country);
                $('#update_topic').val(res.employee.topic);
                $('#update_institution_name').val(res.employee.institution_name);
                $('#update_start_date').val(res.employee.start_date);
                $('#update_end_date').val(res.employee.end_date);
                $('#update_training_year').val(res.employee.training_year);
                
                // Show the modal
                var modal = document.getElementById(modalId);
                modal.style.display = 'block';
            },
            error: function (err) {
                console.log(err);
            }
        });
    });

    // Submit Edited Employee Training Form
    $(document).on('submit', '#EditTrainingForm', function (e) {
        e.preventDefault();
        let formData = new FormData(this);

        // Make AJAX request to update form data
        $.ajax({
            url: $(this).attr('action'), // Use form action attribute for update URL
            method: 'POST', // Use POST method for updating data
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function (res) {
                if (res.status == "success") {
                    $('#editTrainingDetail').hide();
                    $('#EditTrainingForm')[0].reset();
                    $('#search').val('');
                    $('.employee').load(location.href + ' .employee');
                    toastr.success('Employee Updated Successfully', 'Updated!');
                }
            },
            error: function (err) {
                console.log(err);
            }
        });
    });

    /////////////// ------------------ Delete Employee Ajax Part Start ---------------- /////////////////////////////
    // Training Delete Button Functionality
    $(document).on('click', '#deleteTraining', function (e) {
        e.preventDefault();
        $('#deleteModalTraining').show();
        let id = $(this).data('id');
        $('#confirm').attr('data-id',id);
        $('#cancel').focus();
    });

    // Cancel Button Functionality
    $(document).on('click', '#cancel', function (e) {
        e.preventDefault();
        $('#deleteModalTraining').hide();
    });

    // Confirm Button Functionality
    $(document).on('click', '#confirm', function (e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        $.ajax({
            url: `/employee/training/delete`,
            method: 'DELETE',
            data: { id:id },
            success: function (res) {
                if (res.status == "success") {
                    $('.employee').load(location.href + ' .employee');
                    $('#search').val('');
                    $('#deleteModalTraining').hide();
                    toastr.success('Training Details Deleted Successfully', 'Deleted!');
                }
            }
        });
    });

    /////////////// ------------------ Pagination Ajax Part Start ---------------- /////////////////////////////
    $(document).on('click', '.paginate a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        loadEmployeeData(`/training/pagination?page=${page}`, {}, '.employee');
    });



    // On select option search value will be remove
    $(document).on('change', '#searchOption', function (e) {
        $('#search').val('');
    });



    /////////////// ------------------ Search Ajax Part Start ---------------- /////////////////////////////
    $(document).on('keyup', '#search', function (e) {
        e.preventDefault();
        let search = $(this).val();
        let searchOption = $("#searchOption").val();
        if(searchOption == "1"){
            loadEmployeeData(`/search/employee/training`, {search:search}, '.employee')
        }
        if(searchOption == "2"){
            loadEmployeeData(`/search/employee/training/email`, {search:search}, '.employee')
        }
        if(searchOption == "3"){
            loadEmployeeData(`/search/employee/training/phone`, {search:search}, '.employee')
        }
        if(searchOption == "4"){
            loadEmployeeData(`/search/employee/training/location`, {search:search}, '.employee')
        }
        if(searchOption == "5"){
            loadEmployeeData(`/search/employee/training/address`, {search:search}, '.employee')
        }
        if(searchOption == "6"){
            loadEmployeeData(`/search/employee/training/nid`, {search:search}, '.employee')
        }
        if(searchOption == "7"){
            loadEmployeeData(`/search/employee/training/dob`, {search:search}, '.employee')
        }
    });



    /////////////// ------------------ Search Pagination Ajax Part Start ---------------- /////////////////////////////
    $(document).on('click', '.search-paginate a', function (e) {
        e.preventDefault();
        $('.paginate').addClass('hidden');
        let search = $('#search').val();
        let page = $(this).attr('href').split('page=')[1];
        let searchOption = $("#searchOption").val();
        if(searchOption == "1"){
            loadEmployeeData(`/search/page/training?page=${page}`, {search:search}, '.employee');
        }
        else if(searchOption == "2"){
            loadEmployeeData(`/search/page/training/email?page=${page}`, {search:search}, '.employee');
        }
        else if(searchOption == "3"){
            loadEmployeeData(`/search/page/training/phone?page=${page}`, {search:search}, '.employee');
        }
        else if(searchOption == "4"){
            loadEmployeeData(`/search/page/training/location?page=${page}`, {search:search}, '.employee');
        }
        else if(searchOption == "5"){
            loadEmployeeData(`/search/page/training/address?page=${page}`, {search:search}, '.employee');
        }
        else if(searchOption == "6"){
            loadEmployeeData(`/search/page/training/nid?page=${page}`, {search:search}, '.employee');
        }
        else if(searchOption == "7"){
            loadEmployeeData(`/search/page/training/dob?page=${page}`, {search:search}, '.employee');
        }
        
    });



    // Employee Data Load Function
    function loadEmployeeData(url, data, targetElement) {
        $.ajax({
            url: url,
            data: data,
            success: function (res) {
                if (res.status == "null") {
                    $(targetElement).html(`<span class="text-danger">Result not Found </span>`);
                } else {
                    $(targetElement).html(res.data);
                    if(res.paginate){
                        $(targetElement).append('<div class="center search-paginate" id="paginate">' + res.paginate + '</div>');
                    }
                }
            }
        });
    }
});