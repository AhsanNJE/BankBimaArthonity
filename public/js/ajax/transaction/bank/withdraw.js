$(document).ready(function () {
    // Get Last Transaction Id By Transaction Method and Type
    $(document).on('click', '.add', function (e) {
        let type = '4';
        let method = 'Receive';
        $('#user').focus();
        getTransactionId(type, method, '#tranId');
    });
    

    // Search by Date Range
    $(document).on('change', '#startDate, #endDate', function(e){
        e.preventDefault();
        let type = '4';
        let method = 'Receive';
        let startDate = $('#startDate').val();
        let endDate = $('#endDate').val();
        searchTransaction(`/transaction/search/date`, {startDate:startDate, endDate:endDate, type:type, method:method}, '.withdraw')
    });


    $(document).on('click', '#InsertWithdraw', function (e) {
        e.preventDefault();
        let tranId = $('#tranId').val();
        let method = 'Receive';
        let type = '4';
        let withs = $('#user').attr('data-with');
        let user = $('#user').attr('data-id');
        let locations = $('#location').attr('data-id');
        let amountRP = $('#amount').val();
        let discount = 0;
        let netAmount = $('#amount').val();
        let advance = $('#amount').val();
        let balance = 0;
        $.ajax({
            url: "/transaction/insert/main",
            method: 'POST',
            data: { tranId:tranId, type:type, method:method, withs:withs, user:user, locations:locations, amountRP:amountRP,discount:discount, netAmount:netAmount, advance:advance, balance:balance },
            beforeSend: function () {
                $(document).find('span.error').text('');
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#AddWithdrawForm')[0].reset();
                    $('#location').removeAttr('data-id');
                    $('#user').removeAttr('data-id');
                    $('.withdraw').load(location.href + ' .withdraw');
                    $('#addBankWithdraw').hide();
                    toastr.success('Bank Withdraw Added Successfully', 'Added!');
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



    ///////////// ------------------ Edit Bank Withdraw ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#edit', function () {
        let modalId = $(this).data('modal-id');
        let id = $(this).data('id');
        $.ajax({
            url: `/transaction/edit/main`,
            method: 'GET',
            data: { id:id },
            success: function (res) {
                $('#id').val(res.transaction.id);

                $('#updateTranId').val(res.transaction.tran_id);

                $('#updateLocation').val(res.transaction.location.upazila);
                $('#updateLocation').attr('data-id', res.transaction.loc_id);
                
                $('#updateUser').attr('data-id',res.transaction.tran_user);
                $('#updateUser').attr('data-with',res.transaction.tran_type_with);
                $('#updateUser').val(res.transaction.user.user_name);

                $('#updateAmount').val(res.transaction.bill_amount);
                
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



    /////////////// ------------------ Update Transaction Details ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#UpdateWithdraw', function (e) {
        e.preventDefault();
        let user = $('#updateUser').attr('data-id');
        let id = $('#id').val();
        let withs = $('#updateUser').attr('data-with');
        let locations = $('#updateLocation').attr('data-id');
        let amount = $('#updateAmount').val();
        let method = 'Receive';
        $.ajax({
            url: `/transaction/bank/update`,
            method: 'PUT',
            data: {id:id, user:user, withs:withs, locations:locations, amount:amount, method:method},
            beforeSend:function() {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#editBankTransaction').hide();
                    $('#search').val();
                    $('.withdraw').load(location.href + ' .withdraw');
                    toastr.success('Bank Deposit Updated Successfully', 'Updated!');
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



    /////////////// ------------------ Delete Transaction Main Ajax Part Start ---------------- /////////////////////////////
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
            url: `/transaction/bank/withdraw/delete`,
            method: 'DELETE',
            data: { id:id },
            success: function (res) {
                if (res.status == "success") {
                    $('#search').val('');
                    $('#deleteModal').hide();
                    $('.withdraw').load(location.href + ' .withdraw');
                    toastr.success('Transaction Main Data Deleted Successfully', 'Deleted!');
                }
            }
        });
    });
    
    
    /////////////// ------------------ Delete Transaction With Ajax Part End ---------------- /////////////////////////////



    /////////////// ------------------ Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.paginate a', function (e) {
        e.preventDefault();
        let type = '4';
        let method = 'Receive';
        let startDate = $('#startDate').val();
        let endDate = $('#endDate').val();
        let page = $(this).attr('href').split('page=')[1];
        searchTransaction(`/transaction/pagination?page=${page}`, {startDate:startDate, endDate:endDate, type:type, method:method}, '.withdraw');
    });



    /////////////// ------------------ Search ajax part start ---------------- /////////////////////////////
    $(document).on('keyup', '#search', function (e) {
        e.preventDefault();
        let startDate = $('#startDate').val();
        let endDate = $('#endDate').val();
        let search = $(this).val();
        let type = '4';
        let method = 'Receive';
        let searchOption = $("#searchOption").val();
        if(searchOption == "1"){
            searchTransaction(`/transaction/search/tranid`, {search:search, startDate:startDate, endDate:endDate, type:type, method:method}, '.withdraw')
        }
        if(searchOption == "2"){
            searchTransaction(`/transaction/search/user`, {search:search, startDate:startDate, endDate:endDate, type:type, method:method}, '.withdraw')
        }
    });



    /////////////// ------------------ Search Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.search-paginate a', function (e) {
        e.preventDefault();
        $('.paginate').addClass('hidden');
        let startDate = $('#startDate').val();
        let endDate = $('#endDate').val();
        let search = $('#search').val();
        let type = '4';
        let method = 'Receive';
        let searchOption = $("#searchOption").val();
        let page = $(this).attr('href').split('page=')[1];
        if(searchOption == "1"){
            searchTransaction(`/transaction/pagination/tranid?page=${page}`, {search:search, startDate:startDate, endDate:endDate, type:type, method:method}, '.withdraw')
        }
        if(searchOption == "2"){
            searchTransaction(`/transaction/pagination/user?page=${page}`, {search:search, startDate:startDate, endDate:endDate, type:type, method:method}, '.withdraw')
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
                }
                else{
                    $(targetElement).val(res.tran_id);
                }
                
            }
        });
    }



    // Search Transaction Details
    function searchTransaction(url, data, targetElement) {
        $.ajax({
            url: url,
            method: 'GET',
            data: data,
            success: function (res) {
                if(res.status === 'success'){
                    $(targetElement).html(res.data);
                    if(res.paginate){
                        $(targetElement).append('<div class="center search-paginate" id="paginate">' + res.paginate + '</div>');
                    }
                }
                else{
                    $(targetElement).html(`<span class="text-danger">Result not Found </span>`);
                }
            }
        });
    }


});