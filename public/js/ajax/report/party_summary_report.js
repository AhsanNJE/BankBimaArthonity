$(document).ready(function () {
    // Search by Date Range
    $(document).on('change', '#startDate, #endDate', function(e){
        e.preventDefault();
        let startDate = $('#startDate').val();
        let endDate = $('#endDate').val();
        searchTransaction(`/party/summary/report/search/date`, {startDate:startDate, endDate:endDate})
    });



    // Search Transaction Details
    function searchTransaction(url, data) {
        $.ajax({
            url: url,
            method: 'GET',
            data: data,
            success: function (res) {
                if (res.status === 'success') {
                    $('.party-summary').html(res.data);
                    if (res.paginate) {
                        $('.party-summary').append('<div class="center search-paginate" id="paginate">' + res.paginate + '</div>');
                    }
                }
                else {
                    $('.party-summary').html(`<span class="text-danger">Result not Found </span>`);
                }
            }
        });
    }

});