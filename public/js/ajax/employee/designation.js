$(document).ready(function () {
    $(document).on('click', '.add', function (e) {
        $("#designations").focus();
        $("#designations").val('');
        $('#department').removeAttr('data-id');
        $('#department').val('');
    });

    /////////////// ------------------ Add Designation Ajax Part Start ---------------- /////////////////////////////
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
                    $('#department').removeAttr('data-id');
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



    ///////////// ------------------ Edit Designation Ajax Part Start ---------------- /////////////////////////////
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
                $('#updateDesignations').focus();
                var modal = document.getElementById(modalId);
                modal.style.display = 'block';
            },
            error: function (err) {
                console.log(err);
            }
        });
    });



    /////////////// ------------------ Update Designation Ajax Part Start ---------------- /////////////////////////////
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
                    $('#updateDepartment').removeAttr('data-id');
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



    /////////////// ------------------ Delete Designation Ajax Part Start ---------------- /////////////////////////////
    //Delete Button Functionality
    $(document).on('click', '#delete', function (e) {
        e.preventDefault();
        $('#deleteModal').show();
        let id = $(this).data('id');
        $('#confirm').attr('data-id',id);
        $('#cancel').focus();
    });

    //Cancel Button Functionality
    $(document).on('click', '#cancel', function (e) {
        e.preventDefault();
        $('#deleteModal').hide();
    });

    //Confirm Button Functionality
    $(document).on('click', '#confirm', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        $.ajax({
            url: `/admin/employees/delete/designations`,
            method: 'DELETE',
            data: { id:id },
            success: function (res) {
                if (res.status == "success") {
                    $('.designation').load(location.href + ' .designation');
                    $('#search').val('');
                    $('#deleteModal').hide();
                    toastr.success('Designation Deleted Successfully', 'Deleted!');
                }
            }
        });
    });
    
    
    
    /////////////// ------------------ Delete Designation Ajax Part End ---------------- /////////////////////////////
    
    



    /////////////// ------------------ Pagination Ajax Part Start ---------------- /////////////////////////////
    $(document).on('click', '.paginate a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        loadDesignationData(`/admin/employees/designations/pagination?page=${page}`, {}, '.designation');
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
            loadDesignationData(`/admin/employees/search/designations`, {search:search}, '.designation')
        }
        else if(searchOption == "2"){
            loadDesignationData(`/admin/employees/search/designations/department`, {search:search}, '.designation')
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
            loadDesignationData(`/admin/employees/designations/search/pagination?page=${page}`, {search:search}, '.designation');
        }
        else if(searchOption == "2"){
            loadDesignationData(`/admin/employees/designations/search/pagination/department?page=${page}`, {search:search}, '.designation');
        }
        
    });



    // Designation Data Load Function
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