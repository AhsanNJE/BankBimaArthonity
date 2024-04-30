//Organization Detail Input Field Empty Error
$(document).on('submit', '#AddOrganizationDetailForm', function (e) {
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
        url: "/insert/organization/info",
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
                $('#AddOrganizationDetailForm')[0].reset();
                $('#name').focus();
                $('#user').removeAttr('data-id');
                $('#location').removeAttr('data-id');
                $('#department').removeAttr('data-id');
                $('#designation').removeAttr('data-id');
                $('#search').val('');
                $('.employee').load(location.href + ' .employee');
                $('#previewImage').attr('src',`#`).hide();
                toastr.success('Organization Detail Added Successfully', 'Added!');
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
    //Show Employee Organization Details on details modal
    $(document).on('click', '.EmployeeOrganizationDetails', function (e) {
        let modal = $(this).attr('data-modal-id');
        let id = $(this).attr('data-id');
        $.ajax({
            url: "/new/employee/organization",
            method: 'GET',
            data: {id:id},
            success: function (res) {
                $("#"+ modal).show();
                $('.employeeorganizationdetails').html(res.data)
            },
            error: function (err) {
                console.log(err)
            }
        });
    });

    // Show Employee Details List Toggle Functionality
    $(document).on('click', '.employeeorganizationdetails li', function(e){
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
            if($('.organization').is(':visible')){
                $('.organization').hide()
            }
            else{
                $('.organization').show();
            }
        }
    });

    ///////////// ------------------ Edit Employee Ajax Part Start ---------------- /////////////////////////////
    $(document).on('click', '.editOrganization', function () {
        let modalId = $(this).data('modal-id');
        let id = $(this).data('id');
        $.ajax({
            url: `/edit/employee/organization`,
            method: 'GET',
            data: { id:id },
            success: function (res) {
                $('#id').val(res.employee.id);
                $('#emp_id').val(res.employee.emp_id);
                $('#update_joining_date').val(res.employee.joining_date);
                $('#updateLocation').val(res.employee.location.upazila);
                $('#updateLocation').attr('data-id',res.employee.location_id);
                $('#updateDepartment').val(res.employee.department.dept_name);
                $('#updateDepartment').attr('data-id',res.employee.dept_id);
                $('#updateDesignation').val(res.employee.designation.designation);
                $('#updateDesignation').attr('data-id',res.employee.designation_id);

                var modal = document.getElementById(modalId);
                modal.style.display = 'block';
            },
            error: function (err) {
                console.log(err);
            }
        });
    });



    /////////////// ------------------ Update Employees Ajax Part Start ---------------- /////////////////////////////
    $(document).on('submit', '#EditOrganizationDetailForm', function (e) {
        e.preventDefault();
        let locations = $('#updateLocation').attr('data-id');
        let department = $('#updateDepartment').attr('data-id');
        let designation = $('#updateDesignation').attr('data-id');
        let formData = new FormData(this);
        formData.append('location',locations);
        formData.append('department',department);
        formData.append('designation',designation);
        $.ajax({
            url: `/update/employee/organization`,
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
                    $('#editOrganization').hide();
                    $('#EditOrganizationDetailForm')[0].reset();
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
        let id = $(this).data('emp_id');
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
            loadEmployeeData(`/search/employee/organization`, {search:search}, '.employee')
        }
        if(searchOption == "2"){
            loadEmployeeData(`/search/employee/organization/email`, {search:search}, '.employee')
        }
        if(searchOption == "3"){
            loadEmployeeData(`/search/employee/organization/phone`, {search:search}, '.employee')
        }
        if(searchOption == "4"){
            loadEmployeeData(`/search/employee/organization/location`, {search:search}, '.employee')
        }
        if(searchOption == "5"){
            loadEmployeeData(`/search/employee/organization/address`, {search:search}, '.employee')
        }
        if(searchOption == "6"){
            loadEmployeeData(`/search/employee/organization/nid`, {search:search}, '.employee')
        }
        if(searchOption == "7"){
            loadEmployeeData(`/search/employee/organization/dob`, {search:search}, '.employee')
        }
        if(searchOption == "8"){
            loadEmployeeData(`/search/employee/organization/department`, {search:search}, '.employee')
        }
        if(searchOption == "9"){
            loadEmployeeData(`/search/employee/organization/designation`, {search:search}, '.employee')
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
            loadEmployeeData(`/search/page/organization?page=${page}`, {search:search}, '.employee');
        }
        else if(searchOption == "2"){
            loadEmployeeData(`/search/page/organization/email?page=${page}`, {search:search}, '.employee');
        }
        else if(searchOption == "3"){
            loadEmployeeData(`/search/page/organization/phone?page=${page}`, {search:search}, '.employee');
        }
        else if(searchOption == "4"){
            loadEmployeeData(`/search/page/organization/location?page=${page}`, {search:search}, '.employee');
        }
        else if(searchOption == "5"){
            loadEmployeeData(`/search/page/organization/address?page=${page}`, {search:search}, '.employee');
        }
        else if(searchOption == "6"){
            loadEmployeeData(`/search/page/organization/nid?page=${page}`, {search:search}, '.employee');
        }
        else if(searchOption == "7"){
            loadEmployeeData(`/search/page/organization/dob?page=${page}`, {search:search}, '.employee');
        }
        else if(searchOption == "8"){
            loadEmployeeData(`/search/page/organization/department?page=${page}`, {search:search}, '.employee');
        }
        else if(searchOption == "9"){
            loadEmployeeData(`/search/page/organization/designation?page=${page}`, {search:search}, '.employee');
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