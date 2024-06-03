$(document).ready(function () {

    // Get Last Transaction Id By Transaction Method and Type
    $(document).on('click', '.add', function (e) {
        $('#store').focus();
    });
 

    // Search by Date Range
    $(document).on('change', '#startDate, #endDate', function(e){
        e.preventDefault();
        let type = '5';
        let method = 'Positive';
        let startDate = $('#startDate').val();
        let endDate = $('#endDate').val();
        searchTransaction(`/transaction/search/adjustment/date`, { startDate:startDate, endDate:endDate, method:method, type:type}, '.positive')
    });

    ///////////// ------------------ Add Positive Adjustment ajax part start ---------------- /////////////////////////////
    $(document).on('submit', '#AddPositiveAdjustmentForm', function (e) {
        e.preventDefault();
        let store = $('#store').attr('data-id');
        let product = $('#product').attr('data-id');
        let groupe = $('#product').attr('data-groupe');
        let formData = new FormData(this);
        formData.append('product', product === undefined ? '' : product);
        formData.append('groupe', groupe === undefined ? '' : groupe);
        formData.append('store', store === undefined ? '' : store);
        formData.append('method', 'Positive');
        formData.append('type', '5');
        $.ajax({
            url: "/transaction/insert/positive/adjustment",
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
                    $('.positive').load(location.href + ' .positive');
                    toastr.success('Positive Adjustment Done Successfully', 'Added!');
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
            url: "/transaction/edit/positive",
            method: 'GET',
            data: { id:id },
            success: function (res) {
                $('#id').val(res.adjust.id);
                $('#updateTranId').val(res.adjust.tran_id);
                $('#updateStore').attr('data-id', res.adjust.store_id);
                $('#updateStore').val(res.adjust.store.store_name);
                $('#updateProduct').attr('data-groupe', res.adjust.tran_groupe_id);
                $('#updateProduct').attr('data-id', res.adjust.tran_head_id);
                $('#updateProduct').val(res.adjust.head.tran_head_name);
                $('#updateQuantity').val(res.adjust.quantity);

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
    $(document).on('submit', '#EditPositiveAdjustmentForm', function (e) {
        e.preventDefault();
        let store = $('#updateStore').attr('data-id');
        let groupe = $('#updateProduct').attr('data-groupe');
        let product = $('#updateProduct').attr('data-id');
        let formData = new FormData(this);
        formData.append('store', store === undefined ? '' : store);
        formData.append('product', product === undefined ? '' : product);
        formData.append('groupe', groupe === undefined ? '' : groupe);
        formData.append('type', "5");
        formData.append('method', "Positive");
        $.ajax({
            url: `/transaction/update/positive`,
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
                    $('.positive').load(location.href + ' .positive');
                    $('#editAdjustment').hide();
                    toastr.success('Positive Adjustment Updated Successfully', 'Updated!');
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
        let id = $(this).data('id');
        $.ajax({
            url: `/transaction/delete/adjustment`,
            method: 'DELETE',
            data: { id:id },
            success: function (res) {
                if (res.status == "success") {
                    $('.positive').load(location.href + ' .positive');
                    $('#search').val('');
                    $('#deleteModal').hide();
                    toastr.success('Adjustment Deleted Successfully', 'Deleted!');
                }
            }
        });
    });


        /////////////// ------------------ Pagination ajax part start ---------------- /////////////////////////////
        $(document).on('click', '.paginate a', function (e) {
            e.preventDefault();
            let method = "Positive";
            let type = "5";
            let startDate = $('#startDate').val();
            let endDate = $('#endDate').val();
            let page = $(this).attr('href').split('page=')[5];
            searchTransaction(`/transaction/adjustment/pagination?page=${page}`, {startDate:startDate, endDate:endDate, method:method, type:type}, '.positive');
        });



    /////////////// ------------------ Search ajax part start ---------------- /////////////////////////////
    $(document).on('keyup', '#search', function (e) {
        e.preventDefault();
        let startDate = $('#startDate').val();
        let endDate = $('#endDate').val();
        let search = $(this).val();
        let method = "Positive";
        let type = "5";
        let searchOption = $("#searchOption").val();
        if(searchOption == "1"){
            searchTransaction(`/transaction/search/adjustment/tranid`, {search:search, startDate:startDate, endDate:endDate, method:method, type:type}, '.positive')
        }
        if(searchOption == "2"){
            searchTransaction(`/transaction/search/adjustment/product`, {search:search, startDate:startDate, endDate:endDate, method:method, type:type}, '.positive')
        }
        
    });



    /////////////// ------------------ Search Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.search-paginate a', function (e) {
        e.preventDefault();
        $('.paginate').addClass('hidden');
        let startDate = $('#startDate').val();
        let endDate = $('#endDate').val();
        let search = $('#search').val();
        let method = "Positive";
        let type = "5";
        let searchOption = $("#searchOption").val();
        let page = $(this).attr('href').split('page=')[5];
        if(searchOption == "1"){
            searchTransaction(`/transaction/adjustment/pagination/tranid?page=${page}`, {search:search, startDate:startDate, endDate:endDate, method:method, type:type}, '.positive')
        }
        if(searchOption == "2"){
            searchTransaction(`/transaction/adjustment/pagination/product?page=${page}`, {search:search, startDate:startDate, endDate:endDate, method:method, type:type}, '.positive')
        }
        
    });

    // Search Positive Details
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