$(document).ready(function () {

    //Product Input Field Empty Error
    $(document).on('submit', '#AddProductForm', function (e) {
        e.preventDefault();
        let locations = $('#location').attr('data-id');
        let formData = new FormData(this);
        formData.append('location', locations === undefined ? '' : locations);

        $.ajax({
            url: "/insert/product",
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
                    $('#AddProductForm')[0].reset();
                    $('#name').focus();
                    $('#search').val('');
                    $('.product').load(location.href + ' .product');
                    toastr.success('Product Added Successfully', 'Added!');
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



    ///////////// ------------------ Edit Product Ajax Part Start ---------------- /////////////////////////////
    $(document).on('click', '.editProduct', function () {
        let modalId = $(this).data('modal-id');
        let id = $(this).data('id');
        $.ajax({
            url: `/edit/product`,
            method: 'GET',
            data: { id:id },
            success: function (res) {
                $('#id').val(res.product.id);
                $('#update_product_name').val(res.product.product_name);

                // Create options dynamically
                $('#update_division').empty();
                $('#update_division').append(`<option value="Dhaka" ${res.product.division === 'Dhaka' ? 'selected' : ''}>Dhaka</option>
                                         <option value="Mymensingh" ${res.product.division === 'Mymensingh' ? 'selected' : ''}>Mymensingh</option>
                                         <option value="Sylhet" ${res.product.division === 'Sylhet' ? 'selected' : ''}>Sylhet</option>
                                         <option value="Chattogram" ${res.product.division === 'Chattogram' ? 'selected' : ''}>Chattogram</option>
                                         <option value="Barishal" ${res.product.division === 'Barishal' ? 'selected' : ''}>Barishal</option>
                                         <option value="Khulna" ${res.product.division === 'Khulna' ? 'selected' : ''}>Khulna</option>
                                         <option value="Rajshahi" ${res.product.division === 'Rajshahi' ? 'selected' : ''}>Rajshahi</option>
                                         <option value="Rangpur" ${res.product.division === 'Rangpur' ? 'selected' : ''}>Rangpur</option>`);

                $('#updateLocation').val(res.product.location.upazila);
                $('#updateLocation').attr('data-id',res.product.location_id);

                var modal = document.getElementById(modalId);
                modal.style.display = 'block';
            },
            error: function (err) {
                console.log(err);
            }
        });
    });



    /////////////// ------------------ Update Product Ajax Part Start ---------------- /////////////////////////////
    $(document).on('submit', '#EditProductForm', function (e) {
        e.preventDefault();
        let locations = $('#updateLocation').attr('data-id');
        let formData = new FormData(this);
        formData.append('location',locations);
        $.ajax({
            url: `/update/product`,
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
                    $('#editProduct').hide();
                    $('#EditProductForm')[0].reset();
                    $('#search').val('');
                    $('.product').load(location.href + ' .product');
                    toastr.success('Product Updated Successfully', 'Updated!');
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
    // Product Delete Button Functionality
    $(document).on('click', '#delete', function (e) {
        e.preventDefault();
        $('#deleteProductModal').show();
        let id = $(this).data('id');
        $('#confirm').attr('data-id',id);
        $('#cancel').focus();
    });

    // Cancel Button Functionality
    $(document).on('click', '#cancel', function (e) {
        e.preventDefault();
        $('#deleteProductModal').hide();
    });

    // Confirm Button Functionality
    $(document).on('click', '#confirm', function (e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        $.ajax({
            url: `/product/delete`,
            method: 'DELETE',
            data: { id:id },
            success: function (res) {
                if (res.status == "success") {
                    $('.product').load(location.href + ' .product');
                    $('#search').val('');
                    $('#deleteProductModal').hide();
                    toastr.success('Product Deleted Successfully', 'Deleted!');
                }
            }
        });
    });



    /////////////// ------------------ Pagination Ajax Part Start ---------------- /////////////////////////////
    $(document).on('click', '.paginate a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        loadEmployeeData(`/product/pagination?page=${page}`, {}, '.product');
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
            loadEmployeeData(`/search/page/product`, {search:search}, '.product')
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
            loadEmployeeData(`/search/page/product?page=${page}`, {search:search}, '.product');
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