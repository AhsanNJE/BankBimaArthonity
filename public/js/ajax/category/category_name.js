$(document).ready(function () {

    //Category Input Field Empty Error
    $(document).on('submit', '#AddCategoryForm', function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        
        $.ajax({
            url: "/insert/category",
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
                    $('#AddCategoryForm')[0].reset();
                    $('#name').focus();
                    $('#search').val('');
                    $('.category').load(location.href + ' .category');
                    toastr.success('Category Added Successfully', 'Added!');
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


    //Show Category Details on details modal
    $(document).on('click', '.showCategoryDetails', function (e) {
        let modal = $(this).attr('data-modal-id');
        let id = $(this).attr('data-id');
        $.ajax({
            url: "/category/info",
            method: 'GET',
            data: {id:id},
            success: function (res) {
                $("#"+ modal).show();
                $('.categorydetails').html(res.data)
            },
            error: function (err) {
                console.log(err)
            }
        });
    });

    ///////////// ------------------ Edit Category Ajax Part Start ---------------- /////////////////////////////
    $(document).on('click', '.editCategory', function () {
        let modalId = $(this).data('modal-id');
        let id = $(this).data('id');
        $.ajax({
            url: `/edit/category`,
            method: 'GET',
            data: { id:id },
            success: function (res) {
                $('#id').val(res.category.id);
                $('#update_category_name').val(res.category.category_name);
                var modal = document.getElementById(modalId);
                modal.style.display = 'block';
            },
            error: function (err) {
                console.log(err);
            }
        });
    });



    /////////////// ------------------ Update Category Ajax Part Start ---------------- /////////////////////////////
    $(document).on('submit', '#EditCategoryForm', function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            url: `/update/category`,
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
                    $('#editCategory').hide();
                    $('#EditCategoryForm')[0].reset();
                    $('#search').val('');
                    $('.category').load(location.href + ' .category');
                    toastr.success('Category Updated Successfully', 'Updated!');
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
    // Category Delete Button Functionality
    $(document).on('click', '#delete', function (e) {
        e.preventDefault();
        $('#deleteCategoryModal').show();
        let id = $(this).data('id');
        $('#confirm').attr('data-id',id);
        $('#cancel').focus();
    });

    // Cancel Button Functionality
    $(document).on('click', '#cancel', function (e) {
        e.preventDefault();
        $('#deleteCategoryModal').hide();
    });

    // Confirm Button Functionality
    $(document).on('click', '#confirm', function (e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        $.ajax({
            url: `/category/delete`,
            method: 'DELETE',
            data: { id:id },
            success: function (res) {
                if (res.status == "success") {
                    $('.category').load(location.href + ' .category');
                    $('#search').val('');
                    $('#deleteCategoryModal').hide();
                    toastr.success('Category Deleted Successfully', 'Deleted!');
                }
            }
        });
    });



    /////////////// ------------------ Pagination Ajax Part Start ---------------- /////////////////////////////
    $(document).on('click', '.paginate a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        loadEmployeeData(`/category/pagination?page=${page}`, {}, '.category');
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
            loadEmployeeData(`/search/page/category`, {search:search}, '.category')
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
            loadEmployeeData(`/search/page/category?page=${page}`, {search:search}, '.category');
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