$(document).ready(function () {
    $(document).on('click', '.add', function (e) {
        $('#type').focus();
    });


    // Show Bank Details on Details Modal
    $(document).on('click', '.showBankDetails', function (e) {
        let modal = $(this).attr('data-modal-id');
        let id = $(this).attr('data-id');
        $.ajax({
            url: "/bank/details",
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




    // Show Bank Details List Toggle Functionality
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


    /////////////// ------------------ Add Bank Ajax Part Start ---------------- /////////////////////////////
    $(document).on('submit', '#AddBankForm', function (e) {
        e.preventDefault();
        let locations = $('#location').attr('data-id');
        let formData = new FormData(this);
        formData.append('location', locations === undefined ? '' : locations);
        $.ajax({
            url: "/insert/banks",
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
                    $('#AddBankForm')[0].reset();
                    $('#location').removeAttr('data-id');
                    $('#name').focus();
                    $('.bank').load(location.href + ' .bank');
                    $('#search').val('');
                    toastr.success('Bank Added Successfully', 'Added!');
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



    ///////////// ------------------ Edit Bank Ajax Part Start ---------------- /////////////////////////////
    $(document).on('click', '.editBankModal', function () {
        let modalId = $(this).data('modal-id');
        let id = $(this).data('id');
        $.ajax({
            url: `/edit/banks`,
            method: 'GET',
            data: { id:id },
            success: function (res) {
                $('#id').val(res.bank.id);

                $('#updateType').empty();
                $('#updateType').empty();
                $.each(res.tranwith, function (key, withs) {
                    $('#updateType').append(`<option value="${withs.id}" ${res.bank.tran_user_type === withs.id ? 'selected' : ''}>${withs.tran_with_name}</option>`);
                });

                $('#updateType').focus();

                $('#updateName').val(res.bank.user_name);
                $('#updatePhone').val(res.bank.user_phone);
                $('#updateEmail').val(res.bank.user_email);

                // Create options dynamically based on the status value
                $('#updateGender').empty();
                $('#updateGender').append(`<option value="male" ${res.bank.gender === 'male' ? 'selected' : ''}>Male</option>
                                         <option value="female" ${res.bank.gender === 'female' ? 'selected' : ''}>Female</option>
                                         <option value="others" ${res.bank.gender === 'others' ? 'selected' : ''}>Others</option>`);

                $('#updateLocation').val(res.bank.location.upazila);
                $('#updateLocation').attr('data-id',res.bank.loc_id);
                $('#updateAddress').val(res.bank.address);

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



    /////////////// ------------------ Update Bank Ajax Part Start ---------------- /////////////////////////////
    $(document).on('submit', '#EditBankForm', function (e) {
        e.preventDefault();
        let locations = $('#updateLocation').attr('data-id');
        let formData = new FormData(this);
        formData.append('location', locations === undefined ? '' : locations);
        $.ajax({
            url: `/update/banks`,
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
                    $('#editBankModal').hide();
                    $('#EditBankForm')[0].reset();
                    $('#search').val('');
                    $('.bank').load(location.href + ' .bank');
                    toastr.success('Bank Updated Successfully', 'Updated!');
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



    /////////////// ------------------ Delete Bank Ajax Part Start ---------------- /////////////////////////////
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
            url: `/delete/banks`,
            method: 'DELETE',
            data:{ id:id },
            success: function (res) {
                if (res.status == "success") {
                    $('.bank').load(location.href + ' .bank');
                    $('#search').val('');
                    $('#deleteModal').hide();
                    toastr.success('Bank Deleted Successfully', 'Deleted!');
                }
            }
        });
    });
    
    /////////////// ------------------ Delete Bank Ajax Part End ---------------- /////////////////////////////
    




    /////////////// ------------------ Pagination Ajax Part Start ---------------- /////////////////////////////
    $(document).on('click', '.paginate a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        loadBankData( `/bank/pagination?page=${page}`, {}, '.bank');
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
            loadBankData(`/search/bank/name`, {search:search}, '.bank');
        }
        else if(searchOption == '2'){
            loadBankData(`/search/bank/email`, {search:search}, '.bank')
        }
        else if(searchOption == '3'){
            loadBankData(`/search/bank/contact`, {search:search}, '.bank')
        }
        else if(searchOption == '4'){
            loadBankData(`/search/bank/location`, {search:search}, '.bank')
        }
        else if(searchOption == '5'){
            loadBankData(`/search/bank/address`, {search:search}, '.bank')
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
            loadBankData(`/bank/name/pagination?page=${page}`, {search:search}, '.bank');
        }
        else if(searchOption == '2'){
            loadBankData(`/bank/email/pagination?page=${page}`, {search:search}, '.bank')
        }
        else if(searchOption == '3'){
            loadBankData(`/bank/contact/pagination?page=${page}`, {search:search}, '.bank')
        }
        else if(searchOption == '4'){
            loadBankData(`/bank/location/pagination?page=${page}`, {search:search}, '.bank')
        }
        else if(searchOption == '5'){
            loadBankData(`/bank/address/pagination?page=${page}`, {search:search}, '.bank')
        }
    });



    // Bank Data Load Function
    function loadBankData(url, data, targetElement) {
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