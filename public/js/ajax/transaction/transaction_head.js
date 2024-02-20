$(document).ready(function () {

    /////////////// ------------------ Add Transaction Head ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#InsertTransactionHead', function (e) {
        e.preventDefault();
        let headName = $('#headName').val();
        let groupe = $('#groupe').attr('data-id');
        $.ajax({
            url:"/transaction/insert/heads",
            method:'POST',
            data: { headName:headName, groupe:groupe },
            beforeSend:function() {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#AddTransactionHeadForm')[0].reset();
                    $('#headName').focus();
                    $('#search').val('');
                    $('.heads').load(location.href + ' .heads');
                    toastr.success('Transaction Heads Added Successfully', 'Added!');
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
            url:`/transaction/edit/heads`,
            method:'GET',
            data: { id:id },
            success: function (res) {
                $('#id').val(id);
                $('#updateHeadName').val(res.heads.tran_head_name);
                $('#updateGroupe').attr('data-id',res.heads.groupe_id);
                $('#updateGroupe').val(res.heads.groupe.tran_groupe_name);

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
        let groupe = $('#updateGroupe').attr('data-id');
        $.ajax({
            url:`/transaction/update/heads`,
            method:'PUT',
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
    $(document).on('click', '#delete', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        if (confirm('Are You Sure to Delete This Transaction Head ??')) {
            $.ajax({
                url:`/transaction/delete/heads`,
                method:'DELETE',
                data: { id:id },
                success: function (res) {
                    if (res.status == "success") {
                        $('.heads').load(location.href + ' .heads');
                        $('#search').val('');
                        toastr.success('Transaction Head Deleted Successfully', 'Deleted!');
                    }
                }
            });
        }
    });



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
            url:url,
            data:data,
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