$(document).ready(function () {
    $(document).on('click', '.add', function (e) {
        $('#deptName').focus();
    });

    /////////////// ------------------ Add Department Ajax Part Start ---------------- /////////////////////////////
    $(document).on('click', '#InsertDepartment', function (e) {
        e.preventDefault();
        let deptName = $('#deptName').val();
        $.ajax({
            url: "/admin/employees/insert/departments",
            method: 'POST',
            data: { deptName:deptName },
            beforeSend:function() {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#AddDepartmentForm')[0].reset();
                    $('#deptName').focus();
                    $('#search').val('');
                    $('.department').load(location.href + ' .department');
                    toastr.success('Department Added Successfully', 'Added!');
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



    ///////////// ------------------ Edit Department Ajax Part Start ---------------- /////////////////////////////
    $(document).on('click', '.editDepartment', function () {
        let modalId = $(this).data('modal-id');
        let id = $(this).data('id');
        $.ajax({
            url: `/admin/employees/edit/departments`,
            method: 'GET',
            data: { id:id },
            success: function (res) {
                $('#id').val(id);
                $('#updateDeptName').val(res.department.dept_name);
                $('#updateDeptName').focus();
                var modal = document.getElementById(modalId);
                modal.style.display = 'block';
            },
            error: function (err) {
                console.log(err);
            }
        });
    });



    /////////////// ------------------ Update Departments Ajax Part Start ---------------- /////////////////////////////
    $(document).on('click', '#UpdateDepartment', function (e) {
        e.preventDefault();
        let id = $('#id').val();
        let deptName = $('#updateDeptName').val();
        $.ajax({
            url: `/admin/employees/update/departments`,
            method: 'PUT',
            data: { deptName: deptName, id:id },
            beforeSend:function() {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#editDepartment').hide();
                    $('#EditDepartmentForm')[0].reset();
                    $('#search').val('');
                    $('.department').load(location.href + ' .department');
                    toastr.success('Department Updated Successfully', 'Updated!');
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



    /////////////// ------------------ Delete Department Ajax Part Start ---------------- /////////////////////////////
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
            url: `/admin/employees/delete/departments`,
            method: 'DELETE',
            data: { id:id },
            success: function (res) {
                if (res.status == "success") {
                    $('.department').load(location.href + ' .department');
                    $('#search').val('');
                    $('#deleteModal').hide();
                    toastr.success('Department Deleted Successfully', 'Deleted!');
                }
            }
        });
    });
    
    
    /////////////// ------------------ Delete Department Ajax Part End ---------------- /////////////////////////////
    



    /////////////// ------------------ Pagination Ajax Part Start ---------------- /////////////////////////////
    $(document).on('click', '.paginate a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        loadDepartmentData(`/admin/employees/departments/pagination?page=${page}`, {}, '.department');
    });



    // On select option search value will be remove
    $(document).on('change', '#searchOption', function (e) {
        $('#search').val('');
    });



    /////////////// ------------------ Search Ajax Part Start ---------------- /////////////////////////////
    $(document).on('keyup', '#search', function (e) {
        e.preventDefault();
        let search = $(this).val();
        loadDepartmentData(`/admin/employees/search/departments`, {search:search}, '.department')
    });



    /////////////// ------------------ Search Pagination Ajax Part Start ---------------- /////////////////////////////
    $(document).on('click', '.search-paginate a', function (e) {
        e.preventDefault();
        $('.paginate').addClass('hidden');
        let search = $('#search').val();
        let page = $(this).attr('href').split('page=')[1];
        loadDepartmentData(`/admin/employees/departments/search/pagination?page=${page}`, {search:search}, '.department');
    });



    // Department Data Load Function
    function loadDepartmentData(url, data, targetElement) {
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