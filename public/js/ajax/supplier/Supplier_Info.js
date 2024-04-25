$(document).ready(function () {
    $(document).on('click', '.add', function (e) {
        $('#type').focus();
    });



    // Show Supplier Details on Details Modal
    $(document).on('click', '.showSupplierDetails', function (e) {
        let modal = $(this).attr('data-modal-id');
        let id = $(this).attr('data-id');
        $.ajax({
            url: "/supplier/details",
            method: 'GET',
            data: {id:id},
            success: function (res) {
                $("#"+ modal).show();
                $('.details').html(res.data)
            },
            error: function (err) {
                console.log(err)
            }
        });
    });



    // Show Client Details List Toggle Functionality
    $(document).on('click', '.details li', function(e){
        let id = $(this).attr('data-id');
        if(id == 1){
            if($('.general').is(':visible')){
                $('.general').hide()
            }
            else{
                $('.general').show();
            }
        }
        else if(id == 2){
            if($('.contact').is(':visible')){
                $('.contact').hide()
            }
            else{
                $('.contact').show();
            }
        }
        else if(id == 3){
            if($('.address').is(':visible')){
                $('.address').hide()
            }
            else{
                $('.address').show();
            }
        }
        else if(id == 4){
            if($('.transaction').is(':visible')){
                $('.transaction').hide()
            }
            else{
                $('.transaction').show();
            }
        }
        else if(id == 5){
            if($('.others').is(':visible')){
                $('.others').hide()
            }
            else{
                $('.others').show();
            }
        }
    });



    /////////////// ------------------ Add Supplier Ajax Part Start ---------------- /////////////////////////////
    $(document).on('submit', '#AddSupplierForm', function (e) {
        e.preventDefault();
        let locations = $('#location').attr('data-id');
        let formData = new FormData(this);
        formData.append('location', locations === undefined ? '' : locations);
        $.ajax({
            url: "/insert/suppliers",
            method: 'POST',
            processData: false,
            contentType: false,
            cache: false,
            data: formData,
            beforeSend:function() {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#AddSupplierForm')[0].reset();
                    $('#type').focus();
                    $('#location').removeAttr('data-id');
                    $('#search').val('');
                    $('.supplier').load(location.href + ' .supplier');
                    toastr.success('Supplier Added Successfully', 'Added!');
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



    ///////////// ------------------ Edit Supplier Ajax Part Start ---------------- /////////////////////////////
    $(document).on('click', '.editSupplierModal', function () {
        let modalId = $(this).data('modal-id');
        let id = $(this).data('id');
        $.ajax({
            url: `/edit/suppliers`,
            method: 'GET',
            data: { id:id },
            success: function (res) {
                $('#id').val(res.supplier.id);

                $('#updateType').empty();
                $('#updateType').empty();
                $.each(res.tranwith, function (key, withs) {
                    $('#updateType').append(`<option value="${withs.id}" ${res.supplier.tran_user_type === withs.id ? 'selected' : ''}>${withs.tran_with_name}</option>`);
                });
                
                $('#updateType').focus();
                $('#updateName').val(res.supplier.user_name);
                $('#updateEmail').val(res.supplier.user_email);
                $('#updatePhone').val(res.supplier.user_phone);

                $('#updateGender').empty();
                $('#updateGender').append(`<option value="male" ${res.supplier.gender === 'male' ? 'selected' : ''}>Male</option>
                                         <option value="female" ${res.supplier.gender === 'female' ? 'selected' : ''}>Female</option>
                                         <option value="others" ${res.supplier.gender === 'others' ? 'selected' : ''}>Others</option>`);


                $('#updateLocation').val(res.supplier.location.upazila);
                $('#updateLocation').attr('data-id',res.supplier.loc_id);
                $('#updateAddress').val(res.supplier.address);
                
                var modal = document.getElementById(modalId);

                if (modal) {
                    modal.style.display = 'block';
                }
            },
            error: function (err) {
                console.log(err);
            }
        });
    });



    /////////////// ------------------ Update Supplier Ajax Part Start ---------------- /////////////////////////////
    $(document).on('submit', '#EditSupplierForm', function (e) {
        e.preventDefault();
        let locations = $('#updateLocation').attr('data-id');
        let formData = new FormData(this);
        formData.append('location', locations === undefined ? '' : locations);
        $.ajax({
            url: `/update/suppliers`,
            method: 'POST',
            processData: false,
            contentType: false,
            cache: false,
            data:formData,
            beforeSend:function() {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#editSupplierModal').hide();
                    $('#EditSupplierForm')[0].reset();
                    $('#search').val('');
                    $('.supplier').load(location.href + ' .supplier');
                    toastr.success('Supplier Updated Successfully', 'Updated!');
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



    /////////////// ------------------ Delete Supplier Ajax Part Start ---------------- /////////////////////////////
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
            url: `/delete/suppliers`,
            method: 'DELETE',
            data: { id:id },
            success: function (res) {
                if (res.status == "success") {
                    $('.supplier').load(location.href + ' .supplier');
                    $('#search').val('');
                    $('#deleteModal').hide();
                    toastr.success('Supplier Deleted Successfully', 'Deleted!');
                }
            }
        });
    });
    
    
    /////////////// ------------------ Delete Supplier Ajax Part End ---------------- /////////////////////////////
    
    

    

    /////////////// ------------------ Pagination Ajax Part Start ---------------- /////////////////////////////
    $(document).on('click', '.paginate a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        loadSupplierData(`/supplier/pagination?page=${page}`, {}, '.supplier');
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
        if(searchOption == '1'){
            loadSupplierData(`/search/supplier/name`, {search:search}, '.supplier');
        }
        else if(searchOption == '2'){
            loadSupplierData(`/search/supplier/email`, {search:search}, '.supplier')
        }
        else if(searchOption == '3'){
            loadSupplierData(`/search/supplier/phone`, {search:search}, '.supplier')
        }
        else if(searchOption == '4'){
            loadSupplierData(`/search/supplier/location`, {search:search}, '.supplier')
        }
        else if(searchOption == '5'){
            loadSupplierData(`/search/supplier/address`, {search:search}, '.supplier')
        }
        else if(searchOption == '6'){
            loadSupplierData(`/search/supplier/type`, {search:search}, '.supplier')
        }
        
    });



    /////////////// ------------------ Search Pagination Ajax Part Start ---------------- /////////////////////////////
    $(document).on('click', '.search-paginate a', function (e) {
        e.preventDefault();
        $('.paginate').addClass('hidden');
        let search = $('#search').val();
        let page = $(this).attr('href').split('page=')[1];
        let searchOption = $("#searchOption").val();
        if(searchOption == '1'){
            loadSupplierData(`/supplier/name/sagination?page=${page}`, {search:search}, '.supplier');
        }
        else if(searchOption == '2'){
            loadSupplierData(`/supplier/email/pagination?page=${page}`, {search:search}, '.supplier')
        }
        else if(searchOption == '3'){
            loadSupplierData(`/supplier/contact/pagination?page=${page}`, {search:search}, '.supplier')
        }
        else if(searchOption == '4'){
            loadSupplierData(`/supplier/location/pagination?page=${page}`, {search:search}, '.supplier')
        }
        else if(searchOption == '5'){
            loadSupplierData(`/supplier/address/pagination?page=${page}`, {search:search}, '.supplier')
        }
        else if(searchOption == '6'){
            loadSupplierData(`/supplier/type/pagination?page=${page}`, {search:search}, '.supplier')
        }
    });


    
    // Supplier Data Load Function
    function loadSupplierData(url, data, targetElement) {
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