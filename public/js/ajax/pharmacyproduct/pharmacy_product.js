$(document).ready(function () {
    $(document).on('click', '.add', function (e) {
        $('#headName').focus();
    });
    /////////////// ------------------ Add Transaction Head ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#InsertPharmacyProduct', function (e) {
        e.preventDefault();
        let headName = $('#headName').val();
        let groupe = $('#groupe').val();
        let category = $('#category').val();
        let manufacture = $('#manufacture').val();
        let itemform = $('#itemform').val();
        let unite = $('#unite').val();
        $.ajax({
            url: "/insert/pharmacyproduct",
            method: 'POST',
            data: { headName:headName, groupe:groupe, category:category, manufacture:manufacture, itemform:itemform, unite:unite },
            beforeSend:function() {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#AddPharmacyProductForm')[0].reset();
                    $('#headName').focus();
                    $('#search').val('');
                    $('.heads').load(location.href + ' .heads');
                    toastr.success('Pharmacy Product Added Successfully', 'Added!');
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



    ///////////// ------------------ Edit Transaction Head ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.editTransactionHead', function () {
        let modalId = $(this).data('modal-id');
        let id = $(this).data('id');
        $.ajax({
            url: `/transaction/edit/heads`,
            method: 'GET',
            data: { id:id },
            success: function (res) {
                $('#id').val(id);
                $('#updateHeadName').val(res.heads.tran_head_name);
                $('#updateHeadName').focus();
                
                $('#updateGroupe').html('');
                $('#updateGroupe').append(`<option value="" >Select Transaction Groupe</option>`);
                $.each(res.groupes, function (key, groupe) {
                    $('#updateGroupe').append(`<option value="${groupe.id}" ${res.heads.groupe_id === groupe.id ? 'selected' : ''}>${groupe.tran_groupe_name}</option>`);
                });

                var modal = document.getElementById(modalId);
                modal.style.display = 'block';
            },
            error: function (err) {
                console.log(err);
            }
        });
    });



    /////////////// ------------------ Update Transaction Head ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#UpdateTransactionHead', function (e) {
        e.preventDefault();
        let id = $('#id').val();
        let headName = $('#updateHeadName').val();
        let groupe = $('#updateGroupe').val();
        $.ajax({
            url: `/transaction/update/heads`,
            method: 'PUT',
            data: { headName:headName, groupe:groupe, id:id },
            beforeSend:function() {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#editTransactionHead').hide();
                    $('#EditTransactionHeadForm')[0].reset();
                    $('#search').val('');
                    $('.heads').load(location.href + ' .heads');
                    toastr.success('Transaction Head Updated Successfully', 'Updated!');
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



    /////////////// ------------------ Delete Transaction Head ajax part start ---------------- /////////////////////////////
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
            url: `/transaction/delete/heads`,
            method: 'DELETE',
            data: { id:id },
            success: function (res) {
                if (res.status == "success") {
                    $('.heads').load(location.href + ' .heads');
                    $('#search').val('');
                    $('#deleteModal').hide();
                    toastr.success('Transaction Head Deleted Successfully', 'Deleted!');
                }
            }
        });

    });
    
    
    /////////////// ------------------ Delete Transaction Head ajax part End ---------------- /////////////////////////////
    
    



    /////////////// ------------------ Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.paginate a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        loadTransactionHeadData(`/transaction/heads/pagination?page=${page}`, {}, '.heads');
    });



    //on select option search value will be remove
    $(document).on('change', '#searchOption', function (e) {
        $('#search').val('');
    });



    /////////////// ------------------ Search ajax part start ---------------- /////////////////////////////
    $(document).on('keyup', '#search', function (e) {
        e.preventDefault();
        let search = $(this).val();
        let searchOption = $("#searchOption").val();
        if(searchOption == "1"){
            loadTransactionHeadData(`/transaction/search/heads`, {search:search}, '.heads')
        }
        else if(searchOption == "2"){
            loadTransactionHeadData(`/transaction/search/heads/groupe`, {search:search}, '.heads')
        }
        
    });



    /////////////// ------------------ Search Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.search-paginate a', function (e) {
        e.preventDefault();
        $('.paginate').addClass('hidden');
        let search = $('#search').val();
        let page = $(this).attr('href').split('page=')[1];
        let searchOption = $("#searchOption").val();
        if(searchOption == "1"){
            loadTransactionHeadData(`/transaction/heads/search/pagination?page=${page}`, {search:search}, '.heads');
        }
        else if(searchOption == "2"){
            loadTransactionHeadData(`/transaction/heads/search/pagination/groupe?page=${page}`, {search:search}, '.heads');
        }
        
    });



    //Transaction Head data load function
    function loadTransactionHeadData(url, data, targetElement) {
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