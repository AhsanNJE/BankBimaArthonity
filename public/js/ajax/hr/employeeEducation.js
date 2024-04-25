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
    
    //Add Form Part start
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


    // Show Employee Details List Toggle Functionality
    $(document).on('click', '.employeeeducationdetails li', function(e){
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
            if($('.education').is(':visible')){
                $('.education').hide()
            }
            else{
                $('.education').show();
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
            loadEmployeeData(`/search/employee/education`, {search:search}, '.employee')
        }
        if(searchOption == "2"){
            loadEmployeeData(`/search/employee/education/email`, {search:search}, '.employee')
        }
        if(searchOption == "3"){
            loadEmployeeData(`/search/employee/education/phone`, {search:search}, '.employee')
        }
        if(searchOption == "4"){
            loadEmployeeData(`/search/employee/education/location`, {search:search}, '.employee')
        }
        if(searchOption == "5"){
            loadEmployeeData(`/search/employee/education/address`, {search:search}, '.employee')
        }
        if(searchOption == "6"){
            loadEmployeeData(`/search/employee/education/nid`, {search:search}, '.employee')
        }
        if(searchOption == "7"){
            loadEmployeeData(`/search/employee/education/dob`, {search:search}, '.employee')
        }
        if(searchOption == "8"){
            loadEmployeeData(`/search/employee/education/department`, {search:search}, '.employee')
        }
        if(searchOption == "9"){
            loadEmployeeData(`/search/employee/education/designation`, {search:search}, '.employee')
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
            loadEmployeeData(`/search/page/education?page=${page}`, {search:search}, '.employee');
        }
        else if(searchOption == "2"){
            loadEmployeeData(`/search/page/education/email?page=${page}`, {search:search}, '.employee');
        }
        else if(searchOption == "3"){
            loadEmployeeData(`/search/page/education/phone?page=${page}`, {search:search}, '.employee');
        }
        else if(searchOption == "4"){
            loadEmployeeData(`/search/page/education/location?page=${page}`, {search:search}, '.employee');
        }
        else if(searchOption == "5"){
            loadEmployeeData(`/search/page/education/address?page=${page}`, {search:search}, '.employee');
        }
        else if(searchOption == "6"){
            loadEmployeeData(`/search/page/education/nid?page=${page}`, {search:search}, '.employee');
        }
        else if(searchOption == "7"){
            loadEmployeeData(`/search/page/education/dob?page=${page}`, {search:search}, '.employee');
        }
        else if(searchOption == "8"){
            loadEmployeeData(`/search/page/education/department?page=${page}`, {search:search}, '.employee');
        }
        else if(searchOption == "9"){
            loadEmployeeData(`/search/page/education/designation?page=${page}`, {search:search}, '.employee');
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

document.getElementById('addEducation').addEventListener('click', function() {
    var container = document.getElementById('dynamicContainer');
    var newFields = document.createElement('div');
    newFields.innerHTML = `@include('education_fields')`;
    container.appendChild(newFields);
});