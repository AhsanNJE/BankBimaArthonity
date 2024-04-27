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
    
        // Loop through each training form
        $('.training-form').each(function(index, form) {
            $(form).submit(); // Submit the current form only once
        });
    });
    
    $(document).on('submit', '.training-form', function(e) {
        e.preventDefault();
    
        let user = $('#user').attr('data-id');
        let formData = new FormData(this);
        formData.append('user', user === undefined ? '' : user);
    
        const currentForm = $(this); // Store the current form object
    
        $.ajax({
            url: "/insert/training/info",
            method: 'POST',
            processData: false,
            contentType: false,
            cache: false,
            data: formData,
            beforeSend: function() {
                currentForm.find('span.error').text(''); // Clear errors
            },
            success: function(res) {
                console.log(res);
                if (res.status === "success") {
                    currentForm[0].reset(); // Reset the current form
                    currentForm.find('#name').focus(); // Set focus
    
                    // Clear errors and fields within the current form
                    currentForm.find('.text-danger').text('');
                    currentForm.find('#user').removeAttr('data-id');
                    currentForm.find('#search').val('');
    
                    // Clear fields outside the form (if necessary)
                    $('#with').val('');
                    $('#user').val('');
                    $('#user-list ul').empty();
    
                    toastr.success('Training Detail Added Successfully', 'Added!');

                    $('.training-form').not(':first').remove();  // Commented out for safety
                }
            },
            error: function(err) {
                console.log(err);
                let error = err.responseJSON;
                $.each(error.errors, function(key, value) {
                    currentForm.find('#' + key + "_error").text(value); // Set error messages
                });
            }
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
        if(searchOption == "8"){
            loadEmployeeData(`/search/employee/training/department`, {search:search}, '.employee')
        }
        if(searchOption == "9"){
            loadEmployeeData(`/search/employee/training/designation`, {search:search}, '.employee')
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
        else if(searchOption == "8"){
            loadEmployeeData(`/search/page/training/department?page=${page}`, {search:search}, '.employee');
        }
        else if(searchOption == "9"){
            loadEmployeeData(`/search/page/training/designation?page=${page}`, {search:search}, '.employee');
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