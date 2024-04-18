$(document).ready(function () {
    $(document).on('click', '.add', function (e) {
        $('#with').focus();
    });


    /////////////// ------------------ Add Payroll Setup ajax part start ---------------- /////////////////////////////
    $(document).on('submit', '#AddPayrollForm', function (e) {
        e.preventDefault();
        let user = $('#user').attr('data-id');
        let formData = new FormData(this);
        formData.append('user', user === undefined ? '' : user);
        $.ajax({
            url: "/insert/payroll/setup",
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
                    $('#head').val('');
                    $('#amount').val('');
                    $('#head').focus();
                    $('#search').val('');
                    $('.payroll-setup').load(location.href + ' .payroll-setup');
                    getPayrollSetupByUserId(user , '.setup tbody')
                    toastr.success('Payroll Added Successfully', 'Added!');
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



    ///////////// ------------------ Edit Payroll Setup ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.editPayrollSetup', function () {
        let modalId = $(this).data('modal-id');
        let id = $(this).data('id');
        $.ajax({
            url: `/edit/payroll/setup`,
            method: 'GET',
            data: { id:id },
            success: function (res) {
                $('#id').val(res.payroll.id);

                $('#updateWith').focus();
                $('#updateWith').empty();
                $.each(res.tranwith, function (key, withs) {
                    $('#updateWith').append(`<option value="${withs.id}">${withs.tran_with_name}</option>`);
                });
                
                $('#updateUser').val(res.payroll.employee.user_name);
                $('#updateUser').attr('data-id', res.payroll.emp_id);
                $('#updateAmount').val(res.payroll.amount);
                

                $('#updateHead').empty();
                $.each(res.heads, function (key, head) {
                    $('#updateHead').append(`<option value="${head.id}" ${res.payroll.head_id === head.id ? 'selected' : ''}>${head.tran_head_name}</option>`);
                });


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




    /////////////// ------------------ Update Payroll Setup ajax part start ---------------- /////////////////////////////
    $(document).on('submit', '#EditPayrollForm', function (e) {
        e.preventDefault();
        let user = $('#updateUser').attr('data-id');
        let formData = new FormData(this);
        formData.append('user', user === undefined ? '' : user);
        $.ajax({
            url: `/update/payroll/setup`,
            method: 'POST',
            processData: false,
            contentType: false,
            cache: false,
            data:formData,
            beforeSend:function() {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#editPayrollSetup').hide();
                    $('#EditPayrollForm')[0].reset();
                    $('#search').val('');
                    $('.payroll-setup').load(location.href + ' .payroll-setup');
                    toastr.success('Payroll Setup Updated Successfully', 'Updated!');
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



    /////////////// ------------------ Delete Payroll Setup ajax part start ---------------- /////////////////////////////
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
            url: `/delete/payroll/setup`,
            method: 'DELETE',
            data: { id:id },
            success: function (res) {
                if (res.status == "success") {
                    $('.payroll-setup').load(location.href + ' .payroll-setup');
                    $('#search').val('');
                    $('#deleteModal').hide();
                    toastr.success('Payroll Setup Deleted Successfully', 'Deleted!');
                }
            }
        });
    });

    
    
    /////////////// ------------------ Delete Payroll Setup ajax part End ---------------- /////////////////////////////
    
    

    

    /////////////// ------------------ Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.paginate a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        loadPayrollData(`/payroll/setup/pagination?page=${page}`, {}, '.payroll-setup');
    });



    /////////////// ------------------ Search ajax part start ---------------- /////////////////////////////
    $(document).on('keyup', '#search', function (e) {
        e.preventDefault();
        let search = $(this).val();
        let searchOption = $("#searchOption").val();
        loadPayrollData(`/search/payroll/setup`, {search:search, searchOption:searchOption}, '.payroll-setup');
    });



    /////////////// ------------------ Search Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.search-paginate a', function (e) {
        e.preventDefault();
        $('.paginate').addClass('hidden');
        let search = $('#search').val();
        let page = $(this).attr('href').split('page=')[1];
        let searchOption = $("#searchOption").val();
        loadPayrollData(`/search/payroll/setup?page=${page}`, {search:search, searchOption:searchOption}, '.payroll-setup');
    });



    
    // Load pagination data load function
    function loadPayrollData(url, data, targetElement) {
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



    //Get Payroll Setup By User Id
    function getPayrollSetupByUserId(id, grid) {
        $.ajax({
            url: "/payroll/setup/get/user",
            method: 'GET',
            data: { id:id },
            success: function (res) {
                if(res.status === 'success'){
                    $(grid).html(res.data);
                }
                else{
                    $(grid).html('');
                }
                
            }
        });
    }


    

});