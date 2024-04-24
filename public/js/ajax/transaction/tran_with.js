$(document).ready(function () {
    $(document).on('click', '.add', function (e) {
        $("#name").focus();
    });

    /////////////// ------------------ Add Tran With Ajax Part Start ---------------- /////////////////////////////
    $(document).on('click', '#InsertTranWith', function (e) {
        e.preventDefault();
        let name = $('#name').val();
        let type = $('#type').val();
        let tranType = $('#tranType').val();
        let tranMethod = $('#tranMethod').val();
        $.ajax({
            url: "/transaction/insert/tranwith",
            method: 'POST',
            data: { name:name, type:type, tranType:tranType, tranMethod:tranMethod },
            beforeSend:function() {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#AddTranWithForm')[0].reset();
                    $('#name').focus();
                    $('#search').val('');
                    $('.tranwith').load(location.href + ' .tranwith');
                    toastr.success('Tranwith Added Successfully', 'Added!');
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
    $(document).on('click', '.editTranWith', function () {
        let modalId = $(this).data('modal-id');
        let id = $(this).data('id');
        $.ajax({
            url: `/transaction/edit/tranwith`,
            method: 'GET',
            data: { id:id },
            success: function (res) {
                $('#id').val(id);
                $('#updateName').val(res.tranwith.tran_with_name);
                // Create options dynamically
                $('#updateType').empty();
                $('#updateType').append(`<option value="Client" ${res.tranwith.user_type === 'Client' ? 'selected' : ''}>Client</option>
                                         <option value="Supplier" ${res.tranwith.user_type === 'Supplier' ? 'selected' : ''}>Supplier</option>
                                         <option value="Employee" ${res.tranwith.user_type === 'Employee' ? 'selected' : ''}>Employee</option>
                                         <option value="Bank" ${res.tranwith.user_type === 'Bank' ? 'selected' : ''}>Bank</option>
                                         <option value="Others" ${res.tranwith.user_type === 'Others' ? 'selected' : ''}>Others</option>`);
                
                $('#updateTranType').html('');
                $('#updateTranType').append(`<option value="" >Select Transaction Type</option>`);
                $.each(res.types, function (key, type) {
                    $('#updateTranType').append(`<option value="${type.id}" ${res.tranwith.tran_type === type.id ? 'selected' : ''}>${type.type_name}</option>`);
                });

                $('#updateTranMethod').html('');
                $('#updateTranMethod').append(`<option value="Receive" ${res.tranwith.tran_method === 'Receive' ? 'selected' : ''}>Receive</option>
                                         <option value="Payment" ${res.tranwith.tran_method === 'Payment' ? 'selected' : ''}>Payment</option>
                                         <option value="Both" ${res.tranwith.tran_method === 'Both' ? 'selected' : ''}>Both</option>`);
                
                
                $('#updateName').focus();
                var modal = document.getElementById(modalId);
                modal.style.display = 'block';
            },
            error: function (err) {
                console.log(err);
            }
        });
    });



    /////////////// ------------------ Update Tran With Ajax Part Start ---------------- /////////////////////////////
    $(document).on('click', '#UpdateTranWith', function (e) {
        e.preventDefault();
        let id = $('#id').val();
        let name = $('#updateName').val();
        let type = $('#updateType').val();
        let tranType = $('#updateTranType').val();
        let tranMethod = $('#updateTranMethod').val();
        $.ajax({
            url: `/transaction/update/tranwith`,
            method: 'PUT',
            data: { name: name, type:type, tranType:tranType, tranMethod:tranMethod, id:id },
            beforeSend:function() {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#editTranWith').hide();
                    $('#EditTranWithForm')[0].reset();
                    $('#search').val('');
                    $('.tranwith').load(location.href + ' .tranwith');
                    toastr.success('Tranwith Updated Successfully', 'Updated!');
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
            url: `/transaction/delete/tranwith`,
            method: 'DELETE',
            data: { id:id },
            success: function (res) {
                if (res.status == "success") {
                    $('.tranwith').load(location.href + ' .tranwith');
                    $('#search').val('');
                    $('#deleteModal').hide();
                    toastr.success('Tranwith Deleted Successfully', 'Deleted!');
                }
            }
        });
    });
    
    
    /////////////// ------------------ Delete Tran With Ajax Part End ---------------- /////////////////////////////
    
    



    /////////////// ------------------ Pagination Ajax Part Start ---------------- /////////////////////////////
    $(document).on('click', '.paginate a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        loadTranwithData(`/transaction/tranwith/pagination?page=${page}`, {}, '.tranwith');
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
            loadTranwithData(`/transaction/search/tranwith`, {search:search}, '.tranwith')
        }
        else if(searchOption == "2"){
            loadTranwithData(`/transaction/search/tranwith/type`, {search:search}, '.tranwith')
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
            loadTranwithData(`/transaction/tranwith/search/pagination?page=${page}`, {search:search}, '.tranwith');
        }
        else if(searchOption == "2"){
            loadTranwithData(`/transaction/tranwith/search/pagination/type?page=${page}`, {search:search}, '.tranwith');
        }
        
    });



    // TranWith Data Load Function
    function loadTranwithData(url, data, targetElement) {
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