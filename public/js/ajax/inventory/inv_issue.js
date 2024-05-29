$(document).ready(function () {
    // Get Last Transaction Id By Transaction Method and Type
    $(document).on('click', '.add', function (e) {
        let type = '5';
        let method = 'Issue';
        let receive = 'Receive';
        getTransactionId(type, method, '#tranId');
        getTransactionWith(type, receive, '#within');
        $('#user').focus();
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
        let type = '5';
        let method = 'Issue';
        let startDate = $('#startDate').val();
        let endDate = $('#endDate').val();
        searchTransaction(`/inventory/issue/search/date`, { startDate:startDate, endDate:endDate, method:method, type:type}, '.inv-issue')
    });


    $(document).on('keyup', '#quantity, #mrp', function (e) {
        let quantity = $('#quantity').val();
        let mrp = $('#mrp').val();
        let totalAmount = quantity * mrp;
        $('#totAmount').val(totalAmount);
    });



    $(document).on('keyup', '#updateQuantity, #updateAmount', function (e) {
        let quantity = $('#updateQuantity').val();
        let mrp = $('#updateMrp').val();
        let totalAmount = quantity * mrp;
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




    $(document).on('submit', '#AddInventoryIssueForm', function (e) {
        e.preventDefault();
        let tranId = $('#tranId').val();
        let withs = $('#user').attr('data-with');
        let user = $('#user').attr('data-id');
        let store = $('#store').attr('data-id');
        let product = $('#product').attr('data-id');
        let groupe = $('#product').attr('data-groupe');
        let formData = new FormData(this);
        formData.append('with', withs === undefined ? '' : withs);
        formData.append('user', user === undefined ? '' : user);
        formData.append('product', product === undefined ? '' : product);
        formData.append('groupe', groupe === undefined ? '' : groupe);
        formData.append('store', store === undefined ? '' : store);
        formData.append('method', 'Issue');
        formData.append('type', '5');
        $.ajax({
            url: "/inventory/insert/issue",
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
                    $('#product').val('');
                    $('#product').removeAttr('data-id');
                    $('#product').removeAttr('data-groupe');
                    $('#quantity').val('1');
                    $('#mrp').val('');
                    $('#totAmount').val('');
                    $("#head").focus();
                    toastr.success('Inventory Issue Added Successfully', 'Added!');
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



    $(document).on('click', '#InsertMainIssue', function (e) {
        e.preventDefault();
        let tranId = $('#tranId').val();
        let method = 'Issue';
        let type = '5';
        let invoice = $('#invoice').val();
        let withs = $('#user').attr('data-with');
        let user = $('#user').attr('data-id');
        let store = $('#store').attr('data-id');
        let amountRP = $('#amountRP').val();
        let discount = $('#totalDiscount').val();
        let netAmount = $('#netAmount').val();
        let advance = $('#advance').val();
        let balance = $('#balance').val();
        $.ajax({
            url: "/inventory/insert/transaction/main",
            method: 'POST',
            data: { tranId:tranId, type:type, method:method, invoice:invoice, withs:withs, user:user, store:store, amountRP:amountRP,discount:discount, netAmount:netAmount, advance:advance, balance:balance },
            beforeSend: function () {
                $(document).find('span.error').text('');
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#AddInventoryIssueForm')[0].reset();
                    $('#store').removeAttr('data-id');
                    $('#user').removeAttr('data-id');
                    $('#user').removeAttr('data-with');
                    $('.transaction_grid tbody').html('');
                    $('.inv-issue').load(location.href + ' .inv-issue');
                    $('#addInventoryIssue').hide();
                    toastr.success('Inventory Issue Added To Main Table Successfully', 'Added!');
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



    ///////////// ------------------ Edit Inventory Purchase Main ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.editTransaction', function () {
        let modalId = $(this).data('modal-id');
        let id = $(this).data('id');
        let type = '5';
        let method = 'Issue';
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




    ///////////// ------------------ Edit Inventory Purchase Details ajax part start ---------------- /////////////////////////////
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

                $('#updateExpiry').val(res.transaction.expiry_date);
            },
            error: function (err) {
                console.log(err)
            }
        });
    });



    /////////////// ------------------ Update Transaction Details ajax part start ---------------- /////////////////////////////
    $(document).on('submit', '#EditInventoryIssueForm', function (e) {
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
        formData.append('type', "5");
        formData.append('method', "Issue");
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



    /////////////// ------------------ Update Transaction Issue Main ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#UpdateMainTransaction', function (e) {
        e.preventDefault();
        let id = $('#id').val();
        let method = 'Issue';
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
                    $('.inv-issue').load(location.href + ' .inv-issue');
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
        let id = $(this).data('id');
        $.ajax({
            url: `/transaction/delete/main`,
            method: 'DELETE',
            data: { id:id },
            success: function (res) {
                if (res.status == "success") {
                    $('.inv-issue').load(location.href + ' .inv-issue');
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
        let type = '5';
        let method = 'Issue';
        let startDate = $('#startDate').val();
        let endDate = $('#endDate').val();
        let page = $(this).attr('href').split('page=')[1];
        searchTransaction(`/inventory/issue/pagination?page=${page}`, {search:search, startDate:startDate, endDate:endDate, method:method, type:type}, '.inv-issue');
    });


    /////////////// ------------------ Search ajax part start ---------------- /////////////////////////////
    $(document).on('keyup', '#search', function (e) {
        e.preventDefault();
        let startDate = $('#startDate').val();
        let endDate = $('#endDate').val();
        let search = $(this).val();
        let type = '5';
        let method = 'Issue';
        let searchOption = $("#searchOption").val();
        if(searchOption == "1"){
            searchTransaction(`/inventory/issue/search/tranid`, {search:search, startDate:startDate, endDate:endDate, method:method, type:type}, '.inv-issue')
        }
        if(searchOption == "2"){
            searchTransaction(`/inventory/issue/search/user`, {search:search, startDate:startDate, endDate:endDate, method:method, type:type}, '.inv-issue')
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
        let method = 'Issue';
        let searchOption = $("#searchOption").val();
        let page = $(this).attr('href').split('page=')[1];
        if(searchOption == "1"){
            searchTransaction(`/inventory/issue/pagination/tranid?page=${page}`, {search:search, startDate:startDate, endDate:endDate, method:method, type:type}, '.inv-issue')
        }
        if(searchOption == "2"){
            searchTransaction(`/inventory/issue/pagination/user?page=${page}`, {search:search, startDate:startDate, endDate:endDate, method:method, type:type}, '.inv-issue')
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
                    getTransactionGrid(res.tran_id, '.transaction_grid tbody', '#amountRP', '#totalDiscount', '#netAmount', '#advance',  '#balance');
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



    // Search Inventory Issue
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