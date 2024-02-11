$(document).ready(function () {

    /////////////// ------------------ Add Supplier ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#addSupplier', function (e) {
        e.preventDefault();
        let supplierName = $('#supplierName').val();
        let supplierEmail = $('#supplierEmail').val();
        let supplierContact = $('#supplierContact').val();
        let supplierAddress = $('#supplierAddress').val();
        $.ajax({
            url: "/insertSuppliers",
            method: 'Post',
            data: { supplierName:supplierName, supplierEmail:supplierEmail, supplierContact:supplierContact, supplierAddress:supplierAddress },
            beforeSend:function() {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#AddSupplierForm')[0].reset();
                    $('#supplierName').focus();
                    $('#search').val('');
                    $('.supplier').load(location.href + ' .supplier');
                    toastr.success('Supplier Added Successfully', 'Added!');
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



    ///////////// ------------------ Edit Supplier ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.editSupplierModal', function () {
        let modalId = $(this).data('modal-id');
        let id = $(this).data('id');
        $.ajax({
            url: `/editSuppliers/${id}`,
            method: 'get',
            success: function (res) {
                $('#id').val(res.supplier.id);
                $('#updateSupplierName').val(res.supplier.sup_name);
                $('#updateSupplierEmail').val(res.supplier.sup_email);
                $('#updateSupplierContact').val(res.supplier.sup_contact);
                $('#updateSupplierAddress').val(res.supplier.sup_address);
                
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



    /////////////// ------------------ Update Supplier ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#updateSupplier', function (e) {
        e.preventDefault();
        let id = $('#id').val();;
        let supplierName = $('#updateSupplierName').val();
        let supplierEmail = $('#updateSupplierEmail').val();
        let supplierContact = $('#updateSupplierContact').val();
        let supplierAddress = $('#updateSupplierAddress').val();
        $.ajax({
            url: `/updateSuppliers/${id}`,
            method: 'Put',
            data: { supplierName: supplierName, supplierEmail:supplierEmail, supplierContact: supplierContact, supplierAddress:supplierAddress },
            beforeSend:function() {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#editSupplierModal').hide();
                    $('#EditSupplierForm')[0].reset();
                    $('#search').val('');
                    $('.supplier').load(location.href + ' .supplier');
                    toastr.success('Supplier Updated Successfully', 'Updated!');
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



    /////////////// ------------------ Delete Supplier ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.deleteSupplier', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        if (confirm('Are You Sure to Delete This Supplier ??')) {
            $.ajax({
                url: `/deleteSuppliers/${id}`,
                method: 'Delete',
                success: function (res) {
                    if (res.status == "success") {
                        $('.supplier').load(location.href + ' .supplier');
                        $('#search').val('');
                        toastr.success('Supplier Deleted Successfully', 'Deleted!');
                    }
                }
            });
        }
    });

    

    /////////////// ------------------ Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.paginate a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        loadSupplierData(`/supplier/pagination?page=${page}`, {}, '.supplier');
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
        if(searchOption == '1'){
            loadSupplierData(`/searchSupplier/name`, {search:search}, '.supplier');
        }
        else if(searchOption == '2'){
            loadSupplierData(`/searchSupplier/email`, {search:search}, '.supplier')
        }
        else if(searchOption == '3'){
            loadSupplierData(`/searchSupplier/contact`, {search:search}, '.supplier')
        }
        else if(searchOption == '4'){
            loadSupplierData(`/searchSupplier/address`, {search:search}, '.supplier')
        }
        
    });



    /////////////// ------------------ Search Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.search-paginate a', function (e) {
        e.preventDefault();
        $('.paginate').addClass('hidden');
        let search = $('#search').val();
        let page = $(this).attr('href').split('page=')[1];
        let searchOption = $("#searchOption").val();
        if(searchOption == '1'){
            loadSupplierData(`/supplier/namePagination?page=${page}`, {search:search}, '.supplier');
        }
        else if(searchOption == '2'){
            loadSupplierData(`/supplier/emailPagination?page=${page}`, {search:search}, '.supplier')
        }
        else if(searchOption == '3'){
            loadSupplierData(`/supplier/contactPagination?page=${page}`, {search:search}, '.supplier')
        }
        else if(searchOption == '4'){
            loadSupplierData(`/supplier/addressPagination?page=${page}`, {search:search}, '.supplier')
        }
    });


    
    //supplier pagination data load function
    function loadSupplierData(url, data, targetElement) {
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