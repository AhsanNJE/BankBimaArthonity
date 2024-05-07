$(document).ready(function () {
    $(document).on('click', '.add', function (e) {
        $('#name').focus();
    });

    //Show Employee Details on Details Modal
    $(document).on('click', '.showEmployeeDetails', function (e) {
        let modal = $(this).attr('data-modal-id');
        let id = $(this).attr('data-id');
        $.ajax({
            url: "/admin/employees/details",
            method: 'GET',
            data: {id:id},
            success: function (res) {
                $("#"+ modal).show();
                $('.details').html(res.data)
            },
            error: function (err) {
                console.log(err)
            }
        });
    });


    // Show Employee Details List Toggle Functionality
    $(document).on('click', '.details li', function(e){
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
        else if(id == 3){
            if($('.training').is(':visible')){
                $('.training').hide()
            }
            else{
                $('.training').show();
            }
        }
        else if(id == 4){
            if($('.experience').is(':visible')){
                $('.experience').hide()
            }
            else{
                $('.experience').show();
            }
        }
        else if(id == 5){
            if($('.organization').is(':visible')){
                $('.organization').hide()
            }
            else{
                $('.organization').show();
            }
        }
        else if(id == 6){
            if($('.payroll').is(':visible')){
                $('.payroll').hide()
            }
            else{
                $('.payroll').show();
            }
        }
    });


    /////////////// ------------------ Add Employee Ajax Part Start ---------------- /////////////////////////////
    $(document).on('submit', '#AddEmployeeForm', function (e) {
        e.preventDefault();
        let user = $('#user').attr('data-id');
        let locations = $('#location').attr('data-id');
        let department = $('#department').attr('data-id');
        let designation = $('#designation').attr('data-id');
        let formData = new FormData(this);
        formData.append('user', user === undefined ? '' : user);
        formData.append('department', department === undefined ? '' : department);
        formData.append('location', locations === undefined ? '' : locations);
        formData.append('designation', designation === undefined ? '' : designation);

        $.ajax({
            url: "/admin/employees/insert/employees",
            method: 'POST',
            processData: false,
            contentType: false,
            cache: false,
            data: formData,
            beforeSend:function() {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#AddEmployeeForm')[0].reset();
                    $('#name').focus();
                    $('#user').removeAttr('data-id');
                    $('#location').removeAttr('data-id');
                    $('#department').removeAttr('data-id');
                    $('#designation').removeAttr('data-id');
                    $('#search').val('');
                    $('.employee').load(location.href + ' .employee');
                    $('#previewImage').attr('src',`#`).hide();
                    toastr.success('Employee Added Successfully', 'Added!');
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




    //////////////////// --------------------- Show Image When Select File ---------------- /////////////////////
    $(document).on('change','#image', function (e){
        let path = $(this).val();
        let extension = path.substring(path.lastIndexOf('.')+1).toLowerCase();
        
        if(extension == 'jpg' || extension == 'jpeg' || extension == 'png' || extension == 'gif'){
            var file = e.target.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#previewImage').attr('src', e.target.result).show();
                };
                reader.readAsDataURL(file);
            }
            else{
                $('#previewImage').attr('src', " ").hide();
            }
        }
        else{
            $('#previewImage').attr('src', " ").hide();
        }
    });



    $(document).on('change','#updateImage', function (e){
        let path = $(this).val();
        let extension = path.substring(path.lastIndexOf('.')+1).toLowerCase();
        
        if(extension == 'jpg' || extension == 'jpeg' || extension == 'png' || extension == 'gif'){
            var file = e.target.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#updatePreviewImage').attr('src', e.target.result).show();
                };
                reader.readAsDataURL(file);
            }
            else{
                $('#updatePreviewImage').attr('src', " ").hide();
            }
        }
        else{
            $('#updatePreviewImage').attr('src', " ").hide();
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




    /////////////// ------------------ Delete Employee Ajax Part Start ---------------- /////////////////////////////
    // Delete Button Functionality
    $(document).on('click', '#delete', function (e) {
        e.preventDefault();
        $('#deleteModal').show();
        let id = $(this).data('id');
        $('#confirm').attr('data-id',id);
        $('#cancel').focus();
    });

    // Cancel Button Functionality
    $(document).on('click', '#cancel', function (e) {
        e.preventDefault();
        $('#deleteModal').hide();
    });

    // Confirm Button Functionality
    $(document).on('click', '#confirm', function (e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        $.ajax({
            url: `/admin/employees/delete/employees`,
            method: 'DELETE',
            data: { id:id },
            success: function (res) {
                if (res.status == "success") {
                    $('.employee').load(location.href + ' .employee');
                    $('#search').val('');
                    $('#deleteModal').hide();
                    toastr.success('Employee Deleted Successfully', 'Deleted!');
                }
            }
        });
    });
    
    
    /////////////// ------------------ Delete Employee Ajax Part End ---------------- /////////////////////////////




    /////////////// ------------------ Pagination Ajax Part Start ---------------- /////////////////////////////
    $(document).on('click', '.paginate a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        loadEmployeeData(`/admin/employees/employees/pagination?page=${page}`, {}, '.employee');
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
            loadEmployeeData(`/admin/employees/search/employees`, {search:search}, '.employee')
        }
        if(searchOption == "2"){
            loadEmployeeData(`/admin/employees/search/employees/email`, {search:search}, '.employee')
        }
        if(searchOption == "3"){
            loadEmployeeData(`/admin/employees/search/employees/phone`, {search:search}, '.employee')
        }
        if(searchOption == "4"){
            loadEmployeeData(`/admin/employees/search/employees/location`, {search:search}, '.employee')
        }
        if(searchOption == "5"){
            loadEmployeeData(`/admin/employees/search/employees/address`, {search:search}, '.employee')
        }
        if(searchOption == "6"){
            loadEmployeeData(`/admin/employees/search/employees/nid`, {search:search}, '.employee')
        }
        if(searchOption == "7"){
            loadEmployeeData(`/admin/employees/search/employees/dob`, {search:search}, '.employee')
        }
        if(searchOption == "8"){
            loadEmployeeData(`/admin/employees/search/employees/department`, {search:search}, '.employee')
        }
        if(searchOption == "9"){
            loadEmployeeData(`/admin/employees/search/employees/designation`, {search:search}, '.employee')
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
            loadEmployeeData(`/admin/employees/search/pagination?page=${page}`, {search:search}, '.employee');
        }
        else if(searchOption == "2"){
            loadEmployeeData(`/admin/employees/search/pagination/email?page=${page}`, {search:search}, '.employee');
        }
        else if(searchOption == "3"){
            loadEmployeeData(`/admin/employees/search/pagination/phone?page=${page}`, {search:search}, '.employee');
        }
        else if(searchOption == "4"){
            loadEmployeeData(`/admin/employees/search/pagination/location?page=${page}`, {search:search}, '.employee');
        }
        else if(searchOption == "5"){
            loadEmployeeData(`/admin/employees/search/pagination/address?page=${page}`, {search:search}, '.employee');
        }
        else if(searchOption == "6"){
            loadEmployeeData(`/admin/employees/search/pagination/nid?page=${page}`, {search:search}, '.employee');
        }
        else if(searchOption == "7"){
            loadEmployeeData(`/admin/employees/search/pagination/dob?page=${page}`, {search:search}, '.employee');
        }
        else if(searchOption == "8"){
            loadEmployeeData(`/admin/employees/search/pagination/department?page=${page}`, {search:search}, '.employee');
        }
        else if(searchOption == "9"){
            loadEmployeeData(`/admin/employees/search/pagination/designation?page=${page}`, {search:search}, '.employee');
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