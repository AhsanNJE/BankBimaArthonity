$(document).ready(function () {
    // Get Last Transaction Id By Transaction Method and Type
    $(document).on('click', '.add', function (e) {
        let type = '1';
        let method = 'Payment';
        $('#with').focus();
        getTransactionId(type, method, '#tranId');
        getTransactionWith(type, method, '#within')
    });


    // Show Transaction Print Details 
    $(document).on('click','#details', function(e){
        let modalId = $(this).data('modal-id');
        let id = $(this).data('id');
        $.ajax({
            url: `/transaction/print`,
            method: 'GET',
            data: { id:id },
            success: function (res) {
                $('.print-details').html(res.data);

                var modal = document.getElementById(modalId);
                modal.style.display = 'block';
            },
            error: function (err) {
                console.log(err);
            }
        });
    });

    // Print Transaction Details 
    $(document).on('click','#print', function(){
        var printContent = document.getElementById("print-part").innerHTML;
        var originalContent = document.body.innerHTML;
        document.body.innerHTML = printContent;
        window.print();
        document.body.innerHTML = originalContent;
    });


    // Search by Date Range
    $(document).on('change', '#startDate, #endDate', function(e){
        e.preventDefault();
        let type = '1';
        let method = 'Payment';
        let startDate = $('#startDate').val();
        let endDate = $('#endDate').val();
        searchTransaction(`/transaction/search/date`, { startDate:startDate, endDate:endDate, method:method, type:type}, '.transaction-payment')
    });
    
    
    
    $(document).on('keyup', '#quantity, #amount', function (e) {
        let quantity = $('#quantity').val();
        let amount = $('#amount').val();
        let totalAmount = quantity * amount;
        $('#totAmount').val(totalAmount);
    });
    
    
    $(document).on('keyup', '#updateQuantity, #updateAmount', function (e) {
        let quantity = $('#updateQuantity').val();
        let amount = $('#updateAmount').val();
        let totalAmount = quantity * amount;
        $('#updateTotAmount').val(totalAmount);
    });


    $(document).on('keyup', '#totalDiscount, #advance', function (e) {
        // Calculate total discount
        let amountRP = parseInt($('#amountRP').val());
        let totalDiscount = parseInt($('#totalDiscount').val());
        let advance = parseInt($('#advance').val());

        let netAmount = amountRP - totalDiscount;
        let balance = netAmount - advance;

        $('#netAmount').val(netAmount);
        $('#balance').val(balance);
    });


    $(document).on('keyup', '#updateTotalDiscount, #updateAdvance', function (e) {
        // Calculate total discount
        let amountRP = parseInt($('#updateAmountRP').val());
        let totalDiscount = parseInt($('#updateTotalDiscount').val());
        let advance = parseInt($('#updateAdvance').val());

        let netAmount = amountRP - totalDiscount;
        let balance = netAmount - advance;

        $('#updateNetAmount').val(netAmount);
        $('#updateBalance').val(balance);
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

    ///////////// ------------------ Add Transaction Payment Details ajax part start ---------------- /////////////////////////////
    $(document).on('submit', '#AddTransactionPaymentForm', function (e) {
        e.preventDefault();
        let tranId = $('#tranId').val();
        let withs = $('#user').attr('data-with');
        let user = $('#user').attr('data-id');
        let locations = $('#location').attr('data-id');
        let head = $('#head').attr('data-id');
        let groupe = $('#head').attr('data-groupe');
        let formData = new FormData(this);
        formData.append('with', withs === undefined ? '' : withs);
        formData.append('user', user === undefined ? '' : user);
        formData.append('head', head === undefined ? '' : head);
        formData.append('groupe', groupe === undefined ? '' : groupe);
        formData.append('location', locations === undefined ? '' : locations);
        formData.append('method', 'Payment');
        formData.append('type', '1');
        $.ajax({
            url: "/transaction/insert/details",
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
                    getTransactionGrid(tranId, '.transaction_grid tbody', '#amountRP','#totalDiscount', '#netAmount', '#advance', '#balance' );
                    $('#head').val('');
                    $('#head').removeAttr('data-id');
                    $('#head').removeAttr('data-groupe');
                    $('#quantity').val('1');
                    $('#amount').val('');
                    $('#totAmount').val('');
                    $("#head").focus();
                    toastr.success('Transaction Added Successfully', 'Added!');
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


    ///////////// ------------------ Add Transaction Payment Main ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#InsertMainTransaction', function (e) {
        e.preventDefault();
        let tranId = $('#tranId').val();
        let method = 'Payment';
        let type = '1';
        let invoice = $('#invoice').val();
        let withs = $('#user').attr('data-with');
        let user = $('#user').attr('data-id');
        let locations = $('#location').attr('data-id');
        let amountRP = $('#amountRP').val();
        let discount = $('#totalDiscount').val();
        let netAmount = $('#netAmount').val();
        let advance = $('#advance').val();
        let balance = $('#balance').val();
        $.ajax({
            url: "/transaction/insert/main",
            method: 'POST',
            data: { tranId:tranId, type:type, method:method, invoice:invoice, withs:withs, user:user, locations:locations, amountRP:amountRP,discount:discount, netAmount:netAmount, advance:advance, balance:balance },
            beforeSend: function () {
                $(document).find('span.error').text('');
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#AddTransactionPaymentForm')[0].reset();
                    $('#location').removeAttr('data-id');
                    $('#user').removeAttr('data-id');
                    $('#user').removeAttr('data-with');
                    $('.transaction_grid tbody').html('');
                    $('.transaction-payment').load(location.href + ' .transaction-payment');
                    $('#addTransactionPayment').hide();
                    toastr.success('Transaction Added To Main TableSuccessfully', 'Added!');
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
    $(document).on('click', '.editTransaction', function () {
        let modalId = $(this).data('modal-id');
        let id = $(this).data('id');
        let type = '1';
        let method = 'Payment';
        getTransactionWith(type, method, '#updatewithin')
        $.ajax({
            url: `/transaction/edit/main`,
            method: 'GET',
            data: { id:id },
            success: function (res) {
                
                $('#id').val(res.transaction.id);
                
                $('#updateTranId').val(res.transaction.tran_id);

                var timestamps = new Date(res.transaction.tran_date);
                var formattedDate = timestamps.toLocaleDateString('en-US', { timeZone: 'UTC' });
                $('#updateDate').val(formattedDate);
                // $('#updateInvoice').val(res.transaction.invoice);
                $('#updateLocation').val(res.transaction.location.upazila);
                $('#updateLocation').attr('data-id', res.transaction.loc_id);
                
                $('#updateUser').attr('data-id',res.transaction.tran_user);
                $('#updateUser').attr('data-with',res.transaction.tran_type_with);
                $('#updateUser').val(res.transaction.user.user_name);

                $('#updateTotalDiscount').val(res.transaction.discount);
                if(res.transaction.receive == null){
                    $('#updateAdvance').val(res.transaction.payment);
                }
                else{
                    $('#updateAdvance').val(res.transaction.receive);
                }
                getTransactionGrid(res.transaction.tran_id, '.update_transaction_grid tbody', '#updateAmountRP', '#updateTotalDiscount', '#updateNetAmount', '#updateAdvance', '#updateBalance');

                // $('#updateAmountRP').val(res.transaction.bill_amount);

                // $('#updateNetAmount').val(res.transaction.net_amount);

                // $('#updateBalance').val(res.transaction.due);
                
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




    ///////////// ------------------ Edit Transaction Details ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.editDetail', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        $.ajax({
            url: "/transaction/edit/details",
            method: 'GET',
            data: { id:id },
            success: function (res) {
                $('#dId').val(res.transaction.id);

                
                $('#updateHead').attr('data-groupe', res.transaction.tran_groupe_id);
                $('#updateHead').attr('data-id', res.transaction.tran_head_id);
                $('#updateHead').val(res.transaction.head.tran_head_name);
                

                $('#updateQuantity').val(res.transaction.quantity);
                $('#updateAmount').val(res.transaction.amount);
                $('#updateTotAmount').val(res.transaction.tot_amount);
            },
            error: function (err) {
                console.log(err)
            }
        });
    });




    /////////////// ------------------ Update Transaction Details ajax part start ---------------- /////////////////////////////
    $(document).on('submit', '#EditTransactionPaymentForm', function (e) {
        e.preventDefault();
        let tranId = $('#updateTranId').val();
        let user = $('#updateUser').attr('data-id');
        let withs = $('#updateUser').attr('data-with');
        let locations = $('#updateLocation').attr('data-id');
        let groupe = $('#updateHead').attr('data-groupe');
        let head = $('#updateHead').attr('data-id');
        let formData = new FormData(this);
        formData.append('user', user === undefined ? '' : user);
        formData.append('location', locations === undefined ? '' : locations);
        formData.append('with', withs === undefined ? '' : withs);
        formData.append('head', head === undefined ? '' : head);
        formData.append('groupe', groupe === undefined ? '' : groupe);
        formData.append('type', "1");
        formData.append('method', "Payment");
        $.ajax({
            url: `/transaction/update/details`,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend:function() {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    getTransactionGrid(tranId, '.update_transaction_grid tbody', '#updateAmountRP', '#updateTotalDiscount', '#updateNetAmount', '#updateAdvance', '#updateBalance' );
                    $('#dId').val('');
                    $('#updateHead').val('');
                    $('#updateHead').removeAttr('data-id');
                    $('#updateHead').removeAttr('data-groupe');
                    $('#updateQuantity').val('1');
                    $('#updateAmount').val('');
                    $('#updateTotAmount').val('');
                    $('#updateExpiry').val('');
                    toastr.success('Transaction Details Updated Successfully', 'Updated!');
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



    /////////////// ------------------ Update Transaction Payment Main ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#UpdateMainTransaction', function (e) {
        e.preventDefault();
        let id = $('#id').val();
        let method = 'Payment';
        let amountRP = $('#updateAmountRP').val();
        let totalDiscount = $('#updateTotalDiscount').val();
        let netAmount = $('#updateNetAmount').val();
        let advance = $('#updateAdvance').val();
        let balance = $('#updateBalance').val();
        $.ajax({
            url: `/transaction/update/main`,
            method: 'PUT',
            data: { id:id, method:method, amountRP:amountRP, totalDiscount:totalDiscount, netAmount:netAmount, advance:advance, balance:balance },
            beforeSend:function() {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('.transaction-payment').load(location.href + ' .transaction-payment');
                    $('#editTransaction').hide();
                    toastr.success('Transaction Main Updated Successfully', 'Updated!');
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



    /////////////// ------------------ Delete Transaction Details ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.deleteDetail', function (e) {
        e.preventDefault();
        let tranId = $('#tranId').val();
        let updateTranId = $('#updateTranId').val();
        let id = $(this).data('id');
        if (confirm('Are You Sure to Delete This Transaction ??')) {
            $.ajax({
                url: `/transaction/delete/details`,
                method: 'DELETE',
                data: { id:id },
                success: function (res) {
                    if (res.status == "success") {
                        if(updateTranId != ""){
                            getTransactionGrid(updateTranId, '.update_transaction_grid tbody', '#updateAmountRP', '#updateTotalDiscount', '#updateNetAmount', '#updateAdvance', '#updateBalance' );
                        }
                        else if(tranId != ""){
                            getTransactionGrid(tranId, '.transaction_grid tbody', '#amountRP','#totalDiscount', '#netAmount', '#advance', '#balance' );
                        }
                        toastr.success('Transaction Details Deleted Successfully', 'Deleted!');
                    }
                }
            });
        }
    });



    /////////////// ------------------ Delete Transaction Main Ajax Part Start ---------------- /////////////////////////////
    // Delete Button Functionality
    $(document).on('click', '.deleteMain', function (e) {
        e.preventDefault();
        $('#deleteModal').show();
        let id = $(this).attr('data-id');
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
            url: `/transaction/delete/main`,
            method: 'DELETE',
            data: { id:id },
            success: function (res) {
                if (res.status == "success") {
                    $('.transaction-payment').load(location.href + ' .transaction-payment');
                    $('#search').val('');
                    $('#deleteModal').hide();
                    toastr.success('Transaction Main Data Deleted Successfully', 'Deleted!');
                }
            }
        });
    });
    
    
    /////////////// ------------------ Delete Transaction With Ajax Part End ---------------- /////////////////////////////





    /////////////// ------------------ Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.paginate a', function (e) {
        e.preventDefault();
        let type = '1';
        let method = 'Payment';
        let startDate = $('#startDate').val();
        let endDate = $('#endDate').val();
        let page = $(this).attr('href').split('page=')[1];
        searchTransaction(`/transaction/pagination?page=${page}`, {search:search, startDate:startDate, endDate:endDate, method:method, type:type}, '.transaction-payment');
    });


    /////////////// ------------------ Search ajax part start ---------------- /////////////////////////////
    $(document).on('keyup', '#search', function (e) {
        e.preventDefault();
        let startDate = $('#startDate').val();
        let endDate = $('#endDate').val();
        let search = $(this).val();
        let type = '1';
        let method = 'Payment';
        let searchOption = $("#searchOption").val();
        if(searchOption == "1"){
            searchTransaction(`/transaction/search/tranid`, {search:search, startDate:startDate, endDate:endDate, method:method, type:type}, '.transaction-payment')
        }
        if(searchOption == "2"){
            searchTransaction(`/transaction/search/user`, {search:search, startDate:startDate, endDate:endDate, method:method, type:type}, '.transaction-payment')
        }
    });



    /////////////// ------------------ Search Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.search-paginate a', function (e) {
        e.preventDefault();
        $('.paginate').addClass('hidden');
        let startDate = $('#startDate').val();
        let endDate = $('#endDate').val();
        let search = $('#search').val();
        let type = '1';
        let method = 'Payment';
        let searchOption = $("#searchOption").val();
        let page = $(this).attr('href').split('page=')[1];
        if(searchOption == "1"){
            searchTransaction(`/transaction/pagination/tranid?page=${page}`, {search:search, startDate:startDate, endDate:endDate, method:method, type:type}, '.transaction-payment')
        }
        if(searchOption == "2"){
            searchTransaction(`/transaction/pagination/user?page=${page}`, {search:search, startDate:startDate, endDate:endDate, method:method, type:type}, '.transaction-payment')
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
                    getTransactionGrid(res.tran_id, '.transaction_grid tbody', '#amountRP', '#totalDiscount', '#netAmount', '#advance',  '#balance');
                }
                else{
                    $(targetElement).val(res.tran_id);
                }
                
            }
        });
    }


    //get last transaction with by transaction type function
    function getTransactionWith(type, method, targetElement) {
        $.ajax({
            url: "/transaction/get/tranwith",
            method: 'GET',
            data: { type: type, method:method },
            success: function (res) {
                if (res.status === 'success') {
                    let id = [];
                    $(targetElement).html('');
                    $.each(res.tranwith, function (key, withs) {
                        id.push(withs.id)
                        $(targetElement).append(`<input type="checkbox" id="with[]" class="with-checkbox" name="with" value="${withs.id}" checked>`);
                    });
                    // getTransactionGroupe(id, '#groupein');
                }
            }
        });
    }


    //get transaction groupe by transaction with function
    function getTransactionGroupe(withs, targetElement) {
        $.ajax({
            url: "/transaction/get/groupes/with",
            method: 'GET',
            data: { withs: withs },
            success: function (res) {
                if (res.status === 'success') {
                    $(targetElement).html('');
                    $.each(res.groupes, function (key, groupe) {
                        $(targetElement).append(`<input type="checkbox" id="groupe[]" class="groupe-checkbox" name="groupe" value="${groupe.groupe_id}" checked>`);
                    });
                }
            }
        });
    }


    //Get Inserted Transacetion Grid By Transaction Id Function
    function getTransactionGrid(tranId, grid, amount="", discount="", total ="", advances="", balances= "" ) {
        $.ajax({
            url: "/transaction/get/transactiongrid",
            method: 'GET',
            data: {tranId:tranId},
            success: function (res) {
                if(res.status === 'success'){
                    $(grid).html(res.data);
                    
                    let transactions = res.transaction.data;
                    // Calculate total amount
                    let totalAmount = transactions.reduce((sum, transaction) => sum + transaction.tot_amount, 0);
                    $(amount).val(totalAmount);

                    let totalDiscount = parseInt($(discount).val());
                    let advance = parseInt($(advances).val());

                    let netAmount = totalAmount - totalDiscount;
                    let balance = netAmount - advance;
                    $(total).val(netAmount);
                    $(balances).val(balance);
                }
                else{
                    $(grid).html('');
                }
                
            }
        });
    };



    // Search Transaction Receive Details
    function searchTransaction(url, data, targetElement) {
        $.ajax({
            url: url,
            method: 'GET',
            data: data,
            success: function (res) {
                if(res.status === 'success'){
                    console.log(res.data)
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