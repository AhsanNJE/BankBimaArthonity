$(document).ready(function () {

    /////////////// ------------------ Add Designation ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#InsertDesignation', function (e) {
        e.preventDefault();
        let designations = $('#designations').val();
        let department = $('#department').attr('data-id');
        $.ajax({
            url: "/admin/employees/insert/designations",
            method: 'POST',
            data: { designations:designations, department:department },
            beforeSend:function() {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#AddDesignationForm')[0].reset();
                    $('#designations').focus();
                    $('#search').val('');
                    $('.designation').load(location.href + ' .designation');
                    toastr.success('Designation Added Successfully', 'Added!');
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



    ///////////// ------------------ Edit Designation ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.editDesignation', function () {
        let modalId = $(this).data('modal-id');
        let id = $(this).data('id');
        $.ajax({
            url: `/admin/employees/edit/designations`,
            method: 'GET',
            data: { id:id },
            success: function (res) {
                $('#id').val(id);
                $('#updateDesignations').val(res.designations.designation);
                $('#updateDepartment').attr('data-id',res.designations.dept_id);
                $('#updateDepartment').val(res.designations.department.dept_name);

                var modal = document.getElementById(modalId);
                modal.style.display = 'block';
            },
            error: function (err) {
                console.log(err);
            }
        });
    });



    /////////////// ------------------ Update Departments ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#UpdateDesignation', function (e) {
        e.preventDefault();
        let id = $('#id').val();
        let designations = $('#updateDesignations').val();
        let department = $('#updateDepartment').attr('data-id');
        $.ajax({
            url: `/admin/employees/update/designations`,
            method: 'PUT',
            data: { designations: designations, department:department, id:id },
            beforeSend:function() {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#editDesignation').hide();
                    $('#EditDesignationForm')[0].reset();
                    $('#search').val('');
                    $('.designation').load(location.href + ' .designation');
                    toastr.success('Designation Updated Successfully', 'Updated!');
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



    /////////////// ------------------ Delete Designation ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#delete', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        if (confirm('Are You Sure to Delete This Location ??')) {
            $.ajax({
                url: `/admin/employees/delete/designations`,
                method: 'DELETE',
                data: { id:id },
                success: function (res) {
                    if (res.status == "success") {
                        $('.designation').load(location.href + ' .designation');
                        $('#search').val('');
                        toastr.success('Designation Deleted Successfully', 'Deleted!');
                    }
                }
            });
        }
    });



    /////////////// ------------------ Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.paginate a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        loadDesignationData(`/admin/employees/designations/pagination?page=${page}`, {}, '.designation');
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
            loadDesignationData(`/admin/employees/search/designations`, {search:search}, '.designation')
        }
        else if(searchOption == "2"){
            loadDesignationData(`/admin/employees/search/designations/department`, {search:search}, '.designation')
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
            loadDesignationData(`/admin/employees/designations/search/pagination?page=${page}`, {search:search}, '.designation');
        }
        else if(searchOption == "2"){
            loadDesignationData(`/admin/employees/designations/search/pagination/department?page=${page}`, {search:search}, '.designation');
        }
        
    });



    //Designation data load function
    function loadDesignationData(url, data, targetElement) {
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