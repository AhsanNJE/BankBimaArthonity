$(document).ready(function () {
    //get last transaction id by transaction type
    $(document).on('change', '#type', function (e) {
        let type = $('#type').val();
        getTransactionId(type, '#tranId');
    });
    
    
    
    $(document).on('keyup', '#quantity, #amount', function (e) {
        let quantity = $('#quantity').val();
        let amount = $('#amount').val();
        let totalAmount = quantity * amount;
        $('#totAmount').val(totalAmount);
    });
    
    
    $(document).on('keyup', '#updateQuantity, #updateAmount', function (e) {
        let quantity = $('#updateQuantity').val();
        let amount = $('#updateAmount').val();
        let totalAmount = quantity * amount;
        $('#updateTotAmount').val(totalAmount);
    });



    $(document).on('change', '#groupe', function (e) {
        let groupe = $('#groupe').val();
        $.ajax({
            url: "/transaction/get/heads/groupe",
            method: 'GET',
            data: { groupe:groupe },
            success: function (res) {
                $('#head').html(res);
            },
            error: function (err) {
                console.log(err)
            }
        });
    });



    $(document).on('change', '#updateGroupe', function (e) {
        let groupe = $('#updateGroupe').val();
        $.ajax({
            url: "/transaction/get/heads/groupe",
            method: 'GET',
            data: { groupe:groupe },
            success: function (res) {
                $('#updateHead').html(res);
            },
            error: function (err) {
                console.log(err)
            }
        });
    });


    $(document).on('submit', '#AddPartyForm', function (e) {
        e.preventDefault();
        let tranId = $('#tranId').val();
        let user = $('#user').attr('data-id');
        let locations = $('#location').attr('data-id');
        let formData = new FormData(this);
        formData.append('user', user === undefined ? '' : user);
        formData.append('location', locations === undefined ? '' : locations);
        $.ajax({
            url: "/party/insert/party",
            method: 'POST',
            processData: false,
            contentType: false,
            cache: false,
            data: formData,
            beforeSend: function () {
                $(document).find('span.error').text('');
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#AddPartyForm')[0].reset();
                    $('#location').removeAttr('data-id');
                    $('#user').removeAttr('data-id');
                    $('.party').load(location.href + ' .party');
                    $('.due-grid tbody').html('');
                    toastr.success('Party Payment Added Successfully', 'Added!');
                }
            },
            error: function (err) {
                let error = err.responseJSON;
                $.each(error.errors, function (key, value) {
                    $('#' + key + "_error").text(value);
                });
            }
        });
    });



    ///////////// ------------------ Edit Transaction Main ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.editTransaction', function () {
        let modalId = $(this).data('modal-id');
        let id = $(this).data('id');
        $.ajax({
            url: `/party/edit/party`,
            method: 'GET',
            data: { id:id },
            success: function (res) {
                
                $('#id').val(res.transaction.id);

                $('#updateType').empty();
                $('#updateType').append(`<option value="" disabled>Select Transaction Type</option>
                                        <option value="receive" ${res.transaction.tran_type === 'receive' ? 'selected' : 'disabled'}>Receive</option>
                                         <option value="payment" ${res.transaction.tran_type === 'payment' ? 'selected' : 'disabled'}>Payment</option>`);

                $('#updateTranId').val(res.transaction.tran_id);
                $('#updateInvoice').val(res.transaction.invoice);
                $('#updateLocation').val(res.transaction.location.thana);
                $('#updateLocation').attr('data-id', res.transaction.loc_id);


                $('#updateWith').empty();
                $('#updateWith').append(`<option value="" disabled>Select Transaction With</option>
                                        <option value="regular employee" ${res.transaction.tran_type_with === 'regular employee' ? 'selected' : 'disabled'}>Regular</option>
                                        <option value="district employee" ${res.transaction.tran_type_with === 'district employee' ? 'selected' : 'disabled'}>District Employee</option>
                                        <option value="bit pion" ${res.transaction.tran_type_with === 'bit pion' ? 'selected' : 'disabled'}>Bit Pione</option>
                                        <option value="newspaper client" ${res.transaction.tran_type_with === 'newspaper client' ? 'selected' : 'disabled'}>Newpaper Client</option>
                                        <option value="advertisement client" ${res.transaction.tran_type_with === 'advertisement client' ? 'selected' : 'disabled'}>Advertisement Client</option>
                                        <option value="magazine client" ${res.transaction.tran_type_with === 'magazine client' ? 'selected' : 'disabled'}>Magazine Client</option>
                                        <option value="food supplier" ${res.transaction.tran_type_with === 'food supplier' ? 'selected' : 'disabled'}>Food Supplier</option>
                                        <option value="stationary supplier" ${res.transaction.tran_type_with === 'stationary supplier' ? 'selected' : 'disabled'}>Stationary Supplier</option>
                                        <option value="others" ${res.transaction.tran_type_with === 'others' ? 'selected' : 'disabled'}>Others</option>`);

                $('#updateUser').attr('data-id',res.transaction.tran_user);
                $('#updateUser').val(res.transaction.user.user_name);
                
                
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



    //get last transaction id by transaction type function
    function getTransactionId(type, targetElement) {
        $.ajax({
            url: "/party/get/tranid",
            method: 'GET',
            data: {type:type},
            success: function (res) {
                if(res.status === 'success'){
                    $(targetElement).val(res.id);
                }
                else{
                    $(targetElement).val(res.tran_id);
                }
                
            }
        });
    }


});