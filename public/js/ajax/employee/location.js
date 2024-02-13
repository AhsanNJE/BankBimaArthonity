$(document).ready(function () {

    /////////////// ------------------ Add Location ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#InsertLocation', function (e) {
        e.preventDefault();
        let division = $('#division').val();
        let district = $('#district').val();
        let thana = $('#thana').val();
        $.ajax({
            url: "/admin/employees/insertLocations",
            method: 'Post',
            data: { division:division, district:district, thana:thana },
            beforeSend:function() {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#AddLocationForm')[0].reset();
                    $('#division').focus();
                    $('#search').val('');
                    $('.location').load(location.href + ' .location');
                    toastr.success('Location Added Successfully', 'Added!');
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



    ///////////// ------------------ Edit Location ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.editLocation', function () {
        let modalId = $(this).data('modal-id');
        let id = $(this).data('id');
        $.ajax({
            url: `/admin/employees/editLocations`,
            method: 'get',
            data: { id:id },
            success: function (res) {
                $('#id').val(id);
                $('#updateDivision').val(res.location.division);
                $('#updateDistrict').val(res.location.district);
                $('#updateThana').val(res.location.thana);

                var modal = document.getElementById(modalId);
                modal.style.display = 'block';
            },
            error: function (err) {
                console.log(err);
            }
        });
    });



    /////////////// ------------------ Update Locations ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#UpdateLocation', function (e) {
        e.preventDefault();
        let id = $('#id').val();
        let division = $('#updateDivision').val();
        let district = $('#updateDistrict').val();
        let thana = $('#updateThana').val();
        $.ajax({
            url: `/admin/employees/updateLocations`,
            method: 'Put',
            data: { division: division, district:district, thana:thana, id:id },
            beforeSend:function() {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#editLocation').hide();
                    $('#EditLocationForm')[0].reset();
                    $('#search').val('');
                    $('.location').load(location.href + ' .location');
                    toastr.success('Location Updated Successfully', 'Updated!');
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



    /////////////// ------------------ Delete Location ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#delete', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        if (confirm('Are You Sure to Delete This Location ??')) {
            $.ajax({
                url: `/admin/employees/deleteLocations`,
                method: 'Delete',
                data: { id:id },
                success: function (res) {
                    if (res.status == "success") {
                        $('.location').load(location.href + ' .location');
                        $('#search').val('');
                        toastr.success('Location Deleted Successfully', 'Deleted!');
                    }
                }
            });
        }
    });



    /////////////// ------------------ Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.paginate a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        loadDesignationData(`/admin/employees/locations/pagination?page=${page}`, {}, '.location');
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
            loadLocationData(`/admin/employees/searchLocations`, {search:search}, '.location')
        }
        else if(searchOption == "2"){
            loadLocationData(`/admin/employees/searchLocations/district`, {search:search}, '.location')
        }
        else if(searchOption == "3"){
            loadLocationData(`/admin/employees/searchLocations/thana`, {search:search}, '.location')
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
            loadLocationData(`/admin/employees/locations/searchPagination?page=${page}`, {search:search}, '.location');
        }
        else if(searchOption == "2"){
            loadLocationData(`/admin/employees/locations/searchPagination/district?page=${page}`, {search:search}, '.location');
        }
        else if(searchOption == "2"){
            loadLocationData(`/admin/employees/locations/searchPagination/division?page=${page}`, {search:search}, '.location');
        }
        
    });



    //Location data load function
    function loadLocationData(url, data, targetElement) {
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