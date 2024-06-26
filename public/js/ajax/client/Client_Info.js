$(document).ready(function () {
    $(document).on('click', '.add', function (e) {
        $('#type').focus();
    });


    // Show Client Details on Details Modal
    $(document).on('click', '.showClientDetails', function (e) {
        let modal = $(this).attr('data-modal-id');
        let id = $(this).attr('data-id');
        $.ajax({
            url: "/client/details",
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


    /////////////// ------------------ Add Client Ajax Part Start ---------------- /////////////////////////////
    $(document).on('submit', '#AddClientForm', function (e) {
        e.preventDefault();
        let locations = $('#location').attr('data-id');
        let formData = new FormData(this);
        formData.append('location', locations === undefined ? '' : locations);
        $.ajax({
            url: "/insert/clients",
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
                    $('#AddClientForm')[0].reset();
                    $('#location').removeAttr('data-id');
                    $('#type').focus();
                    $('.client').load(location.href + ' .client');
                    $('#search').val('');
                    toastr.success('Client Added Successfully', 'Added!');
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



    ///////////// ------------------ Edit Client Ajax Part Start ---------------- /////////////////////////////
    $(document).on('click', '.editClientModal', function () {
        let modalId = $(this).data('modal-id');
        let id = $(this).data('id');
        $.ajax({
            url: `/edit/clients`,
            method: 'GET',
            data: { id:id },
            success: function (res) {
                $('#id').val(res.client.id);

                $('#updateType').empty();
                $('#updateType').empty();
                $.each(res.tranwith, function (key, withs) {
                    $('#updateType').append(`<option value="${withs.id}" ${res.client.tran_user_type === withs.id ? 'selected' : ''}>${withs.tran_with_name}</option>`);
                });

                $('#updateType').focus();

                $('#updateName').val(res.client.user_name);
                $('#updatePhone').val(res.client.user_phone);
                $('#updateEmail').val(res.client.user_email);

                // Create options dynamically based on the status value
                $('#updateGender').empty();
                $('#updateGender').append(`<option value="male" ${res.client.gender === 'male' ? 'selected' : ''}>Male</option>
                                         <option value="female" ${res.client.gender === 'female' ? 'selected' : ''}>Female</option>
                                         <option value="others" ${res.client.gender === 'others' ? 'selected' : ''}>Others</option>`);

                $('#updateLocation').val(res.client.location.upazila);
                $('#updateLocation').attr('data-id',res.client.loc_id);
                $('#updateAddress').val(res.client.address);

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



    /////////////// ------------------ Update Client Ajax Part Start ---------------- /////////////////////////////
    $(document).on('submit', '#EditClientForm', function (e) {
        e.preventDefault();
        let locations = $('#updateLocation').attr('data-id');
        let formData = new FormData(this);
        formData.append('location', locations === undefined ? '' : locations);
        $.ajax({
            url: `/update/clients`,
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
                    $('#editClientModal').hide();
                    $('#EditClientForm')[0].reset();
                    $('#search').val('');
                    $('.client').load(location.href + ' .client');
                    toastr.success('Client Updated Successfully', 'Updated!');
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



    /////////////// ------------------ Delete Client Ajax Part Start ---------------- /////////////////////////////
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
            url: `/delete/clients`,
            method: 'DELETE',
            data:{ id:id },
            success: function (res) {
                if (res.status == "success") {
                    $('.client').load(location.href + ' .client');
                    $('#search').val('');
                    $('#deleteModal').hide();
                    toastr.success('Client Deleted Successfully', 'Deleted!');
                }
            }
        });
    });
    
    /////////////// ------------------ Delete Client Ajax Part End ---------------- /////////////////////////////
    




    /////////////// ------------------ Pagination Ajax Part Start ---------------- /////////////////////////////
    $(document).on('click', '.paginate a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        loadClientData( `/client/pagination?page=${page}`, {}, '.client');
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
            loadClientData(`/search/client/name`, {search:search}, '.client');
        }
        else if(searchOption == '2'){
            loadClientData(`/search/client/email`, {search:search}, '.client')
        }
        else if(searchOption == '3'){
            loadClientData(`/search/client/contact`, {search:search}, '.client')
        }
        else if(searchOption == '4'){
            loadClientData(`/search/client/location`, {search:search}, '.client')
        }
        else if(searchOption == '5'){
            loadClientData(`/search/client/address`, {search:search}, '.client')
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
            loadClientData(`/client/name/pagination?page=${page}`, {search:search}, '.client');
        }
        else if(searchOption == '2'){
            loadClientData(`/client/email/pagination?page=${page}`, {search:search}, '.client')
        }
        else if(searchOption == '3'){
            loadClientData(`/client/contact/pagination?page=${page}`, {search:search}, '.client')
        }
        else if(searchOption == '4'){
            loadClientData(`/client/location/pagination?page=${page}`, {search:search}, '.client')
        }
        else if(searchOption == '5'){
            loadClientData(`/client/address/pagination?page=${page}`, {search:search}, '.client')
        }
    });



    // Client Data Load Function
    function loadClientData(url, data, targetElement) {
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