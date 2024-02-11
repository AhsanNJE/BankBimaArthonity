$(document).ready(function () {

    /////////////// ------------------ Add Employee ajax part start ---------------- /////////////////////////////
    $(document).on('submit', '#AddEmployeeForm', function (e) {
        e.preventDefault();
        let locations = $('#location').attr('data-id');
        let department = $('#department').attr('data-id');
        let designation = $('#designation').attr('data-id');
        let formData = new FormData(this);
        formData.append('location',locations);
        formData.append('department',department);
        formData.append('designation',designation);
        $.ajax({
            url: "/admin/employees/insertEmployees",
            method: 'Post',
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
                    $('#search').val('');
                    $('.employee').load(location.href + ' .employee');
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




    //////////////////// --------------------- Show image when select file ---------------- /////////////////////
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




    ///////////// ------------------ Edit Employee ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.editEmployee', function () {
        let modalId = $(this).data('modal-id');
        let id = $(this).data('id');
        $.ajax({
            url: `/admin/employees/editEmployees`,
            method: 'get',
            data: { id:id },
            success: function (res) {
                $('#id').val(id);
                $('#updateName').val(res.employee.emp_name);
                $('#updateEmail').val(res.employee.emp_email);
                $('#updatePhone').val(res.employee.emp_phone);
                $('#updateLocation').val(res.employee.location.thana);
                $('#updateLocation').attr('data-id',res.employee.loc_id);
                $('#updateType').val(res.employee.emp_type);
                $('#updateDepartment').val(res.employee.department.dept_name);
                $('#updateDepartment').attr('data-id',res.employee.dept_id);
                $('#updateDesignation').val(res.employee.designation.designation);
                $('#updateDesignation').attr('data-id',res.employee.designation_id);
                $('#updateDob').val(res.employee.dob);
                $('#updateAddress').val(res.employee.address);
                $('#updatePreviewImage').attr('src',`/storage/profiles/${res.employee.image}`).show();

                var modal = document.getElementById(modalId);
                modal.style.display = 'block';
            },
            error: function (err) {
                console.log(err);
            }
        });
    });



    /////////////// ------------------ Update Employees ajax part start ---------------- /////////////////////////////
    $(document).on('submit', '#EditEmployeeForm', function (e) {
        e.preventDefault();
        let locations = $('#updateLocation').attr('data-id');
        let department = $('#updateDepartment').attr('data-id');
        let designation = $('#updateDesignation').attr('data-id');
        let formData = new FormData(this);
        // formData.append('location',locations);
        // formData.append('department',department);
        // formData.append('designation',designation);
        console.log(formData)
        $.ajax({
            url: `/admin/employees/updateEmployees`,
            method: 'Put',
            processData: false,
            contentType: false,
            dataType:'json',
            data: formData,
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
                url: `/admin/employees/deleteEmployees`,
                method: 'Delete',
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



    /////////////// ------------------ Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.paginate a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        loadDesignationData(`/admin/employees/employees/pagination?page=${page}`, {}, '.employee');
    });



    //on select option search value will be remove
    $(document).on('change', '#searchOption', function (e) {
        $('#search').val('');
    });



    /////////////// ------------------ Search ajax part start ---------------- /////////////////////////////
    $(document).on('keyup', '#search', function (e) {
        e.preventDefault();
        let search = $(this).val();
        let searchOption = $("#searchOption").val();
        if(searchOption == "1"){
            loadEmployeeData(`/admin/employees/searchEmployees`, {search:search}, '.employee')
        }
        else if(searchOption == "2"){
            loadEmployeeData(`/admin/employees/searchEmployees/district`, {search:search}, '.employee')
        }
        else if(searchOption == "3"){
            loadEmployeeData(`/admin/employees/searchEmployees/thana`, {search:search}, '.employee')
        }
        
    });



    /////////////// ------------------ Search Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.search-paginate a', function (e) {
        e.preventDefault();
        $('.paginate').addClass('hidden');
        let search = $('#search').val();
        let page = $(this).attr('href').split('page=')[1];
        let searchOption = $("#searchOption").val();
        if(searchOption == "1"){
            loadEmployeeData(`/admin/employees/employees/searchPagination?page=${page}`, {search:search}, '.employee');
        }
        else if(searchOption == "2"){
            loadEmployeeData(`/admin/employees/employees/searchPagination/district?page=${page}`, {search:search}, '.employee');
        }
        else if(searchOption == "2"){
            loadEmployeeData(`/admin/employees/employees/searchPagination/division?page=${page}`, {search:search}, '.employee');
        }
        
    });



    //Employee data load function
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