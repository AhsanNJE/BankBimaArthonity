$(document).ready(function () {

    //Store Input Field Empty Error
    $(document).on('submit', '#AddStoreForm', function (e) {
        e.preventDefault();
        let locations = $('#location').attr('data-id');
        let formData = new FormData(this);
        formData.append('location', locations === undefined ? '' : locations);

        $.ajax({
            url: "/insert/store",
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
                    $('#AddStoreForm')[0].reset();
                    $('#name').focus();
                    $('#search').val('');
                    $('.store').load(location.href + ' .store');
                    toastr.success('Store Added Successfully', 'Added!');
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



    ///////////// ------------------ Edit Store Ajax Part Start ---------------- /////////////////////////////
    $(document).on('click', '.editStore', function () {
        let modalId = $(this).data('modal-id');
        let id = $(this).data('id');
        $.ajax({
            url: `/edit/store`,
            method: 'GET',
            data: { id:id },
            success: function (res) {
                $('#id').val(res.store.id);
                $('#update_store_name').val(res.store.store_name);

                // Create options dynamically
                $('#update_division').empty();
                $('#update_division').append(`<option value="Dhaka" ${res.store.division === 'Dhaka' ? 'selected' : ''}>Dhaka</option>
                                         <option value="Mymensingh" ${res.store.division === 'Mymensingh' ? 'selected' : ''}>Mymensingh</option>
                                         <option value="Sylhet" ${res.store.division === 'Sylhet' ? 'selected' : ''}>Sylhet</option>
                                         <option value="Chattogram" ${res.store.division === 'Chattogram' ? 'selected' : ''}>Chattogram</option>
                                         <option value="Barishal" ${res.store.division === 'Barishal' ? 'selected' : ''}>Barishal</option>
                                         <option value="Khulna" ${res.store.division === 'Khulna' ? 'selected' : ''}>Khulna</option>
                                         <option value="Rajshahi" ${res.store.division === 'Rajshahi' ? 'selected' : ''}>Rajshahi</option>
                                         <option value="Rangpur" ${res.store.division === 'Rangpur' ? 'selected' : ''}>Rangpur</option>`);

                $('#updateLocation').val(res.store.location.upazila);
                $('#updateLocation').attr('data-id',res.store.location_id);

                var modal = document.getElementById(modalId);
                modal.style.display = 'block';
            },
            error: function (err) {
                console.log(err);
            }
        });
    });



    /////////////// ------------------ Update Store Ajax Part Start ---------------- /////////////////////////////
    $(document).on('submit', '#EditStoreForm', function (e) {
        e.preventDefault();
        let locations = $('#updateLocation').attr('data-id');
        let formData = new FormData(this);
        formData.append('location',locations);
        $.ajax({
            url: `/update/store`,
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
                    $('#editStore').hide();
                    $('#EditStoreForm')[0].reset();
                    $('#search').val('');
                    $('.store').load(location.href + ' .store');
                    toastr.success('Store Updated Successfully', 'Updated!');
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
    // Store Delete Button Functionality
    $(document).on('click', '#delete', function (e) {
        e.preventDefault();
        $('#deleteStoreModal').show();
        let id = $(this).data('id');
        $('#confirm').attr('data-id',id);
        $('#cancel').focus();
    });

    // Cancel Button Functionality
    $(document).on('click', '#cancel', function (e) {
        e.preventDefault();
        $('#deleteStoreModal').hide();
    });

    // Confirm Button Functionality
    $(document).on('click', '#confirm', function (e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        $.ajax({
            url: `/store/delete`,
            method: 'DELETE',
            data: { id:id },
            success: function (res) {
                if (res.status == "success") {
                    $('.store').load(location.href + ' .store');
                    $('#search').val('');
                    $('#deleteStoreModal').hide();
                    toastr.success('Store Deleted Successfully', 'Deleted!');
                }
            }
        });
    });



    /////////////// ------------------ Pagination Ajax Part Start ---------------- /////////////////////////////
    $(document).on('click', '.paginate a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        loadEmployeeData(`/store/pagination?page=${page}`, {}, '.store');
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
            loadEmployeeData(`/search/page/store`, {search:search}, '.store')
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
            loadEmployeeData(`/search/page/store?page=${page}`, {search:search}, '.store');
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