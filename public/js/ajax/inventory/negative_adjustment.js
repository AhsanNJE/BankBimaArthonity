$(document).ready(function () {
    // Get Last Transaction Id By Transaction Method and Type
    $(document).on('click', '.add', function (e) {
        let type = '5';
        let method = 'Negative';
        getTransactionWith(type, method, '#within')
        $('#user').focus();
    });

    // Show Transaction Print Details 
    $(document).on('click','#details', function(e){
        let modalId = $(this).data('modal-id');
        let id = $(this).data('id');
        $.ajax({
            url: `/transaction/print/negative`,
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
        let method = 'Negative';
        let startDate = $('#startDate').val();
        let endDate = $('#endDate').val();
        searchTransaction(`/transaction/search/date`, { startDate:startDate, endDate:endDate, method:method, type:type}, '.transaction-receive')
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


    ///////////// ------------------ Add Transaction Negative Details ajax part start ---------------- /////////////////////////////
    $(document).on('submit', '#AddNegativeAdjustmentForm', function (e) {
        e.preventDefault();
        let store = $('#store').attr('data-id');
        let head = $('#head').attr('data-id');
        let groupe = $('#head').attr('data-groupe');
        let formData = new FormData(this);
        formData.append('head', head === undefined ? '' : head);
        formData.append('groupe', groupe === undefined ? '' : groupe);
        formData.append('store', store === undefined ? '' : store);
        formData.append('method', 'Negative');
        formData.append('type', '5');
        $.ajax({
            url: "/transaction/insert/negative/adjustment",
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
                    $('#store').val('');
                    $('#store').removeAttr('data-id');
                    $('#head').val('');
                    $('#head').removeAttr('data-id');
                    $('#head').removeAttr('data-groupe');
                    $('#quantity').val('5');
                    $("#head").focus();
                    $('.negative').load(location.href + ' .negative');
                    toastr.success('Negative Adjustment Done Successfully', 'Added!');
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




    ///////////// ------------------ Edit Transaction Details ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.editAdjustment', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        $.ajax({
            url: "/transaction/edit/details",
            method: 'GET',
            data: { id:id },
            success: function (res) {
                $('#dId').val(res.transaction.id);

                $('#updateStore').val(res.transaction.store);
                $('#updateHead').attr('data-groupe', res.transaction.tran_groupe_id);
                $('#updateHead').attr('data-id', res.transaction.tran_head_id);
                $('#updateHead').val(res.transaction.head.tran_head_name);
               

                $('#updateQuantity').val(res.transaction.quantity);
        
            },
            error: function (err) {
                console.log(err)
            }
        });
    });




    /////////////// ------------------ Update Transaction Details ajax part start ---------------- /////////////////////////////
    $(document).on('submit', '#EditTransactionNegativeForm', function (e) {
        e.preventDefault();
        let tranId = $('#updateTranId').val();
        let user = $('#updateUser').attr('data-id');
        let withs = $('#updateUser').attr('data-with');
        let store = $('#updateStore').attr('data-id');
        let groupe = $('#updateHead').attr('data-groupe');
        let head = $('#updateHead').attr('data-id');
        let formData = new FormData(this);
        formData.append('user', user === undefined ? '' : user);
        formData.append('store', store === undefined ? '' : store);
        formData.append('with', withs === undefined ? '' : withs);
        formData.append('head', head === undefined ? '' : head);
        formData.append('groupe', groupe === undefined ? '' : groupe);
        formData.append('type', "5");
        formData.append('method', "Negative");
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
                    $('#dId').val('');
                    $('#updateHead').val('');
                    $('#updateHead').removeAttr('data-id');
                    $('#updateHead').removeAttr('data-groupe');
                    $('#updateQuantity').val('5');
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



    /////////////// ------------------ Update Transaction Negative Main ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#UpdateMainTransaction', function (e) {
        e.preventDefault();
        let id = $('#id').val();
        let method = 'Negative';
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
                    $('.transaction-receive').load(location.href + ' .transaction-receive');
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
    $(document).on('click', '.deleteNegativeModal', function (e) {
        e.preventDefault();
        let tranId = $('#tranId').val();
        let updateTranId = $('#updateTranId').val();
        let id = $(this).data('id');
        if (confirm('Are You Sure to Delete This Transaction ??')) {
            $.ajax({
                url: `/transaction/delete/negative`,
                method: 'DELETE',
                data: { id:id },
                success: function (res) {
                    if (res.status == "success") {
                        if(updateTranId != ""){
                        }
                        else if(tranId != ""){
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
                    $('.transaction-receive').load(location.href + ' .transaction-receive');
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
        let method = "Negative";
        let type = "5";
        let startDate = $('#startDate').val();
        let endDate = $('#endDate').val();
        let page = $(this).attr('href').split('page=')[5];
        searchTransaction(`/transaction/pagination?page=${page}`, {startDate:startDate, endDate:endDate, method:method, type:type}, '.transaction-receive');
    });



    /////////////// ------------------ Search ajax part start ---------------- /////////////////////////////
    $(document).on('keyup', '#search', function (e) {
        e.preventDefault();
        let startDate = $('#startDate').val();
        let endDate = $('#endDate').val();
        let search = $(this).val();
        let method = "Negative";
        let type = "5";
        let searchOption = $("#searchOption").val();
        if(searchOption == "5"){
            searchTransaction(`/transaction/search/tranid`, {search:search, startDate:startDate, endDate:endDate, method:method, type:type}, '.transaction-receive')
        }
        if(searchOption == "2"){
            searchTransaction(`/transaction/search/user`, {search:search, startDate:startDate, endDate:endDate, method:method, type:type}, '.transaction-receive')
        }
        
    });



    /////////////// ------------------ Search Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.search-paginate a', function (e) {
        e.preventDefault();
        $('.paginate').addClass('hidden');
        let startDate = $('#startDate').val();
        let endDate = $('#endDate').val();
        let search = $('#search').val();
        let method = "Negative";
        let type = "5";
        let searchOption = $("#searchOption").val();
        let page = $(this).attr('href').split('page=')[5];
        if(searchOption == "5"){
            searchTransaction(`/transaction/pagination/tranid?page=${page}`, {search:search, startDate:startDate, endDate:endDate, method:method, type:type}, '.transaction-receive')
        }
        if(searchOption == "2"){
            searchTransaction(`/transaction/pagination/user?page=${page}`, {search:search, startDate:startDate, endDate:endDate, method:method, type:type}, '.transaction-receive')
        }
        
    });


   



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


    // Search Transaction Negative Details
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