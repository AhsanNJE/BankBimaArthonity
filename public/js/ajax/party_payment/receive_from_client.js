$(document).ready(function () {
    //get last transaction id by transaction type
    $(document).on('click', '.add', function (e) {
        let type = '2';
        let method = 'Receive';
        let user = 'Client';
        $('#with').focus();
        getTransactionId(type, method, '#tranId');
        getTransactionWith(null, method, user, '#with');
    });
    
    
    
    $(document).on('keyup', '#amount', function (e) {
        let amount = $('#amount').val();
        $('#totAmount').val(amount);
    });
    
    
    $(document).on('keyup', '#updateAmount', function (e) {
        let amount = $('#updateAmount').val();
        $('#updateTotAmount').val(amount);
    });


    $(document).on('submit', '#AddPartyForm', function (e) {
        e.preventDefault();
        let user = $('#user').attr('data-id');
        let locations = $('#location').attr('data-id');
        let formData = new FormData(this);
        formData.append('user', user === undefined ? '' : user);
        formData.append('location', locations === undefined ? '' : locations);
        formData.append('groupe', 2);
        formData.append('head', 1);
        formData.append('type', "2");
        formData.append('method', "Receive");
        $.ajax({
            url: "/party/insert/party",
            method: 'POST',
            processData: false,
            contentType: false,
            cache: false,
            data: formData,
            beforeSend: function () {
                $(document).find('span.error').text('');
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#AddPartyForm')[0].reset();
                    $('#location').removeAttr('data-id');
                    $('#user').removeAttr('data-id');
                    $('.party').load(location.href + ' .party');
                    $('.due-grid tbody').html('');
                    $('#addTransaction').hide();
                    toastr.success('Party Payment Added Successfully', 'Added!');
                }
            },
            error: function (err) {
                let error = err.responseJSON;
                $.each(error.errors, function (key, value) {
                    $('#' + key + "_error").text(value);
                });
            }
        });
    });



    ///////////// ------------------ Edit Transaction Main ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.editParty', function () {
        let modalId = $(this).data('modal-id');
        let id = $(this).data('id');
        $.ajax({
            url: `/party/edit/party`,
            method: 'GET',
            data: { id:id },
            success: function (res) {
                
                $('#id').val(res.party.id);

                $('#updateTranId').val(res.party.tran_id);
                $('#updateLocation').val(res.party.location.upazila);
                $('#updateLocation').attr('data-id', res.party.loc_id);


                $('#updateWith').empty();
                $('#updateWith').append(`<option value="" disabled>Select Transaction With</option>
                <option value="newspaper client" ${res.transaction.tran_type_with === 'newspaper client' ? 'selected' : 'disabled'}>Newpaper Client</option>
                <option value="advertisement client" ${res.transaction.tran_type_with === 'advertisement client' ? 'selected' : 'disabled'}>Advertisement Client</option>
                <option value="magazine client" ${res.transaction.tran_type_with === 'magazine client' ? 'selected' : 'disabled'}>Magazine Client</option>`);

                $('#updateUser').attr('data-id',res.party.tran_user);
                $('#updateUser').val(res.party.user.user_name);
                $('#updateAmount').val(res.party.amount);
                $('#updateTotAmount').val(res.party.tot_amount);
                
                
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



    /////////////// ------------------ Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.paginate a', function (e) {
        e.preventDefault();
        let type = "receive";
        let startDate = $('#startDate').val();
        let endDate = $('#endDate').val();
        let page = $(this).attr('href').split('page=')[1];
        searchPartyPayment(`/party/pagination?page=${page}`, {startDate:startDate, endDate:endDate, type:type});
    });



    /////////////// ------------------ Search ajax part start ---------------- /////////////////////////////
    $(document).on('keyup', '#search', function (e) {
        e.preventDefault();
        let startDate = $('#startDate').val();
        let endDate = $('#endDate').val();
        let search = $(this).val();
        let type = "receive";
        let searchOption = $("#searchOption").val();
        if(searchOption == "1"){
            searchPartyPayment(`/party/search/tranid`, {search:search, startDate:startDate, endDate:endDate, type:type})
        }
        if(searchOption == "2"){
            searchPartyPayment(`/party/search/with`, {search:search, startDate:startDate, endDate:endDate, type:type})
        }
        if(searchOption == "3"){
            searchPartyPayment(`/party/search/user`, {search:search, startDate:startDate, endDate:endDate, type:type})
        }
    });






    /////////////// ------------------ Search Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.search-paginate a', function (e) {
        e.preventDefault();
        $('.paginate').addClass('hidden');
        let startDate = $('#startDate').val();
        let endDate = $('#endDate').val();
        let search = $('#search').val();
        let type = "receive";
        let searchOption = $("#searchOption").val();
        let page = $(this).attr('href').split('page=')[1];
        if(searchOption == "1"){
            searchPartyPayment(`/party/pagination/tranid?page=${page}`, {search:search, startDate:startDate, endDate:endDate, type:type})
        }
        if(searchOption == "2"){
            searchPartyPayment(`/party/pagination/with?page=${page}`, {search:search, startDate:startDate, endDate:endDate, type:type})
        }
        if(searchOption == "3"){
            searchPartyPayment(`/party/pagination/user?page=${page}`, {search:search, startDate:startDate, endDate:endDate, type:type})
        }
    });



    //Get Last Transaction Id By Transaction Method And Type function
    function getTransactionId(type, method, targetElement) {
        $.ajax({
            url: "/transaction/get/tranid",
            method: 'GET',
            data: {method:method, type:type},
            success: function (res) {
                if(res.status === 'success'){
                    $(targetElement).val(res.id);
                    getTransactionGrid(res.tran_id, '.transaction_grid tbody', '#amountRP', '#netAmount', '#balance', '#totalDiscount', '#advance' );
                }
                else{
                    $(targetElement).val(res.tran_id);
                }
                
            }
        });
    }


    //get last transaction with by transaction type function
    function getTransactionWith(type, method, user, targetElement) {
        $.ajax({
            url: "/transaction/get/tranwith",
            method: 'GET',
            data: { type: type, method:method, user:user },
            success: function (res) {
                if (res.status === 'success') {
                    // Create options dynamically
                    $(targetElement).empty();
                    $(targetElement).append(`<option value="" }>Select Transaction With</option>`);
                    $.each(res.tranwith, function (key, withs) {
                        $(targetElement).append(`<option value="${withs.id}"}>${withs.tran_with_name}</option>`);
                    });
                }

            }
        });
    }


    // Search Party Payment Details
    function searchPartyPayment(url, data) {
        $.ajax({
            url: url,
            method: 'GET',
            data: data,
            success: function (res) {
                if(res.status === 'success'){
                    $('.party').html(res.data);
                    if(res.paginate){
                        $('.party').append('<div class="center search-paginate" id="paginate">' + res.paginate + '</div>');
                    }
                }
                else{
                    $('.party').html(`<span class="text-danger">Result not Found </span>`);
                }
            }
        });
    }


});