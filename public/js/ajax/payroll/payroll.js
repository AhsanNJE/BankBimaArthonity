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

});