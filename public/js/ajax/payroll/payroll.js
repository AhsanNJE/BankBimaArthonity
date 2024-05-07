$(document).ready(function () {
    /////////////// ----------------------- Payroll Process Part Ajax start here ------------------- //////////////////////////
    //Process Button Functionality
    $(document).on('click', '#PayrollProcess', function (e) {
        e.preventDefault();
        $('#confirmPayrollModal').show();
        $('#cancelProcessBtn').focus();
    });

    // Cancel Button Functionality
    $(document).on('click', '#cancelProcessBtn', function (e) {
        e.preventDefault();
        $('#confirmPayrollModal').hide();
    });


    // Confirm Button Functionality
    $(document).on('click', '#confirmProcessBtn', function (e) {
        e.preventDefault();
        $.ajax({
            url: "/insert/payroll",
            method: 'POST',
            success: function (res) {
                if (res.status == "success") {
                    toastr.success('Payroll Processed Successfully', 'Added!');
                    $('#confirmPayrollModal').hide();
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

    /////////////// ----------------------- Payroll Process Part Ajax end here ------------------- //////////////////////////

    


    ///////////// ------------------ Payroll Details Part Ajax end here ---------------- /////////////////////////////
    $(document).on('click', '#details', function () {
        let modalId = $(this).data('modal-id');
        let id = $(this).data('id');
        let month = $('#month').val(); // Get the value of the month select element
        let year = $('#year').val(); // Get the value of the year select element
        $.ajax({
            url: `/payroll/get/user/date`,
            method: 'GET',
            data: { id: id, month: month, year: year },
            success: function (res) {
                if (res.status === 'success') {
                    $('.payroll-grid tbody').html(res.data);
                    $('#employee').val(res.payrolls[0].employee.user_name);
                    $('#employee').attr('data-id', res.payrolls[0].emp_id);

                    $('#head').empty();
                    $('#head').append('<option value="">Select Payroll Category</option>');
                    $.each(res.heads, function (key, head) {
                        $('#head').append(`<option value="${head.id}">${head.tran_head_name}</option>`);
                    });
                } else {
                    // Handle error or empty response
                    $('.payroll-grid tbody').html('');
                }
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
    
    ///////////// ------------------ Payroll Details Part Ajax end here ---------------- /////////////////////////////
    




    /////////////// ------------------ Add Payroll ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#EditPayroll', function (e) {
        e.preventDefault();
        let user = $('#employee').attr('data-id');
        let head = $('#head').val();
        let amount = $('#amount').val();
        let date = $('#year').val()+'-'+$('#month').val()+'-'+'07';
        $.ajax({
            url: "/insert/payroll/middlewire",
            method: 'POST',
            data: { user:user, head:head, amount:amount, date:date },
            beforeSend:function() {
                $(document).find('span.error').text('');
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#head').val('');
                    $('#head').focus();
                    $('#amount').val('');
                    getPayrollByUserId(user);
                    toastr.success('Payroll Added Successfully', 'Added!');
                    $('.payroll-installment').load(location.href + ' .payroll-installment');
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
    
    
    ///////////// ------------------ Search ajax part start ---------------- /////////////////////////////
    $(document).on('keyup', '#search', function (e) {
        e.preventDefault();
        let search = $('#search').val();
        let month = $("#month").val();
        let year = $('#year').val();
        loadPayrollData(`/search/payroll`, {search:search, month:month, year:year}, '.payroll-installment')
    });


    // Search By Month and Year
    $(document).on('change', '#month, #year', function (e) {
        e.preventDefault();
        let search = $('#search').val();
        let month = $("#month").val();
        let year = $('#year').val();
        loadPayrollData(`/search/payroll`, {search:search, month:month, year:year}, '.payroll-installment')
    });


    // /////////////// ------------------ Search Pagination ajax part start ---------------- /////////////////////////////
    // $(document).on('click', '.search-paginate a', function (e) {
    //     e.preventDefault();
    //     $('.paginate').addClass('hidden');
    //     let search = $('#search').val();
    //     let page = $(this).attr('href').split('page=')[1];
    //     let searchOption = $("#searchOption").val();
    //     loadPayrollData(`/search/payroll/setup?page=${page}`, {search:search, searchOption:searchOption}, '.payroll-setup');
    // });



    
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


    function getPayrollByUserId(id) {
        let month = $('#month').val();
        let year = $('#year').val();
        $.ajax({
            url: "/payroll/get/user/date",
            method: 'GET',
            data: { id:id, month:month, year:year },
            success: function (res) {
                if(res.status === 'success'){
                    $('.payroll-grid tbody').html(res.data);
                }
                else{
                    $('.payroll-grid tbody').html('');
                }

            }
        });
    }

});