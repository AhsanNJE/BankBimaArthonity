$(document).ready(function () {
    
    var formIndex = 2; // Initialize form index

    $('#addExperience').click(function() {
        var form = createForm(formIndex); // Create a new form
        $('#formContainer').append(form); // Append the form to the container
        formIndex++; // Increment form index
    });
    
    //Experience Form Field Empty and Insert Data in Add Form 
    $('#InsertExperience').on('click', function() {
        // Check if forms have already been submitted
        if ($(this).data('submitted')) {
            // Forms already submitted, do nothing
            return;
        }
    
        // Mark the button as submitted
        $(this).data('submitted', true);
    
        // Start submitting forms sequentially
        submitForm($('.experience-form').first());
    });
    
    // Function to submit forms sequentially
    function submitForm(form) {
        if (!form.length) {
            // No more forms to submit
            return;
        }
    
        let user = $('#user').attr('data-id');
        let formData = new FormData(form[0]);
        formData.append('user', user === undefined ? '' : user);
    
        $.ajax({
            url: "/insert/experience/info",
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
    
                    // Clear fields outside the form (if necessary)
                    $('#with').val('');
                    $('#user').val('');
                    $('#user-list ul').empty();
    
                    toastr.success('Experience Detail Added Successfully', 'Added!');
    
                    // Submit the next form recursively
                    submitForm(form.next('.experience-form'));
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
                    <span class="text-danger error" id="department_error"></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for = "designation">Designation</label>
                    <input type="text" name="designation" id="designation" class="form-control">
                    <span class="text-danger error" id="designation_error"></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for = "company_location">Company Address</label>
                    <input type="text" name="company_location" id="company_location"  class="form-control">
                    <span class="text-danger error" id="company_location_error"></span>
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


    // Show Button part
    $(document).on('click', '.emp_experienceDetail', function (e) {
        let id = $(this).attr('data-id');
        let $detailsRow = $(`#detailsexperience${id}`);
        let $button = $(this); // Reference to the clicked button
    
        if ($detailsRow.is(':visible')) {
            // If the row is visible, hide it, change button text to "Show", and remove caret rotation
            $detailsRow.hide();
            $button.find('.dropdown-caret').removeClass('rotate');
        } else {
            // Fetch data and show it, then change button text to "Hide", and add caret rotation
            $.ajax({
                url: "/employee/experience",
                method: 'GET',
                data: {id:id},
                success: function (res) {
                    console.log(res);
                    $detailsRow.find('td').html(res.data);
                    $detailsRow.show();
                    $button.find('.dropdown-caret').addClass('rotate');
                },
                error: function (err) {
                    console.log(err);
                }
            });
        }
    });
    
    
    

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


    // Show Employee Details List Toggle Functionality
    $(document).on('click', '.employeeexperiencedetails li', function(e){
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
            if($('.experience').is(':visible')){
                $('.experience').hide()
            }
            else{
                $('.experience').show();
            }
        }
    });

    // Edit Button Click Event
    $(document).on('click', '.editExperienceDetail', function () {
        let modalId = $(this).data('modal-id');
        let id = $(this).attr('data-id');
        let formId = $(this).data('form-id'); // Get the form ID associated with the clicked edit button

        // Fetch form data for the corresponding form ID
        $.ajax({
            url: `/edit/employee/experience`,
            method: 'GET',
            data: { id: id }, // Send the form ID to the server
            success: function (res) {
                // Populate modal fields with fetched form data
                $('#id').val(res.employee.id);
                $('#empId').val(res.employee.emp_id);
                $('#update_company_name').val(res.employee.company_name);
                $('#update_department').val(res.employee.department);
                $('#update_designation').val(res.employee.designation);
                $('#update_company_location').val(res.employee.company_location);
                $('#update_start_date').val(res.employee.start_date);
                $('#update_end_date').val(res.employee.end_date);
                
                // Show the modal
                var modal = document.getElementById(modalId);
                modal.style.display = 'block';
            },
            error: function (err) {
                console.log(err);
            }
        });
    });

    // Submit Edited Employee Experience Form
    $(document).on('submit', '#EditExperienceForm', function (e) {
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
                    $('#editExperienceDetail').hide();
                    $('#EditExperienceForm')[0].reset();
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
    // Experience Delete Button Functionality
    $(document).on('click', '#deleteExperience', function (e) {
        e.preventDefault();
        $('#deleteModalExperience').show();
        let id =$(this).attr('data-id');
        $('#confirm').attr('data-id',id);
        $('#cancel').focus();
    });

    // Cancel Button Functionality
    $(document).on('click', '#cancel', function (e) {
        e.preventDefault();
        $('#deleteModalExperience').hide();
    });

    // Confirm Button Functionality
    $(document).on('click', '#confirm', function (e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        $.ajax({
            url: `/employee/experience/delete`,
            method: 'DELETE',
            data: { id:id },
            success: function (res) {
                if (res.status == "success") {
                    $('.employee').load(location.href + ' .employee');
                    $('#search').val('');
                    $('#deleteModalExperience').hide();
                    toastr.success('Experience Details Deleted Successfully', 'Deleted!');
                }
            }
        });
    });

    /////////////// ------------------ Pagination Ajax Part Start ---------------- /////////////////////////////
    $(document).on('click', '.paginate a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        loadEmployeeData(`/page?page=${page}`, {}, '.employee');
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
            loadEmployeeData(`/search/employee/experience`, {search:search}, '.employee')
        }
        if(searchOption == "2"){
            loadEmployeeData(`/search/employee/experience/email`, {search:search}, '.employee')
        }
        if(searchOption == "3"){
            loadEmployeeData(`/search/employee/experience/phone`, {search:search}, '.employee')
        }
        if(searchOption == "4"){
            loadEmployeeData(`/search/employee/experience/company_location`, {search:search}, '.employee')
        }
        if(searchOption == "5"){
            loadEmployeeData(`/search/employee/experience/address`, {search:search}, '.employee')
        }
        if(searchOption == "6"){
            loadEmployeeData(`/search/employee/experience/nid`, {search:search}, '.employee')
        }
        if(searchOption == "7"){
            loadEmployeeData(`/search/employee/experience/dob`, {search:search}, '.employee')
        }
        if(searchOption == "8"){
            loadEmployeeData(`/search/employee/experience/department`, {search:search}, '.employee')
        }
        if(searchOption == "9"){
            loadEmployeeData(`/search/employee/experience/designation`, {search:search}, '.employee')
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
            loadEmployeeData(`/search/page/experience?page=${page}`, {search:search}, '.employee');
        }
        else if(searchOption == "2"){
            loadEmployeeData(`/search/page/experience/email?page=${page}`, {search:search}, '.employee');
        }
        else if(searchOption == "3"){
            loadEmployeeData(`/search/page/experience/phone?page=${page}`, {search:search}, '.employee');
        }
        else if(searchOption == "4"){
            loadEmployeeData(`/search/page/experience/company_location?page=${page}`, {search:search}, '.employee');
        }
        else if(searchOption == "5"){
            loadEmployeeData(`/search/page/experience/address?page=${page}`, {search:search}, '.employee');
        }
        else if(searchOption == "6"){
            loadEmployeeData(`/search/page/experience/nid?page=${page}`, {search:search}, '.employee');
        }
        else if(searchOption == "7"){
            loadEmployeeData(`/search/page/experience/dob?page=${page}`, {search:search}, '.employee');
        }
        else if(searchOption == "8"){
            loadEmployeeData(`/search/page/experience/department?page=${page}`, {search:search}, '.employee');
        }
        else if(searchOption == "9"){
            loadEmployeeData(`/search/page/experience/designation?page=${page}`, {search:search}, '.employee');
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
