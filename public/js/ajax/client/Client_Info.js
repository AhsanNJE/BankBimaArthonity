$(document).ready(function () {
    /////////////// ------------------ Add Client ajax part start ---------------- /////////////////////////////
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



    ///////////// ------------------ Edit Client ajax part start ---------------- /////////////////////////////
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
                $('#updateType').append(`<option value="newspaper client" ${res.client.tran_user_type === 'newspaper client' ? 'selected' : ''}>Newpaper Client</option>
                                         <option value="advertisement client" ${res.client.tran_user_type === 'advertisement client' ? 'selected' : ''}>Advertisement Client</option>
                                         <option value="magazine client" ${res.client.tran_user_type === 'magazine client' ? 'selected' : ''}>Magazine Client</option>
                                         <option value="others" ${res.client.tran_user_type === 'others' ? 'selected' : ''}>Others</option>`);


                $('#updateName').val(res.client.user_name);
                $('#updatePhone').val(res.client.user_phone);
                $('#updateEmail').val(res.client.user_email);

                // Create options dynamically based on the status value
                $('#updateGender').empty();
                $('#updateGender').append(`<option value="male" ${res.client.gender === 'male' ? 'selected' : ''}>Male</option>
                                         <option value="female" ${res.client.gender === 'female' ? 'selected' : ''}>Female</option>
                                         <option value="others" ${res.client.gender === 'others' ? 'selected' : ''}>Others</option>`);

                $('#updateLocation').val(res.client.location.thana);
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



    /////////////// ------------------ Update Client ajax part start ---------------- /////////////////////////////
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



    /////////////// ------------------ Delete Client ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.deleteClient', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        if (confirm('Are You Sure to Delete This Client ??')) {
            $.ajax({
                url: `/delete/clients`,
                method: 'DELETE',
                data:{ id:id },
                success: function (res) {
                    if (res.status == "success") {
                        $('.client').load(location.href + ' .client');
                        $('#search').val('');
                        toastr.success('Client Deleted Successfully', 'Deleted!');
                    }
                }
            });
        }
    });



    /////////////// ------------------ Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.paginate a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        loadClientData( `/client/pagination?page=${page}`, {}, '.client');
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



    /////////////// ------------------ Search Pagination ajax part start ---------------- /////////////////////////////
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



    //Client data load function
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