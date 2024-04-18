$(document).ready(function () {
    $(document).on('click', '.add', function (e) {
        $('#groupeName').focus();
    });
    /////////////// ------------------ Add Transaction Groupe ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#InsertTransactionGroupe', function (e) {
        e.preventDefault();
        let groupeName = $('#groupeName').val();
        let type = $('#type').val();
        $.ajax({
            url: "/transaction/insert/groupes",
            method: 'POST',
            data: { groupeName:groupeName, type:type },
            beforeSend:function() {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#AddTransactionGroupeForm')[0].reset();
                    $('#groupeName').focus();
                    $('#search').val('');
                    $('.groupe').load(location.href + ' .groupe');
                    toastr.success('Transaction Groupe Added Successfully', 'Added!');
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



    ///////////// ------------------ Edit Transaction Groupe ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.editTransactionGroupe', function () {
        let modalId = $(this).data('modal-id');
        let id = $(this).data('id');
        $.ajax({
            url: `/transaction/edit/groupes`,
            method: 'GET',
            data: { id:id },
            success: function (res) {
                $('#id').val(id);
                $('#updateGroupeName').val(res.groupes.tran_groupe_name);
                $('#updateType').empty();
                $('#updateType').append(`<option value="" >Select Transaction With</option>
                                        <option value="Receive" ${res.groupes.tran_groupe_type === 'Receive' ? 'selected' : ''}>Receive</option>
                                        <option value="Payment" ${res.groupes.tran_groupe_type === 'Payment' ? 'selected' : ''}>Payment</option>
                                        <option value="Invoice" ${res.groupes.tran_groupe_type === 'Invoice' ? 'selected' : ''}>Invoice</option>
                                        <option value="Both" ${res.groupes.tran_groupe_type === 'Both' ? 'selected' : ''}>Both</option>`);
                
                $('#updateGroupeName').focus();
                var modal = document.getElementById(modalId);
                modal.style.display = 'block';
            },
            error: function (err) {
                console.log(err);
            }
        });
    });



    /////////////// ------------------ Update Transaction Groupe ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#UpdateTransactionGroupe', function (e) {
        e.preventDefault();
        let id = $('#id').val();
        let groupeName = $('#updateGroupeName').val();
        let type = $('#updateType').val();
        $.ajax({
            url: `/transaction/update/groupes`,
            method: 'PUT',
            data: { groupeName: groupeName, type:type, id:id },
            beforeSend:function() {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#editTransactionGroupe').hide();
                    $('#EditTransactionGroupeForm')[0].reset();
                    $('#search').val('');
                    $('.groupe').load(location.href + ' .groupe');
                    toastr.success('Transaction Groupe Updated Successfully', 'Updated!');
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



    /////////////// ------------------ Delete Transaction Groupe ajax part start ---------------- /////////////////////////////
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
            url: `/transaction/delete/groupes`,
            method: 'DELETE',
            data: { id:id },
            success: function (res) {
                if (res.status == "success") {
                    $('.groupe').load(location.href + ' .groupe');
                    $('#search').val('');
                    $('#deleteModal').hide();
                    toastr.success('Transaction Groupes Deleted Successfully', 'Deleted!');
                }
            }
        });
    });
    
    
    /////////////// ------------------ Delete Transaction Groupe ajax part End ---------------- /////////////////////////////
    
    



    /////////////// ------------------ Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.paginate a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        loadTransactionGroupeData(`/transaction/groupes/pagination?page=${page}`, {}, '.groupe');
    });



    //on select option search value will be remove
    $(document).on('change', '#searchOption', function (e) {
        $('#search').val('');
    });



    /////////////// ------------------ Search ajax part start ---------------- /////////////////////////////
    $(document).on('keyup', '#search', function (e) {
        e.preventDefault();
        let search = $(this).val();
        loadTransactionGroupeData(`/transaction/search/groupes`, {search:search}, '.groupe')
    });



    /////////////// ------------------ Search Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.search-paginate a', function (e) {
        e.preventDefault();
        $('.paginate').addClass('hidden');
        let search = $('#search').val();
        let page = $(this).attr('href').split('page=')[1];
        loadTransactionGroupeData(`/transaction/groupes/search/pagination?page=${page}`, {search:search}, '.groupe');
    });



    //Transaction Groupe data load function
    function loadTransactionGroupeData(url, data, targetElement) {
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