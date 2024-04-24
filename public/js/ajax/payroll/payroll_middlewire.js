$(document).ready(function () {
    $(document).on('click', '.add', function (e) {
        $('#with').focus();
    });


    /////////////// ------------------ Add Payroll Middlewire ajax part start ---------------- /////////////////////////////
    $(document).on('submit', '#AddPayrollForm', function (e) {
        e.preventDefault();
        let user = $('#user').attr('data-id');
        let formData = new FormData(this);
        formData.append('user', user === undefined ? '' : user);
        $.ajax({
            url: "/insert/payroll/middlewire",
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
                    $('#head').focus();
                    // $('#date').val('');
                    $('#amount').val('');
                    $('#search').val('');
                    $('.payroll-middlewire').load(location.href + ' .payroll-middlewire');
                    getPayrollByUserId(user, '.payroll-grid tbody');
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



    ///////////// ------------------ Edit Payroll Middlewire ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.editPayrollMiddlewire', function () {
        let modalId = $(this).data('modal-id');
        let id = $(this).data('id');
        $.ajax({
            url: `/edit/payroll/middlewire`,
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


                $('#updateDate').val(res.payroll.date)

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




    /////////////// ------------------ Update Payroll Middelwire ajax part start ---------------- /////////////////////////////
    $(document).on('submit', '#EditPayrollForm', function (e) {
        e.preventDefault();
        let user = $('#updateUser').attr('data-id');
        let formData = new FormData(this);
        formData.append('user', user === undefined ? '' : user);
        $.ajax({
            url: `/update/payroll/middlewire`,
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
                    $('#editPayrollMiddlewire').hide();
                    $('#EditPayrollForm')[0].reset();
                    $('#search').val('');
                    $('.payroll-middlewire').load(location.href + ' .payroll-middlewire');
                    toastr.success('Payroll Middlewire Updated Successfully', 'Updated!');
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



    /////////////// ------------------ Delete Payroll Middlewire ajax part start ---------------- /////////////////////////////
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
            url: `/delete/payroll/middlewire`,
            method: 'DELETE',
            data: { id:id },
            success: function (res) {
                if (res.status == "success") {
                    $('.payroll-middlewire').load(location.href + ' .payroll-middlewire');
                    $('#search').val('');
                    $('#deleteModal').hide();
                    toastr.success('Payroll Middlewire Deleted Successfully', 'Deleted!');
                }
            }
        });
    });

    
    
    /////////////// ------------------ Delete Payroll Middlewire ajax part End ---------------- /////////////////////////////
    
    

    

    /////////////// ------------------ Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.paginate a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        loadPayrollData(`/payroll/middlewire/pagination?page=${page}`, {}, '.payroll-middlewire');
    });



    /////////////// ------------------ Search ajax part start ---------------- /////////////////////////////
    $(document).on('keyup', '#search', function (e) {
        e.preventDefault();
        let search = $(this).val();
        let searchOption = $("#searchOption").val();
        loadPayrollData(`/search/payroll/middlewire`, {search:search, searchOption:searchOption}, '.payroll-middlewire');
    });



    /////////////// ------------------ Search Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.search-paginate a', function (e) {
        e.preventDefault();
        $('.paginate').addClass('hidden');
        let search = $('#search').val();
        let page = $(this).attr('href').split('page=')[1];
        let searchOption = $("#searchOption").val();
        loadPayrollData(`/search/payroll/middlewire?page=${page}`, {search:search, searchOption:searchOption}, '.payroll-middlewire');
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


    // //Get Payroll Middlewire By User Id
    // function getPayrollMiddlewireByUserId(id, grid) {
    //     $.ajax({
    //         url: "/payroll/middlewire/get/user",
    //         method: 'GET',
    //         data: { id:id },
    //         success: function (res) {
    //             if(res.status === 'success'){
    //                 $(grid).html(res.data);
    //             }
    //             else{
    //                 $(grid).html('');
    //             }
                
    //         }
    //     });
    // }


    function getPayrollByUserId(id, grid) {
        $.ajax({
            url: "/payroll/get/user",
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