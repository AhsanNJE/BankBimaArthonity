$(document).ready(function () {
    $(document).on('click', '.add', function (e) {
        $("#with").focus();
    });

    /////////////// ------------------ Add Tran With Ajax Part Start ---------------- /////////////////////////////
    $(document).on('submit', '#AddTranWithGroupeForm', function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            url: "/transaction/insert/tranwithgroupe",
            method: 'POST',
            processData: false,
            contentType: false,
            cache: false,
            data: formData,
            beforeSend:function() {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#AddTranWithGroupeForm')[0].reset();
                    $('#with').focus();
                    $('#search').val('');
                    $('.with-groupe').load(location.href + ' .with-groupe');
                    toastr.success('Tranwith Groupe Added Successfully', 'Added!');
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



    ///////////// ------------------ Edit Tran With Ajax Part Start ---------------- /////////////////////////////
    $(document).on('click', '#edit', function () {
        let modalId = $(this).data('modal-id');
        let id = $(this).data('id');
        $.ajax({
            url: `/transaction/edit/tranwithgroupe`,
            method: 'GET',
            data: { id:id },
            success: function (res) {
                $('#id').val(res.tranwithgroupes.id);

                $('#updateWith').html('');
                $('#updateWith').append(`<option value="" >Select Transaction With</option>`);
                $.each(res.tranwith, function (key, withs) {
                    $('#updateWith').append(`<option value="${withs.id}" ${res.tranwithgroupes.with_id === withs.id ? 'selected' : ''}>${withs.tran_with_name}</option>`);
                });

                $('#updateGroupe').html('');
                $('#updateGroupe').append(`<option value="" >Select Transaction Groupe</option>`);
                $.each(res.groupes, function (key, groupe) {
                    $('#updateGroupe').append(`<option value="${groupe.id}" ${res.tranwithgroupes.groupe_id === groupe.id ? 'selected' : ''}>${groupe.tran_groupe_name}</option>`);
                });

                $('#updateWith').focus();
                var modal = document.getElementById(modalId);
                modal.style.display = 'block';
            },
            error: function (err) {
                console.log(err);
            }
        });
    });



    /////////////// ------------------ Update Tran With Ajax Part Start ---------------- /////////////////////////////
    $(document).on('submit', '#EditTranWithGroupeForm', function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            url: `/transaction/update/tranwithgroupe`,
            method: 'Post',
            processData: false,
            contentType: false,
            cache: false,
            data: formData,
            beforeSend:function() {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#editTranWithGroupe').hide();
                    $('#EditTranWithGroupeForm')[0].reset();
                    $('#search').val('');
                    $('.with-groupe').load(location.href + ' .with-groupe');
                    toastr.success('Tranwith Groupe Updated Successfully', 'Updated!');
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



    /////////////// ------------------ Delete Tran With Ajax Part Start ---------------- /////////////////////////////
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
        let id = $(this).attr('data-id');
        $.ajax({
            url: `/transaction/delete/tranwithgroupe`,
            method: 'DELETE',
            data: { id:id },
            success: function (res) {
                if (res.status == "success") {
                    $('.with-groupe').load(location.href + ' .with-groupe');
                    $('#search').val('');
                    $('#deleteModal').hide();
                    toastr.success('Tranwith Groupe Deleted Successfully', 'Deleted!');
                }
            }
        });
    });
    
    
    /////////////// ------------------ Delete Tran With Ajax Part End ---------------- /////////////////////////////
    
    



    /////////////// ------------------ Pagination Ajax Part Start ---------------- /////////////////////////////
    $(document).on('click', '.paginate a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        loadTranWithGroupeData(`/transaction/tranwithgroupe/pagination?page=${page}`, {}, '.with-groupe');
    });



    // On select option search value will be remove
    $(document).on('change', '#searchOption', function (e) {
        $('#search').val('');
    });



    /////////////// ------------------ Search Ajax Part Start ---------------- /////////////////////////////
    $(document).on('keyup', '#search', function (e) {
        e.preventDefault();
        let search = $(this).val();
        let searchOption = $("#searchOption").val();
        if(searchOption == "1"){
            loadTranWithGroupeData(`/transaction/search/tranwithgroupe/with`, {search:search}, '.with-groupe')
        }
        else if(searchOption == "2"){
            loadTranWithGroupeData(`/transaction/search/tranwithgroupe/groupe`, {search:search}, '.with-groupe')
        }
        
    });



    /////////////// ------------------ Search Pagination Ajax Part Start ---------------- /////////////////////////////
    $(document).on('click', '.search-paginate a', function (e) {
        e.preventDefault();
        $('.paginate').addClass('hidden');
        let search = $('#search').val();
        let page = $(this).attr('href').split('page=')[1];
        let searchOption = $("#searchOption").val();
        if(searchOption == "1"){
            loadTranWithGroupeData(`/transaction/tranwithgroupe/search/pagination/with?page=${page}`, {search:search}, '.with-groupe');
        }
        else if(searchOption == "2"){
            loadTranWithGroupeData(`/transaction/tranwithgroupe/search/pagination/groupe?page=${page}`, {search:search}, '.with-groupe');
        }
        
    });



    // TranWith Groupe Data Load Function
    function loadTranWithGroupeData(url, data, targetElement) {
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