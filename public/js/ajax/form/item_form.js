$(document).ready(function () {

    //Form Input Field Empty Error
    $(document).on('submit', '#AddFormForm', function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        
        $.ajax({
            url: "/insert/form",
            method: 'POST',
            cache: false,
            processData: false,
            contentType: false,
            data: formData,
            beforeSend:function() {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                console.log(res)
                if (res.status == "success") {
                    $('#AddFormForm')[0].reset();
                    $('#name').focus();
                    $('#search').val('');
                    $('.form').load(location.href + ' .form');
                    toastr.success('Form Added Successfully', 'Added!');
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


    //Show Form Details on details modal
    $(document).on('click', '.showFormDetails', function (e) {
        let modal = $(this).attr('data-modal-id');
        let id = $(this).attr('data-id');
        $.ajax({
            url: "/form/info",
            method: 'GET',
            data: {id:id},
            success: function (res) {
                $("#"+ modal).show();
                $('.formdetails').html(res.data)
            },
            error: function (err) {
                console.log(err)
            }
        });
    });

    ///////////// ------------------ Edit Form Ajax Part Start ---------------- /////////////////////////////
    $(document).on('click', '.editForm', function () {
        let modalId = $(this).data('modal-id');
        let id = $(this).data('id');
        $.ajax({
            url: `/edit/form`,
            method: 'GET',
            data: { id:id },
            success: function (res) {
                $('#id').val(res.form.id);
                $('#update_form_name').val(res.form.form_name);
                var modal = document.getElementById(modalId);
                modal.style.display = 'block';
            },
            error: function (err) {
                console.log(err);
            }
        });
    });



    /////////////// ------------------ Update Form Ajax Part Start ---------------- /////////////////////////////
    $(document).on('submit', '#EditFormForm', function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            url: `/update/form`,
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
                    $('#editForm').hide();
                    $('#EditFormForm')[0].reset();
                    $('#search').val('');
                    $('.form').load(location.href + ' .form');
                    toastr.success('Form Updated Successfully', 'Updated!');
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
    // Form Delete Button Functionality
    $(document).on('click', '#delete', function (e) {
        e.preventDefault();
        $('#deleteFormModal').show();
        let id = $(this).data('id');
        $('#confirm').attr('data-id',id);
        $('#cancel').focus();
    });

    // Cancel Button Functionality
    $(document).on('click', '#cancel', function (e) {
        e.preventDefault();
        $('#deleteFormModal').hide();
    });

    // Confirm Button Functionality
    $(document).on('click', '#confirm', function (e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        $.ajax({
            url: `/form/delete`,
            method: 'DELETE',
            data: { id:id },
            success: function (res) {
                if (res.status == "success") {
                    $('.form').load(location.href + ' .form');
                    $('#search').val('');
                    $('#deleteFormModal').hide();
                    toastr.success('Form Deleted Successfully', 'Deleted!');
                }
            }
        });
    });



    /////////////// ------------------ Pagination Ajax Part Start ---------------- /////////////////////////////
    $(document).on('click', '.paginate a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        loadEmployeeData(`/form/pagination?page=${page}`, {}, '.form');
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
        // Since searchOption is always "Name", we can directly call the function
        loadEmployeeData(`/search/page/form`, {search: search}, '.form');
    });



    /////////////// ------------------ Search Pagination Ajax Part Start ---------------- /////////////////////////////
    $(document).on('click', '.search-paginate a', function (e) {
        e.preventDefault();
        $('.paginate').addClass('hidden');
        let search = $('#search').val();
        let page = $(this).attr('href').split('page=')[1];
        let searchOption = $("#searchOption").val();
        if(searchOption == "1"){
            loadEmployeeData(`/search/page/form?page=${page}`, {search:search}, '.form');
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