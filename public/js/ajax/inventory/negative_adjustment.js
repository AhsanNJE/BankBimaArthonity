$(document).ready(function () {

    // Get Last Transaction Id By Transaction Method and Type
    $(document).on('click', '.add', function (e) {
        let type = '5';
        let method = 'Negative';
        getTransactionWith(type, method, '#within')
        $('#user').focus();
    });
    

    // Search by Date Range
    $(document).on('change', '#startDate, #endDate', function(e){
        e.preventDefault();
        let type = '5';
        let method = 'Negative';
        let startDate = $('#startDate').val();
        let endDate = $('#endDate').val();
        searchTransaction(`/transaction/search/adjustment/date`, { startDate:startDate, endDate:endDate, method:method, type:type}, '.negative')
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


    ///////////// ------------------ Add Negative Adjustment ajax part start ---------------- /////////////////////////////
    $(document).on('submit', '#AddNegativeAdjustmentForm', function (e) {
        e.preventDefault();
        let store = $('#store').attr('data-id');
        let product = $('#product').attr('data-id');
        let groupe = $('#product').attr('data-groupe');
        let formData = new FormData(this);
        formData.append('product', product === undefined ? '' : product);
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
                    $('#product').val('');
                    $('#product').removeAttr('data-id');
                    $('#product').removeAttr('data-groupe');
                    $('#quantity').val('1');
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
        let modalId = $(this).data('modal-id');
        let id = $(this).data('id');
        $.ajax({
            url: "/transaction/edit/negative",
            method: 'GET',
            data: { id:id },
            success: function (res) {
                $('input[name="id"]').val(res.adjust.id);
                $('input[name="tranId"]').val(res.adjust.tran_id);
                $('input[name="store"]').attr('data-id', res.adjust.store_id);
                $('input[name="store"]').val(res.adjust.store.store_name);
                $('input[name="product"]').attr('data-groupe', res.adjust.tran_groupe_id);
                $('input[name="product"]').attr('data-id', res.adjust.tran_head_id);
                $('input[name="product"]').val(res.adjust.head.tran_head_name);
                $('input[name="quantity"]').val(res.adjust.quantity);

                var modal = document.getElementById(modalId);

                if (modal) {
                    modal.style.display = 'block';
                }
            },
            error: function (err) {
                console.log(err)
            }
        });
    });




    /////////////// ------------------ Update Transaction Details ajax part start ---------------- /////////////////////////////
    $(document).on('submit', '#EditNegativeAdjustmentForm', function (e) {
        e.preventDefault();
        let store = $('#updateStore').attr('data-id');
        let groupe = $('#updateProduct').attr('data-groupe');
        let product = $('#updateProduct').attr('data-id');
        let formData = new FormData(this);
        formData.append('store', store === undefined ? '' : store);
        formData.append('product', product === undefined ? '' : product);
        formData.append('groupe', groupe === undefined ? '' : groupe);
        formData.append('type', "5");
        formData.append('method', "Negative");
        $.ajax({
            url: `/transaction/update/negative`,
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
                    $('#updateProduct').val('');
                    $('#updateProduct').removeAttr('data-id');
                    $('#updateProduct').removeAttr('data-groupe');
                    $('#updateQuantity').val('1');
                    $('.negative').load(location.href + ' .negative');
                    $('#editAdjustment').hide();
                    toastr.success('Negative Adjustment Updated Successfully', 'Updated!');
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
            url: `/transaction/delete/adjustment`,
            method: 'DELETE',
            data: { id:id },
            success: function (res) {
                if (res.status == "success") {
                    $('.negative').load(location.href + ' .negative');
                    $('#search').val('');
                    $('#deleteModal').hide();
                    toastr.success('Adjustment Deleted Successfully', 'Deleted!');
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
        searchTransaction(`/transaction/adjustment/pagination?page=${page}`, {startDate:startDate, endDate:endDate, method:method, type:type}, '.negative');
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
        if(searchOption == "1"){
            searchTransaction(`/transaction/search/adjustment/tranid`, {search:search, startDate:startDate, endDate:endDate, method:method, type:type}, '.negative')
        }
        if(searchOption == "2"){
            searchTransaction(`/transaction/search/adjustment/product`, {search:search, startDate:startDate, endDate:endDate, method:method, type:type}, '.negative')
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
        if(searchOption == "1"){
            searchTransaction(`/transaction/adjustment/pagination/tranid?page=${page}`, {search:search, startDate:startDate, endDate:endDate, method:method, type:type}, '.negative')
        }
        if(searchOption == "2"){
            searchTransaction(`/transaction/adjustment/pagination/product?page=${page}`, {search:search, startDate:startDate, endDate:endDate, method:method, type:type}, '.negative')
        }
        
    });


   



    //get last transaction with by transaction type function
    function getTransactionWith(type, method, targetElement) {
        $.ajax({
            url: "/transaction/adjustment/get/tranwith",
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
            url: "/transaction/adjustment/get/groupes/with",
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