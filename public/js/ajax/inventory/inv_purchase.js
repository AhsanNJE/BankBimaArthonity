$(document).ready(function () {
    // Get Last Transaction Id By Transaction Method and Type
    $(document).on('click', '.add', function (e) {
        let type = '5';
        let method = 'Payment';
        $('#user').focus();
        getTransactionId(type, method, '#tranId');
        getTransactionWith(type, method, '#within')
    });


    // Search by Date Range
    $(document).on('change', '#startDate, #endDate', function(e){
        e.preventDefault();
        let type = '5';
        let method = 'Payment';
        let startDate = $('#startDate').val();
        let endDate = $('#endDate').val();
        searchTransaction(`/transaction/search/date`, { startDate:startDate, endDate:endDate, method:method, type:type}, '.inv-purchase')
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



    $(document).on('submit', '#AddInventoryPurchaseForm', function (e) {
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
        formData.append('type', '5');
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
                    getTransactionGrid(tranId, '.transaction_grid tbody', '#amountRP', '#netAmount', '#balance', '#totalDiscount', '#advance' );
                    $('#head').val('');
                    $('#head').removeAttr('data-id');
                    $('#head').removeAttr('data-groupe');
                    $('#quantity').val('1');
                    $('#amount').val('');
                    $('#expiry').val('');
                    $('#totAmount').val('');
                    $("#head").focus();
                    toastr.success('Inventory Purchase Added Successfully', 'Added!');
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



    $(document).on('click', '#InsertMainPurchase', function (e) {
        e.preventDefault();
        let tranId = $('#tranId').val();
        let method = 'Payment';
        let type = '5';
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
                    $('#AddInventoryPurchaseForm')[0].reset();
                    $('#location').removeAttr('data-id');
                    $('#user').removeAttr('data-id');
                    $('#user').removeAttr('data-with');
                    $('.transaction_grid tbody').html('');
                    $('.inv-purchase').load(location.href + ' .inv-purchase');
                    $('#addInventoryPurchase').hide();
                    toastr.success('Inventory Purchase Added To Main TableSuccessfully', 'Added!');
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


    /////////////// ------------------ Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.paginate a', function (e) {
        e.preventDefault();
        let type = '5';
        let method = 'Payment';
        let startDate = $('#startDate').val();
        let endDate = $('#endDate').val();
        let page = $(this).attr('href').split('page=')[1];
        searchTransaction(`/transaction/pagination?page=${page}`, {search:search, startDate:startDate, endDate:endDate, method:method, type:type}, '.inv-purchase');
    });


    /////////////// ------------------ Search ajax part start ---------------- /////////////////////////////
    $(document).on('keyup', '#search', function (e) {
        e.preventDefault();
        let startDate = $('#startDate').val();
        let endDate = $('#endDate').val();
        let search = $(this).val();
        let type = '5';
        let method = 'Payment';
        let searchOption = $("#searchOption").val();
        if(searchOption == "1"){
            searchTransaction(`/transaction/search/tranid`, {search:search, startDate:startDate, endDate:endDate, method:method, type:type}, '.inv-purchase')
        }
        if(searchOption == "2"){
            searchTransaction(`/transaction/search/user`, {search:search, startDate:startDate, endDate:endDate, method:method, type:type}, '.inv-purchase')
        }
    });



    /////////////// ------------------ Search Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.search-paginate a', function (e) {
        e.preventDefault();
        $('.paginate').addClass('hidden');
        let startDate = $('#startDate').val();
        let endDate = $('#endDate').val();
        let search = $('#search').val();
        let type = '5';
        let method = 'Payment';
        let searchOption = $("#searchOption").val();
        let page = $(this).attr('href').split('page=')[1];
        if(searchOption == "1"){
            searchTransaction(`/transaction/pagination/tranid?page=${page}`, {search:search, startDate:startDate, endDate:endDate, method:method, type:type}, '.inv-purchase')
        }
        if(searchOption == "2"){
            searchTransaction(`/transaction/pagination/user?page=${page}`, {search:search, startDate:startDate, endDate:endDate, method:method, type:type}, '.inv-purchase')
        }
        
    });




    //Get Last Transaction Id By Transaction Method And Type function
    function getTransactionId(type, method, targetElement) {
        $.ajax({
            url: "/transaction/get/tranid",
            method: 'GET',
            data: { method: method, type: type },
            success: function (res) {
                if (res.status === 'success') {
                    $(targetElement).val(res.id);
                    getTransactionGrid(res.tran_id, '.transaction_grid tbody', '#amountRP', '#netAmount', '#balance', '#totalDiscount', '#advance');
                }
                else {
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
            data: { type: type, method: method },
            success: function (res) {
                if (res.status === 'success') {
                    let id = [];
                    $(targetElement).html('');
                    $.each(res.tranwith, function (key, withs) {
                        console.log(targetElement)
                        id.push(withs.id)
                        $(targetElement).append(`<input type="checkbox" id="with[]" class="with-checkbox" name="with" value="${withs.id}" checked>`);
                    });
                    // getTransactionGroupe(id, '#groupein');
                }
            }
        });
    }


    //get transaction groupe by transaction with function
    // function getTransactionGroupe(withs, targetElement) {
    //     $.ajax({
    //         url: "/transaction/get/groupes/with",
    //         method: 'GET',
    //         data: { withs: withs },
    //         success: function (res) {
    //             if (res.status === 'success') {
    //                 $(targetElement).html('');
    //                 $.each(res.groupes, function (key, groupe) {
    //                     $(targetElement).append(`<input type="checkbox" id="groupe[]" class="groupe-checkbox" name="groupe" value="${groupe.groupe_id}" checked>`);
    //                 });
    //             }
    //         }
    //     });
    // }


    //Get Inserted Transacetion Grid By Transaction Id Function
    function getTransactionGrid(tranId, grid, amount = "", total = "", balances = "", discount = "", advances = "") {
        $.ajax({
            url: "/transaction/get/transactiongrid",
            method: 'GET',
            data: { tranId: tranId },
            success: function (res) {
                if (res.status === 'success') {
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
                else {
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
                if (res.status === 'success') {
                    console.log(res.data)
                    $(targetElement).html(res.data);
                    if (res.paginate) {
                        $(targetElement).append('<div class="center search-paginate" id="paginate">' + res.paginate + '</div>');
                    }
                }
                else {
                    $(targetElement).html(`<span class="text-danger">Result not Found </span>`);
                }
            }
        });
    }


});