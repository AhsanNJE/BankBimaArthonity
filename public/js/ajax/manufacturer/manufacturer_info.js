$(document).ready(function () {

    //Manufacturer Input Field Empty Error
    $(document).on('submit', '#AddManufacturerForm', function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        
        $.ajax({
            url: "/insert/manufacturer",
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
                    $('#AddManufacturerForm')[0].reset();
                    $('#name').focus();
                    $('#search').val('');
                    $('.manufacturer').load(location.href + ' .manufacturer');
                    toastr.success('Manufacturer Added Successfully', 'Added!');
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


    //Show Manufacturer Details on details modal
    $(document).on('click', '.showManufacturerDetails', function (e) {
        let modal = $(this).attr('data-modal-id');
        let id = $(this).attr('data-id');
        $.ajax({
            url: "/manufacturer/info",
            method: 'GET',
            data: {id:id},
            success: function (res) {
                $("#"+ modal).show();
                $('.manufacturerdetails').html(res.data)
            },
            error: function (err) {
                console.log(err)
            }
        });
    });

    ///////////// ------------------ Edit Manufacturer Ajax Part Start ---------------- /////////////////////////////
    $(document).on('click', '.editManufacturer', function () {
        let modalId = $(this).data('modal-id');
        let id = $(this).data('id');
        $.ajax({
            url: `/edit/manufacturer`,
            method: 'GET',
            data: { id:id },
            success: function (res) {
                $('#id').val(res.manufacturer.id);
                $('#update_manufacturer_name').val(res.manufacturer.manufacturer_name);
                var modal = document.getElementById(modalId);
                modal.style.display = 'block';
            },
            error: function (err) {
                console.log(err);
            }
        });
    });



    /////////////// ------------------ Update Manufacturer Ajax Part Start ---------------- /////////////////////////////
    $(document).on('submit', '#EditManufacturerForm', function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            url: `/update/manufacturer`,
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
                    $('#editManufacturer').hide();
                    $('#EditManufacturerForm')[0].reset();
                    $('#search').val('');
                    $('.manufacturer').load(location.href + ' .manufacturer');
                    toastr.success('Manufacturer Updated Successfully', 'Updated!');
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
    // Manufacturer Delete Button Functionality
    $(document).on('click', '#delete', function (e) {
        e.preventDefault();
        $('#deleteManufacturerModal').show();
        let id = $(this).data('id');
        $('#confirm').attr('data-id',id);
        $('#cancel').focus();
    });

    // Cancel Button Functionality
    $(document).on('click', '#cancel', function (e) {
        e.preventDefault();
        $('#deleteManufacturerModal').hide();
    });

    // Confirm Button Functionality
    $(document).on('click', '#confirm', function (e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        $.ajax({
            url: `/manufacturer/delete`,
            method: 'DELETE',
            data: { id:id },
            success: function (res) {
                if (res.status == "success") {
                    $('.manufacturer').load(location.href + ' .manufacturer');
                    $('#search').val('');
                    $('#deleteManufacturerModal').hide();
                    toastr.success('Manufacturer Deleted Successfully', 'Deleted!');
                }
            }
        });
    });



    /////////////// ------------------ Pagination Ajax Part Start ---------------- /////////////////////////////
    $(document).on('click', '.paginate a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        loadEmployeeData(`/manufacturer/pagination?page=${page}`, {}, '.manufacturer');
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
        loadEmployeeData(`/search/page/manufacturer`, {search: search}, '.manufacturer');
    });



    /////////////// ------------------ Search Pagination Ajax Part Start ---------------- /////////////////////////////
    $(document).on('click', '.search-paginate a', function (e) {
        e.preventDefault();
        $('.paginate').addClass('hidden');
        let search = $('#search').val();
        let page = $(this).attr('href').split('page=')[1];
        let searchOption = $("#searchOption").val();
        if(searchOption == "1"){
            loadEmployeeData(`/search/page/manufacturer?page=${page}`, {search:search}, '.manufacturer');
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