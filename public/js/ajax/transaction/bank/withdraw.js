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



    // // ///////////// ------------------ Edit Transaction Main ajax part start ---------------- /////////////////////////////
    // // $(document).on('click', '.editTransaction', function () {
    // //     let modalId = $(this).data('modal-id');
    // //     let id = $(this).data('id');
    // //     $.ajax({
    // //         url: `/transaction/edit/main`,
    // //         method: 'GET',
    // //         data: { id:id },
    // //         success: function (res) {
                
    // //             $('#id').val(res.transaction.id);

    // //             $('#updateTranId').val(res.transaction.tran_id);
    // //             $('#updateInvoice').val(res.transaction.invoice);
    // //             $('#updateLocation').val(res.transaction.location.thana);
    // //             $('#updateLocation').attr('data-id', res.transaction.loc_id);


    // //             $('#updateWith').empty();
    // //             $('#updateWith').append(`<option value="" disabled>Select Transaction With</option>`);
    // //             $.each(res.tranwith, function (key, withs) {
    // //                 $('#updateWith').append(`<option value="${withs.id}" ${res.transaction.tran_type_with === withs.id ? 'selected' : 'disabled'}>${withs.tran_with_name}</option>`);
    // //             });
                
    // //             $('#updateUser').attr('data-id',res.transaction.tran_user);
    // //             $('#updateUser').val(res.transaction.user.user_name);

    // //             getTransactionGrid(res.transaction.tran_id, '.update_transaction_grid tbody');

    // //             $('#updateAmountRP').val(res.transaction.bill_amount);
    // //             $('#updateTotalDiscount').val(res.transaction.discount);
    // //             $('#updateNetAmount').val(res.transaction.net_amount);

    // //             if(res.transaction.receive == null){
    // //                 $('#updateAdvance').val(res.transaction.payment);
    // //             }
    // //             else{
    // //                 $('#updateAdvance').val(res.transaction.receive);
    // //             }
                
                
    // //             $('#updateBalance').val(res.transaction.due);
                
    // //             var modal = document.getElementById(modalId);
    // //             if (modal) {
    // //                 modal.style.display = 'block';
    // //             }
    // //         },
    // //         error: function (err) {
    // //             console.log(err);
    // //         }
    // //     });
    // // });




    // // ///////////// ------------------ Edit Transaction Details ajax part start ---------------- /////////////////////////////
    // // $(document).on('click', '#edit', function (e) {
    // //     e.preventDefault();
    // //     let id = $(this).data('id');
    // //     $.ajax({
    // //         url: "/transaction/edit/details",
    // //         method: 'GET',
    // //         data: { id:id },
    // //         success: function (res) {
    // //             $('#dId').val(res.transaction.id);

    // //             $('#updateGroupe').html('');
    // //             $('#updateGroupe').append(`<option value="" >Select Transaction Groupe</option>`);
    // //             $.each(res.groupes, function (key, groupe) {
    // //                 $('#updateGroupe').append(`<option value="${groupe.id}" ${res.transaction.tran_groupe_id === groupe.id ? 'selected' : ''}>${groupe.tran_groupe_name}</option>`);
    // //             });

    // //             $('#updateHead').html('');
    // //             $('#updateHead').append(`<option value="" >Select Transaction Head</option>`);
    // //             $.each(res.heads, function (key, head) {
    // //                 $('#updateHead').append(`<option value="${head.id}" ${res.transaction.tran_head_id === head.id ? 'selected' : ''}>${head.tran_head_name}</option>`);
    // //             });

    // //             $('#updateQuantity').val(res.transaction.quantity);
    // //             $('#updateAmount').val(res.transaction.amount);
    // //             $('#updateTotAmount').val(res.transaction.tot_amount);
    // //         },
    // //         error: function (err) {
    // //             console.log(err)
    // //         }
    // //     });
    // // });




    // // /////////////// ------------------ Update Transaction Details ajax part start ---------------- /////////////////////////////
    // // $(document).on('submit', '#EditTransactionForm', function (e) {
    // //     e.preventDefault();
    // //     let tranId = $('#updateTranId').val();
    // //     let user = $('#updateUser').attr('data-id');
    // //     let locations = $('#updateLocation').attr('data-id');
    // //     let formData = new FormData(this);
    // //     formData.append('user', user === undefined ? '' : user);
    // //     formData.append('location', locations === undefined ? '' : locations);
    // //     formData.append('type', "receive");
    // //     $.ajax({
    // //         url: `/transaction/update/details`,
    // //         method: 'POST',
    // //         data: formData,
    // //         processData: false,
    // //         contentType: false,
    // //         cache: false,
    // //         beforeSend:function() {
    // //             $(document).find('span.error').text('');  
    // //         },
    // //         success: function (res) {
    // //             console.log(res);
    // //             if (res.status == "success") {
    // //                 getTransactionGrid(tranId, '.update_transaction_grid tbody', '#updateAmountRP', '#updateNetAmount', '#updateBalance', '#updateTotalDiscount', '#updateAdvance' );
    // //                 $('#dId').val('');
    // //                 $('#updateGroupe').val('');
    // //                 $('#updateHead').val('');
    // //                 $('#updateQuantity').val('1');
    // //                 $('#updateAmount').val('');
    // //                 $('#updateTotAmount').val('');
    // //                 toastr.success('Transaction Details Updated Successfully', 'Updated!');
    // //             }
    // //         },
    // //         error: function (err) {
    // //             let error = err.responseJSON;
    // //             $.each(error.errors, function (key, value) {
    // //                 $('#update_' + key + "_error").text(value);
    // //             })
    // //         }
    // //     });
    // // });



    // // /////////////// ------------------ Update Transaction Main ajax part start ---------------- /////////////////////////////
    // // $(document).on('click', '#UpdateMainTransaction', function (e) {
    // //     e.preventDefault();
    // //     let id = $('#id').val();
    // //     let type = "receive";
    // //     let amountRP = $('#updateAmountRP').val();
    // //     let totalDiscount = $('#updateTotalDiscount').val();
    // //     let netAmount = $('#updateNetAmount').val();
    // //     let advance = $('#updateAdvance').val();
    // //     let balance = $('#updateBalance').val();
    // //     $.ajax({
    // //         url: `/transaction/update/main`,
    // //         method: 'PUT',
    // //         data: { id:id, type:type, amountRP:amountRP, totalDiscount:totalDiscount, netAmount:netAmount, advance:advance, balance:balance },
    // //         beforeSend:function() {
    // //             $(document).find('span.error').text('');  
    // //         },
    // //         success: function (res) {
    // //             console.log(res);
    // //             if (res.status == "success") {
    // //                 $('.details').load(location.href + ' .details');
    // //                 $('#editTransaction').hide();
    // //                 toastr.success('Transaction Main Updated Successfully', 'Updated!');
    // //             }
    // //         },
    // //         error: function (err) {
    // //             let error = err.responseJSON;
    // //             $.each(error.errors, function (key, value) {
    // //                 $('#update_' + key + "_error").text(value);
    // //             })
    // //         }
    // //     });
    // // });



    // // /////////////// ------------------ Delete Transaction Details ajax part start ---------------- /////////////////////////////
    // // $(document).on('click', '#delete', function (e) {
    // //     e.preventDefault();
    // //     let tranId = $('#tranId').val();
    // //     let updateTranId = $('#updateTranId').val();
    // //     let id = $(this).data('id');
    // //     if (confirm('Are You Sure to Delete This Transaction ??')) {
    // //         $.ajax({
    // //             url: `/transaction/delete/details`,
    // //             method: 'DELETE',
    // //             data: { id:id },
    // //             success: function (res) {
    // //                 if (res.status == "success") {
    // //                     if(updateTranId != ""){
    // //                         getTransactionGrid(updateTranId, '.update_transaction_grid tbody', '#updateAmountRP', '#updateNetAmount', '#updateBalance', '#updateTotalDiscount', '#updateAdvance' );
    // //                     }
    // //                     else if(tranId != ""){
    // //                         getTransactionGrid(tranId, '.transaction_grid tbody', '#amountRP', '#netAmount', '#balance', '#totalDiscount', '#advance' );
    // //                     }
    // //                     $('.details').load(location.href + ' .details');
    // //                     $('#search').val('');
    // //                     toastr.success('Transaction Details Deleted Successfully', 'Deleted!');
    // //                 }
    // //             }
    // //         });
    // //     }
    // // });


    // // /////////////// ------------------ Delete Transaction Main ajax part start ---------------- /////////////////////////////
    // // $(document).on('click', '#deleteMain', function (e) {
    // //     e.preventDefault();
    // //     let id = $(this).data('id');
    // //     if (confirm('Are You Sure to Delete This Transaction ??')) {
    // //         $.ajax({
    // //             url: `/transaction/delete/main`,
    // //             method: 'DELETE',
    // //             data: { id:id },
    // //             success: function (res) {
    // //                 if (res.status == "success") {
    // //                     $('.details').load(location.href + ' .details');
    // //                     $('#search').val('');
    // //                     toastr.success('Transaction Main Data Deleted Successfully', 'Deleted!');
    // //                 }
    // //             }
    // //         });
    // //     }
    // // });


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