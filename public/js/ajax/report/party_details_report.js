$(document).ready(function () {
    // Search by Date Range
    $(document).on('change', '#startDate, #endDate', function(e){
        e.preventDefault();
        let startDate = $('#startDate').val();
        let endDate = $('#endDate').val();
        let type = $('#typeOption').val();
        searchTransaction(`/party/details/report/search`, {startDate:startDate, endDate:endDate,type:type})
    });
    
    
    // Search by Date Range
    $(document).on('change', '#typeOption', function(e){
        e.preventDefault();
        let startDate = $('#startDate').val();
        let endDate = $('#endDate').val();
        let type = $('#typeOption').val();
        searchTransaction(`/party/details/report/search`, {startDate:startDate, endDate:endDate,type:type})
    });


    /////////////// ------------------ Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.paginate a', function (e) {
        e.preventDefault();
        let startDate = $('#startDate').val();
        let endDate = $('#endDate').val();
        let type = $('#typeOption').val();
        let page = $(this).attr('href').split('page=')[1];
        searchTransaction(`/party/details/report/pagination?page=${page}`, { startDate: startDate, endDate: endDate, type: type });
    });


    /////////////// ------------------ Search ajax part start ---------------- /////////////////////////////
    $(document).on('keyup', '#search', function (e) {
        e.preventDefault();
        let startDate = $('#startDate').val();
        let endDate = $('#endDate').val();
        let type = $('#typeOption').val();
        let searchOption = $("#searchOption").val();
        let search = $(this).val();
        searchTransaction(`/party/details/report/search`, {startDate:startDate, endDate:endDate, type:type, searchOption:searchOption, search:search})
    });



    /////////////// ------------------ Search Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.search-paginate a', function (e) {
        e.preventDefault();
        $('.paginate').addClass('hidden');
        let startDate = $('#startDate').val();
        let endDate = $('#endDate').val();
        let type = $('#typeOption').val();
        let searchOption = $("#searchOption").val();
        let search = $(this).val();
        let page = $(this).attr('href').split('page=')[1];
        searchTransaction(`/party/details/report/search/pagination?page=${page}`, {startDate:startDate, endDate:endDate, type:type, searchOption:searchOption, search:search})
    });


    


    // Search Transaction Details
    function searchTransaction(url, data) {
        $.ajax({
            url: url,
            method: 'GET',
            data: data,
            success: function (res) {
                if (res.status === 'success') {
                    $('.party-details').html(res.data);
                    if (res.paginate) {
                        $('.party-details').append('<div class="center search-paginate" id="paginate">' + res.paginate + '</div>');
                    }
                }
                else {
                    $('.party-details').html(`<span class="text-danger">Result not Found </span>`);
                }
            }
        });
    }

});