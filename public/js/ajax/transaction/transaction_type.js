$(document).ready(function () {
    $(document).on('click', '.add', function (e) {
        $('#typeName').focus();
    });
    /////////////// ------------------ Add Transaction Type ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#InsertTransactionType', function (e) {
        e.preventDefault();
        let typeName = $('#typeName').val();
        $.ajax({
            url: "/transaction/insert/types",
            method: 'POST',
            data: { typeName:typeName},
            beforeSend:function() {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#AddTransactionTypeForm')[0].reset();
                    $('#typeName').focus();
                    $('#search').val('');
                    $('.types').load(location.href + ' .types');
                    toastr.success('Transaction Type Added Successfully', 'Added!');
                }
            },
            error: function (err) {
                console.log(err)
                let error = err.responseJSON;
                $.each(error.errors, function (key, value) {
                    $('#' + key + "_error").text(value);
                });
            }
        });
    });



    ///////////// ------------------ Edit Transaction Type ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.editTransactionType', function () {
        let modalId = $(this).data('modal-id');
        let id = $(this).data('id');
        $.ajax({
            url: `/transaction/edit/types`,
            method: 'GET',
            data: { id:id },
            success: function (res) {
                $('#id').val(id);
                $('#updateTypeName').val(res.types.type_name);
                $('#updateTypeName').focus();
                var modal = document.getElementById(modalId);
                modal.style.display = 'block';
            },
            error: function (err) {
                console.log(err);
            }
        });
    });



    /////////////// ------------------ Update Transaction Type ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#UpdateTransactionType', function (e) {
        e.preventDefault();
        let id = $('#id').val();
        let typeName = $('#updateTypeName').val();
        $.ajax({
            url: `/transaction/update/types`,
            method: 'PUT',
            data: { typeName: typeName, id:id },
            beforeSend:function() {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#editTransactionType').hide();
                    $('#EditTransactionTypeForm')[0].reset();
                    $('#search').val('');
                    $('.types').load(location.href + ' .types');
                    toastr.success('Transaction Type Updated Successfully', 'Updated!');
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



    /////////////// ------------------ Delete Transaction Type ajax part start ---------------- /////////////////////////////
    //Delete button functionality
    $(document).on('click', '#delete', function (e) {
        e.preventDefault();
        $('#deleteModal').show();
        let id = $(this).data('id');
        $('#confirm').attr('data-id',id);
        $('#cancel').focus();
    });

    //Cancel button functionality
    $(document).on('click', '#cancel', function (e) {
        e.preventDefault();
        $('#deleteModal').hide();
    });

    //Confirm button functionality
    $(document).on('click', '#confirm', function (e) {
        e.preventDefault();
        let id = $(this).attr('data-id');
        $.ajax({
            url: `/transaction/delete/types`,
            method: 'DELETE',
            data: { id:id },
            success: function (res) {
                if (res.status == "success") {
                    $('.types').load(location.href + ' .types');
                    $('#search').val('');
                    $('#deleteModal').hide();
                    toastr.success('Transaction Types Deleted Successfully', 'Deleted!');
                }
            }
        });
    });
    
    
    /////////////// ------------------ Delete Transaction Type ajax part End ---------------- /////////////////////////////
    
    



    /////////////// ------------------ Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.paginate a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        loadTransactionTypeData(`/transaction/types/pagination?page=${page}`, {}, '.types');
    });



    /////////////// ------------------ Search ajax part start ---------------- /////////////////////////////
    $(document).on('keyup', '#search', function (e) {
        e.preventDefault();
        let search = $(this).val();
        loadTransactionTypeData(`/transaction/search/types`, {search:search}, '.types')
    });



    /////////////// ------------------ Search Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.search-paginate a', function (e) {
        e.preventDefault();
        $('.paginate').addClass('hidden');
        let search = $('#search').val();
        let page = $(this).attr('href').split('page=')[1];
        loadTransactionTypeData(`/transaction/types/search/pagination?page=${page}`, {search:search}, '.types');
    });



    //Transaction Type data load function
    function loadTransactionTypeData(url, data, targetElement) {
        $.ajax({
            url: url,
            data: data,
            success: function (res) {
                if (res.status == "null") {
                    $(targetElement).html(`<span class="text-danger">Result not Found </span>`);
                } else {
                    $(targetElement).html(res.data);
                    if(res.paginate){
                        $(targetElement).append('<div class="center search-paginate" id="paginate">' + res.paginate + '</div>');
                    }
                }
            }
        });
    }

});