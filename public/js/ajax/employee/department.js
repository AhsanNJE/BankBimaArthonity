$(document).ready(function () {

    /////////////// ------------------ Add Department ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#InsertDepartment', function (e) {
        e.preventDefault();
        let deptName = $('#deptName').val();
        $.ajax({
            url: "/admin/employees/insert/departments",
            method: 'Post',
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



    ///////////// ------------------ Edit Department ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.editDepartment', function () {
        let modalId = $(this).data('modal-id');
        let id = $(this).data('id');
        $.ajax({
            url: `/admin/employees/edit/departments`,
            method: 'get',
            data: { id:id },
            success: function (res) {
                $('#id').val(id);
                $('#updateDeptName').val(res.department.dept_name);

                var modal = document.getElementById(modalId);
                modal.style.display = 'block';
            },
            error: function (err) {
                console.log(err);
            }
        });
    });



    /////////////// ------------------ Update Departments ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#UpdateDepartment', function (e) {
        e.preventDefault();
        let id = $('#id').val();
        let deptName = $('#updateDeptName').val();
        $.ajax({
            url: `/admin/employees/update/departments`,
            method: 'Put',
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



    /////////////// ------------------ Delete Department ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#delete', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        if (confirm('Are You Sure to Delete This Location ??')) {
            $.ajax({
                url: `/admin/employees/delete/departments`,
                method: 'Delete',
                data: { id:id },
                success: function (res) {
                    if (res.status == "success") {
                        $('.department').load(location.href + ' .department');
                        $('#search').val('');
                        toastr.success('Department Deleted Successfully', 'Deleted!');
                    }
                }
            });
        }
    });



    /////////////// ------------------ Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.paginate a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        loadDepartmentData(`/admin/employees/departments/pagination?page=${page}`, {}, '.department');
    });



    //on select option search value will be remove
    $(document).on('change', '#searchOption', function (e) {
        $('#search').val('');
    });



    /////////////// ------------------ Search ajax part start ---------------- /////////////////////////////
    $(document).on('keyup', '#search', function (e) {
        e.preventDefault();
        let search = $(this).val();
        loadDepartmentData(`/admin/employees/search/departments`, {search:search}, '.department')
    });



    /////////////// ------------------ Search Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.search-paginate a', function (e) {
        e.preventDefault();
        $('.paginate').addClass('hidden');
        let search = $('#search').val();
        let page = $(this).attr('href').split('page=')[1];
        loadDepartmentData(`/admin/employees/departments/search/pagination?page=${page}`, {search:search}, '.department');
    });



    //Department data load function
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