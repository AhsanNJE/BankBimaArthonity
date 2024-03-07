$(document).ready(function () {
    $(document).on('click','.invoiceDetails', function(e){
        console.log('hello')
        let modalId = $(this).data('modal-id');
        let id = $(this).data('id');
        $.ajax({
            url: `/report/invoice/details`,
            method: 'GET',
            data: { id:id },
            success: function (res) {
                $('.details').html(res.data);

                var modal = document.getElementById(modalId);
                modal.style.display = 'block';
            },
            error: function (err) {
                console.log(err);
            }
        });
    });

    $(document).on('click','.print', function(){
        var printContent = document.getElementById("print-part").innerHTML;
        var originalContent = document.body.innerHTML;
        document.body.innerHTML = printContent;
        window.print();
        document.body.innerHTML = originalContent;
    });

    // Search by Date Range
    $(document).on('change', '#startDate, #endDate', function(e){
        e.preventDefault();
        let startDate = $('#startDate').val();
        let endDate = $('#endDate').val();
        searchTransaction(`/report/groupe/search/date`, {startDate:startDate, endDate:endDate})
    });



    // Search Transaction Details
    function searchTransaction(url, data) {
        $.ajax({
            url: url,
            method: 'GET',
            data: data,
            success: function (res) {
                if (res.status === 'success') {
                    $('.report-groupe').html(res.data);
                    if (res.paginate) {
                        $('.report-groupe').append('<div class="center search-paginate" id="paginate">' + res.paginate + '</div>');
                    }
                }
                else {
                    $('.details').html(`<span class="text-danger">Result not Found </span>`);
                }
            }
        });
    }

});