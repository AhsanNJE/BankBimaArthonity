$(document).ready(function () {
    //get last transaction id by transaction type
    $(document).on('click', '.add', function (e) {
        let type = "payment";
        getTransactionId(type, '#tranId');
        getTransactionWith(type, '#with')
    });
    

    // Search by Date Range
    $(document).on('change', '#startDate, #endDate', function(e){
        e.preventDefault();
        let type = "payment";
        let startDate = $('#startDate').val();
        let endDate = $('#endDate').val();
        searchPartyPayment(`/party/search/date`, {startDate:startDate, endDate:endDate, type:type})
    });
    
    
    $(document).on('keyup', '#amount', function (e) {
        let amount = $('#amount').val();
        $('#totAmount').val(amount);
    });
    
    
    $(document).on('keyup', '#updateAmount', function (e) {
        let amount = $('#updateAmount').val();
        $('#updateTotAmount').val(amount);
    });



    $(document).on('change', '#groupe', function (e) {
        let groupe = $('#groupe').val();
        $.ajax({
            url: "/transaction/get/heads/groupe",
            method: 'GET',
            data: { groupe:groupe },
            success: function (res) {
                $('#head').html(res);
            },
            error: function (err) {
                console.log(err)
            }
        });
    });



    $(document).on('change', '#updateGroupe', function (e) {
        let groupe = $('#updateGroupe').val();
        $.ajax({
            url: "/transaction/get/heads/groupe",
            method: 'GET',
            data: { groupe:groupe },
            success: function (res) {
                $('#updateHead').html(res);
            },
            error: function (err) {
                console.log(err)
            }
        });
    });


    $(document).on('submit', '#AddPartyForm', function (e) {
        e.preventDefault();
        let user = $('#user').attr('data-id');
        let locations = $('#location').attr('data-id');
        let formData = new FormData(this);
        formData.append('user', user === undefined ? '' : user);
        formData.append('location', locations === undefined ? '' : locations);
        formData.append('groupe', 4);
        formData.append('head', 15);
        formData.append('type', "payment");
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
                                        <option value="food supplier" ${res.party.tran_type_with === 'food supplier' ? 'selected' : 'disabled'}>Food Supplier</option>
                                        <option value="stationary supplier" ${res.party.tran_type_with === 'stationary supplier' ? 'selected' : 'disabled'}>Stationary Supplier</option>
                                        <option value="newspaper supplier" ${res.party.tran_type_with === 'newspaper supplier' ? 'selected' : 'disabled'}>Newspaper Supplier</option>`);

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
        let type = "payment";
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
        let type = "payment";
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
        let type = "payment";
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



    //get last transaction id by transaction type function
    function getTransactionId(type, targetElement) {
        $.ajax({
            url: "/party/get/tranid",
            method: 'GET',
            data: {type:type},
            success: function (res) {
                if(res.status === 'success'){
                    $(targetElement).val(res.id);
                }
                else{
                    $(targetElement).val(res.tran_id);
                }
                
            }
        });
    }


    //get last transaction with by transaction type function
    function getTransactionWith(type, targetElement) {
        $.ajax({
            url: "/party/get/tranwith",
            method: 'GET',
            data: { type: type },
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