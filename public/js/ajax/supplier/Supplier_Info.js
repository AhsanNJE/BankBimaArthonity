$(document).ready(function () {
    $(document).on('click', '.add', function (e) {
        $('#type').focus();
    });



    //Show Supplier Details on details modal
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



    //Show Client Details List toggle Functionality
    $(document).on('click', '.details li', function(e){
        let id = $(this).attr('data-id');
        if(id == 1){
            if($('.general').is(':visible')){
                $('.general').hide()
            }
            else{
                $('.general').show();
                // $('.contact, .address, .transaction, .others').hide();
            }
        }
        else if(id == 2){
            if($('.contact').is(':visible')){
                $('.contact').hide()
            }
            else{
                $('.contact').show();
                // $('.address, .transaction, .others').hide();
            }
        }
        else if(id == 3){
            if($('.address').is(':visible')){
                $('.address').hide()
            }
            else{
                $('.address').show();
                // $('.contact, .transaction, .others').hide();
            }
        }
        else if(id == 4){
            if($('.transaction').is(':visible')){
                $('.transaction').hide()
            }
            else{
                $('.transaction').show();
                // $('.contact, .address, .others').hide();
            }
        }
        else if(id == 5){
            if($('.others').is(':visible')){
                $('.others').hide()
            }
            else{
                $('.others').show();
                // $('.contact, .address, .transaction').hide();
            }
        }
    });



    /////////////// ------------------ Add Supplier ajax part start ---------------- /////////////////////////////
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



    ///////////// ------------------ Edit Supplier ajax part start ---------------- /////////////////////////////
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
                $('#updateType').append(`<option value="food supplier" ${res.supplier.tran_user_type === 'food supplier' ? 'selected' : ''}>Food Supplier</option>
                                         <option value="stationary supplier" ${res.supplier.tran_user_type === 'stationary supplier' ? 'selected' : ''}>Stationary Supplier</option>`);
                $('#updateType').focus();
                $('#updateName').val(res.supplier.user_name);
                $('#updateEmail').val(res.supplier.user_email);
                $('#updatePhone').val(res.supplier.user_phone);
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



    /////////////// ------------------ Update Supplier ajax part start ---------------- /////////////////////////////
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



    /////////////// ------------------ Delete Supplier ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#delete', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        if (confirm('Are You Sure to Delete This Supplier ??')) {
            $.ajax({
                url: `/delete/suppliers`,
                method: 'DELETE',
                data: { id:id },
                success: function (res) {
                    if (res.status == "success") {
                        $('.supplier').load(location.href + ' .supplier');
                        $('#search').val('');
                        toastr.success('Supplier Deleted Successfully', 'Deleted!');
                    }
                }
            });
        }
    });

    

    /////////////// ------------------ Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.paginate a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        loadSupplierData(`/supplier/pagination?page=${page}`, {}, '.supplier');
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
        
    });



    /////////////// ------------------ Search Pagination ajax part start ---------------- /////////////////////////////
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
    });


    
    //supplier pagination data load function
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