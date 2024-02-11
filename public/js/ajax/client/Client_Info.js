$(document).ready(function () {
    /////////////// ------------------ Add Client ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#addClient', function (e) {
        e.preventDefault();
        let clientName = $('#clientName').val();
        let contact = $('#contact').val();
        let email = $('#email').val();
        let address = $('#address').val();
        $.ajax({
            url: "/insertClients",
            method: 'Post',
            data: { clientName: clientName,contact: contact, email:email, address:address },
            beforeSend:function() {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#addClientModal').hide();
                    $('#AddClientForm')[0].reset();
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
            url: `/editClients/${id}`,
            method: 'get',
            success: function (res) {
                $('#id').val(res.client.id);
                $('#updateClientName').val(res.client.client_name);
                $('#updateContact').val(res.client.client_contact);
                $('#updateEmail').val(res.client.client_email);
                $('#updateAddress').val(res.client.client_address);

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
    $(document).on('click', '#updateClient', function (e) {
        e.preventDefault();
        let id = $('#id').val();;
        let clientName = $('#updateClientName').val();
        let contact = $('#updateContact').val();
        let email = $('#updateEmail').val();
        let address = $('#updateAddress').val();
        $.ajax({
            url: `/updateClients/${id}`,
            method: 'Put',
            data: { clientName: clientName, contact:contact, email:email, address:address },
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
                url: `/deleteClients/${id}`,
                method: 'Delete',
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
            loadClientData(`/searchClient/name`, {search:search}, '.client');
        }
        else if(searchOption == '2'){
            loadClientData(`/searchClient/email`, {search:search}, '.client')
        }
        else if(searchOption == '3'){
            loadClientData(`/searchClient/contact`, {search:search}, '.client')
        }
        else if(searchOption == '4'){
            loadClientData(`/searchClient/address`, {search:search}, '.client')
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
            loadClientData(`/client/namePagination?page=${page}`, {search:search}, '.client');
        }
        else if(searchOption == '2'){
            loadClientData(`/client/emailPagination?page=${page}`, {search:search}, '.client')
        }
        else if(searchOption == '3'){
            loadClientData(`/client/contactPagination?page=${page}`, {search:search}, '.client')
        }
        else if(searchOption == '4'){
            loadClientData(`/client/addressPagination?page=${page}`, {search:search}, '.client')
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