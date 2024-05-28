$(document).ready(function () {
    $(document).on('click', '.add', function (e) {
        $('#headName').focus();
    });
    /////////////// ------------------ Add Pharmacy Product ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#InsertPharmacyProduct', function (e) {
        e.preventDefault();
        let headName = $('#headName').val();
        let groupe = $('#groupe').val();
        let category = $('#category').attr('data-id');
        let manufacturer = $('#manufacturer').attr('data-id');
        let form = $('#form').attr('data-id');
        let unit = $('#unit').attr('data-id');
        let store = $('#store').attr('data-id');
        let expireddate = $('#expireddate').val();
        $.ajax({
            url: "/insert/pharmacyproduct",
            method: 'POST',
            data: { headName:headName, groupe:groupe, category:category, manufacturer:manufacturer, form:form, unit:unit, store:store, expireddate:expireddate },
            beforeSend:function() {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#addPhamacyProductForm')[0].reset();
                    $('#headName').focus();
                    $('#search').val('');
                    $('.heads').load(location.href + ' .heads');
                    toastr.success('Pharmacy Product Added Successfully', 'Added!');
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



    ///////////// ------------------ Edit Pharmacy Product ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#edit', function () {
        let modalId = $(this).data('modal-id');
        let id = $(this).data('id');
        $('#EditPharmacyProductForm')[0].reset();
        $('#updateCategory').removeAttr('data-id')
        $('#updateManufacturer').removeAttr('data-id')
        $('#updateForm').removeAttr('data-id')
        $('#updateUnit').removeAttr('data-id')
        $('#updateStore').removeAttr('data-id')
        $.ajax({
            url: `/edit/pharmacyproduct`,
            method: 'GET',
            data: { id:id },
            success: function (res) {
                $('#id').val(id);
                $('#updateHeadName').val(res.heads.tran_head_name);
                $('#updateHeadName').focus();

                $('#updateGroupe').html('');
                $('#updateGroupe').append(`<option value="" >Select Transaction Groupe</option>`);
                $.each(res.groupes, function (key, groupe) {
                    $('#updateGroupe').append(`<option value="${groupe.id}" ${res.heads.groupe_id === groupe.id ? 'selected' : ''}>${groupe.tran_groupe_name}</option>`);
                });

                if(res.heads.category_id){
                    $('#updateCategory').val(res.heads.category.category_name);
                    $('#updateCategory').attr('data-id', res.heads.category.id);
                }
                
                if(res.heads.manufacture_id){
                    $('#updateManufacturer').val(res.heads.manufecture.manufacturer_name);
                    $('#updateManufacturer').attr('data-id', res.heads.manufecture.id);
                }
                
                if(res.heads.item_form_id){
                    $('#updateForm').val(res.heads.item_form.form_name);
                    $('#updateForm').attr('data-id', res.heads.item_form.id);
                }

                if(res.heads.item_unite_id){
                    $('#updateUnit').val(res.heads.item_unit.unit_name);
                    $('#updateUnit').attr('data-id', res.heads.item_unit.id);
                }

                if(res.heads.store_id){
                    $('#updateStore').val(res.heads.store.store_name);
                    $('#updateStore').attr('data-id', res.heads.store.id);
                }

                $('#updateQuantity').val(res.heads.quantity);
                $('#updateCostPrice').val(res.heads.cost_price);
                $('#updateMrp').val(res.heads.mrp);
                $('#updateExpiredDate').val(res.heads.expired_date);

                var modal = document.getElementById(modalId);
                modal.style.display = 'block';
            },
            error: function (err) {
                console.log(err);
            }
        });
    });



    /////////////// ------------------ Update Pharmacy Product ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#UpdatePharmacyProduct', function (e) {
        e.preventDefault();

        let id = $('#id').val();

        let groupe = $('#updateGroupe').val();
        let headName = $('#updateHeadName').val();
        let category = $('#updateCategory').attr('data-id');
        let manufacturer = $('#updateManufacturer').attr('data-id');
        let form = $('#updateForm').attr('data-id');
        let unit = $('#updateUnit').attr('data-id');
        let store = $('#updateStore').attr('data-id');
        let quantity = $('#updateQuantity').val();
        let costprice = $('#updateCostPrice').val();
        let mrp = $('#updateMrp').val();
        let expireddate = $('#updateExpiredDate').val();

        $.ajax({
            url: `/update/pharmacyproduct`,
            method: 'PUT',
            data: { id:id, headName:headName, groupe:groupe, category:category, manufacturer:manufacturer, form:form, unit:unit, store:store, quantity:quantity, costprice:costprice, mrp:mrp, expireddate:expireddate },
            beforeSend:function() {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#editPharmacyProduct').hide();
                    $('#EditPharmacyProductForm')[0].reset();
                    $('#search').val('');
                    $('.heads').load(location.href + ' .heads');
                    toastr.success('Pharmacy Product Updated Successfully', 'Updated!');
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



    /////////////// ------------------SweetAlert Delete Pharmacy Product / Transaction Head ajax part start ---------------- /////////////////////////////
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
            url: `/transaction/delete/heads`,
            method: 'DELETE',
            data: { id:id },
            success: function (res) {
                if (res.status == "success") {
                    $('.heads').load(location.href + ' .heads');
                    $('#search').val('');
                    $('#deleteModal').hide();
                    toastr.success('Transaction Head Deleted Successfully', 'Deleted!');
                }
            }
        });

    });
    
    
    /////////////// ------------------SweetAlert Delete Pharmacy Product / Transaction Head ajax part End ---------------- /////////////////////////////
    
    


    /////////////// ------------------ Pagination ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.paginate a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        loadPharmacyProductData(`/pharmacyproduct/pagination?page=${page}`, {}, '.heads');
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
            loadPharmacyProductData(`/search/pharmacyproduct`, {search:search}, '.heads')
        }
        else if(searchOption == "2"){
            loadPharmacyProductData(`/search/pharmacyproduct/groupe`, {search:search}, '.heads')
        }
        else if(searchOption == "3"){
            loadPharmacyProductData(`/search/pharmacyproduct/category`, {search:search}, '.heads')
        }
        else if(searchOption == "4"){
            loadPharmacyProductData(`/search/pharmacyproduct/manufacture`, {search:search}, '.heads')
        }
        else if(searchOption == "5"){
            loadPharmacyProductData(`/search/pharmacyproduct/itemform`, {search:search}, '.heads')
        }
        else if(searchOption == "6"){
            loadPharmacyProductData(`/search/pharmacyproduct/unit`, {search:search}, '.heads')
        }
        else if(searchOption == "7"){
            loadPharmacyProductData(`/search/pharmacyproduct/store`, {search:search}, '.heads')
        }
        else if(searchOption == "11"){
            loadPharmacyProductData(`/search/pharmacyproduct/expireddate`, {search:search}, '.heads')
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
            loadPharmacyProductData(`/pharmacyproduct/search/pagination?page=${page}`, {search:search}, '.heads');
        }
        else if(searchOption == "2"){
            loadPharmacyProductData(`/pharmacyproduct/search/pagination/groupe?page=${page}`, {search:search}, '.heads');
        }
        else if(searchOption == "3"){
            loadPharmacyProductData(`/pharmacyproduct/search/pagination/category?page=${page}`, {search:search}, '.heads');
        }
        else if(searchOption == "4"){
            loadPharmacyProductData(`/pharmacyproduct/search/pagination/manufacture?page=${page}`, {search:search}, '.heads');
        }
        else if(searchOption == "5"){
            loadPharmacyProductData(`/pharmacyproduct/search/pagination/itemform?page=${page}`, {search:search}, '.heads');
        }
        else if(searchOption == "6"){
            loadPharmacyProductData(`/pharmacyproduct/search/pagination/unit?page=${page}`, {search:search}, '.heads');
        }
        else if(searchOption == "7"){
            loadPharmacyProductData(`/pharmacyproduct/search/pagination/store?page=${page}`, {search:search}, '.heads');
        }
        else if(searchOption == "11"){
            loadPharmacyProductData(`/pharmacyproduct/search/pagination/expireddate?page=${page}`, {search:search}, '.heads');
        }
    });



    //Pharmacy Product data load function
    function loadPharmacyProductData(url, data, targetElement) {
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