$(document).ready(function () {
    $(document).on('click', '.add', function (e) {
        $("#name").focus();
    });

    /////////////// ------------------ Add Tran With ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#InsertTranWith', function (e) {
        e.preventDefault();
        let name = $('#name').val();
        let type = $('#type').val();
        $.ajax({
            url: "/admin/employees/insert/tranwith",
            method: 'POST',
            data: { name:name, type:type },
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



    ///////////// ------------------ Edit Tran With ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.editTranWith', function () {
        let modalId = $(this).data('modal-id');
        let id = $(this).data('id');
        $.ajax({
            url: `/admin/employees/edit/tranwith`,
            method: 'GET',
            data: { id:id },
            success: function (res) {
                $('#id').val(id);
                $('#updateName').val(res.tranwith.tran_with_name);
                // Create options dynamically based on the status value
                $('#updateType').empty();
                $('#updateType').append(`<option value="Client" ${res.tranwith.user_type === 'Client' ? 'selected' : ''}>Client</option>
                                         <option value="Supplier" ${res.tranwith.user_type === 'Supplier' ? 'selected' : ''}>Supplier</option>
                                         <option value="Employee" ${res.tranwith.user_type === 'Employee' ? 'selected' : ''}>Employee</option>
                                         <option value="Bank" ${res.tranwith.user_type === 'Bank' ? 'selected' : ''}>Bank</option>
                                         <option value="Others" ${res.tranwith.user_type === 'Others' ? 'selected' : ''}>Others</option>`);
                $('#updateName').focus();
                var modal = document.getElementById(modalId);
                modal.style.display = 'block';
            },
            error: function (err) {
                console.log(err);
            }
        });
    });



    /////////////// ------------------ Update Tran With ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#UpdateTranWith', function (e) {
        e.preventDefault();
        let id = $('#id').val();
        let name = $('#updateName').val();
        let type = $('#updateType').val()
        $.ajax({
            url: `/admin/employees/update/tranwith`,
            method: 'PUT',
            data: { name: name, type:type, id:id },
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



    /////////////// ------------------ Delete Tran With ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#delete', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        if (confirm('Are You Sure to Delete This TranWith ??')) {
            $.ajax({
                url: `/admin/employees/delete/tranwith`,
                method: 'DELETE',
                data: { id:id },
                success: function (res) {
                    if (res.status == "success") {
                        $('.tranwith').load(location.href + ' .tranwith');
                        $('#search').val('');
                        toastr.success('Tranwith Deleted Successfully', 'Deleted!');
                    }
                }
            });
        }
    });



    /////////////// ------------------ Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.paginate a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        loadDesignationData(`/admin/employees/tranwith/pagination?page=${page}`, {}, '.tranwith');
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
            loadDesignationData(`/admin/employees/search/tranwith`, {search:search}, '.tranwith')
        }
        else if(searchOption == "2"){
            loadDesignationData(`/admin/employees/search/tranwith/type`, {search:search}, '.tranwith')
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
            loadDesignationData(`/admin/employees/tranwith/search/pagination?page=${page}`, {search:search}, '.tranwith');
        }
        else if(searchOption == "2"){
            loadDesignationData(`/admin/employees/tranwith/search/pagination/type?page=${page}`, {search:search}, '.tranwith');
        }
        
    });



    //Designation data load function
    function loadDesignationData(url, data, targetElement) {
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