// $(document).ready(function () {
    // //get last transaction id by transaction type
    // $(document).on('change', '#type', function (e) {
    //     let type = $('#type').val();
    //     getTransactionWith(type, '#with')
    //     getTransactionId(type, '#tranId');
    //     getTransactionGroupeByType(type, '#groupe')
    // });

    // // Search by Date Range
    // $(document).on('change', '#startDate, #endDate', function (e) {
    //     e.preventDefault();
    //     let type = "";
    //     let startDate = $('#startDate').val();
    //     let endDate = $('#endDate').val();
    //     searchTransaction(`/transaction/search/date`, { startDate: startDate, endDate: endDate, type: type })
    // });


    // $(document).on('keyup', '#quantity, #amount', function (e) {
    //     let quantity = $('#quantity').val();
    //     let amount = $('#amount').val();
    //     let totalAmount = quantity * amount;
    //     $('#totAmount').val(totalAmount);
    // });


    // $(document).on('keyup', '#updateQuantity, #updateAmount', function (e) {
    //     let quantity = $('#updateQuantity').val();
    //     let amount = $('#updateAmount').val();
    //     let totalAmount = quantity * amount;
    //     $('#updateTotAmount').val(totalAmount);
    // });


    // $(document).on('keyup', '#totalDiscount, #advance', function (e) {
    //     // Calculate total discount
    //     let amountRP = parseInt($('#amountRP').val());
    //     let totalDiscount = parseInt($('#totalDiscount').val());
    //     let advance = parseInt($('#advance').val());

    //     let netAmount = amountRP - totalDiscount;
    //     let balance = netAmount - advance;

    //     $('#netAmount').val(netAmount);
    //     $('#balance').val(balance);

    // });


    // $(document).on('change', '#groupe', function (e) {
    //     let groupe = $('#groupe').val();
    //     $.ajax({
    //         url: "/transaction/get/heads/groupe",
    //         method: 'GET',
    //         data: { groupe: groupe },
    //         success: function (res) {
    //             $('#head').html(res);
    //         },
    //         error: function (err) {
    //             console.log(err)
    //         }
    //     });
    // });



    // $(document).on('change', '#updateGroupe', function (e) {
    //     let groupe = $('#updateGroupe').val();
    //     $.ajax({
    //         url: "/transaction/get/heads/groupe",
    //         method: 'GET',
    //         data: { groupe: groupe },
    //         success: function (res) {
    //             $('#updateHead').html(res);
    //         },
    //         error: function (err) {
    //             console.log(err)
    //         }
    //     });
    // });


    // $(document).on('submit', '#AddTransactionForm', function (e) {
    //     e.preventDefault();
    //     let tranId = $('#tranId').val();
    //     let user = $('#user').attr('data-id');
    //     let locations = $('#location').attr('data-id');
    //     let formData = new FormData(this);
    //     formData.append('user', user === undefined ? '' : user);
    //     formData.append('location', locations === undefined ? '' : locations);
    //     $.ajax({
    //         url: "/transaction/insert/details",
    //         method: 'POST',
    //         processData: false,
    //         contentType: false,
    //         cache: false,
    //         data: formData,
    //         beforeSend: function () {
    //             $(document).find('span.error').text('');
    //         },
    //         success: function (res) {
    //             if (res.status == "success") {
    //                 getTransactionGrid(tranId, '.transaction_grid tbody', '#amountRP', '#netAmount', '#balance', '#totalDiscount', '#advance');
    //                 $('#head').val('');
    //                 $('#quantity').val('1');
    //                 $('#amount').val('');
    //                 $('#totAmount').val('');
    //                 $("#head").focus();
    //                 $('.details').load(location.href + ' .details');
    //                 toastr.success('Transaction Added Successfully', 'Added!');
    //             }
    //         },
    //         error: function (err) {
    //             let error = err.responseJSON;
    //             $.each(error.errors, function (key, value) {
    //                 $('#' + key + "_error").text(value);
    //             });
    //         }
    //     });
    // });



    // $(document).on('click', '#AddMainTransaction', function (e) {
    //     e.preventDefault();
    //     let tranId = $('#tranId').val();
    //     let type = $('#type').val();
    //     let invoice = $('#invoice').val();
    //     let withs = $('#with').val();
    //     let user = $('#user').attr('data-id');
    //     let locations = $('#location').attr('data-id');
    //     let amountRP = $('#amountRP').val();
    //     let discount = $('#totalDiscount').val();
    //     let netAmount = $('#netAmount').val();
    //     let advance = $('#advance').val();
    //     let balance = $('#balance').val();
    //     $.ajax({
    //         url: "/transaction/insert/main",
    //         method: 'POST',
    //         data: { tranId: tranId, type: type, invoice: invoice, withs: withs, user: user, locations: locations, amountRP: amountRP, discount: discount, netAmount: netAmount, advance: advance, balance: balance },
    //         beforeSend: function () {
    //             $(document).find('span.error').text('');
    //         },
    //         success: function (res) {
    //             if (res.status == "success") {
    //                 $('#AddTransactionForm')[0].reset();
    //                 $('#location').removeAttr('data-id');
    //                 $('#user').removeAttr('data-id');
    //                 $('.transaction_grid tbody').html('');
    //                 $('.details').load(location.href + ' .details');
    //                 $('#addTransaction').hide();
    //                 toastr.success('Transaction Added To Main TableSuccessfully', 'Added!');
    //             }
    //         },
    //         error: function (err) {
    //             let error = err.responseJSON;
    //             $.each(error.errors, function (key, value) {
    //                 $('#' + key + "_error").text(value);
    //             });
    //         }
    //     });
    // });



    // ///////////// ------------------ Edit Transaction Main ajax part start ---------------- /////////////////////////////
    // $(document).on('click', '.editTransaction', function () {
    //     let modalId = $(this).data('modal-id');
    //     let id = $(this).data('id');
    //     $.ajax({
    //         url: `transaction/edit/main`,
    //         method: 'GET',
    //         data: { id: id },
    //         success: function (res) {

    //             $('#id').val(res.transaction.id);

    //             $('#updateType').empty();
    //             $('#updateType').append(`<option value="" disabled>Select Transaction Type</option>
    //                                     <option value="receive" ${res.transaction.tran_type === 'receive' ? 'selected' : 'disabled'}>Receive</option>
    //                                      <option value="payment" ${res.transaction.tran_type === 'payment' ? 'selected' : 'disabled'}>Payment</option>`);

    //             $('#updateTranId').val(res.transaction.tran_id);
    //             $('#updateInvoice').val(res.transaction.invoice);
    //             $('#updateLocation').val(res.transaction.location.thana);
    //             $('#updateLocation').attr('data-id', res.transaction.loc_id);


    //             $('#updateWith').empty();
    //             $('#updateWith').append(`<option value="" disabled>Select Transaction With</option>`);
    //             $.each(res.tranwith, function (key, withs) {
    //                 $('#updateWith').append(`<option value="${withs.id}" ${res.transaction.tran_type_with === withs.id ? 'selected' : 'disabled'}>${withs.tran_with_name}</option>`);
    //             });
                

    //             $('#updateUser').attr('data-id', res.transaction.tran_user);
    //             $('#updateUser').val(res.transaction.user.user_name);

    //             getTransactionGrid(res.transaction.tran_id, '.update_transaction_grid tbody');

    //             $('#updateAmountRP').val(res.transaction.bill_amount);
    //             $('#updateTotalDiscount').val(res.transaction.discount);
    //             $('#updateNetAmount').val(res.transaction.net_amount);

    //             if (res.transaction.receive == null) {
    //                 $('#updateAdvance').val(res.transaction.payment);
    //             }
    //             else {
    //                 $('#updateAdvance').val(res.transaction.receive);
    //             }


    //             $('#updateBalance').val(res.transaction.due);

    //             var modal = document.getElementById(modalId);
    //             if (modal) {
    //                 modal.style.display = 'block';
    //             }
    //         },
    //         error: function (err) {
    //             console.log(err);
    //         }
    //     });
    // });




    // ///////////// ------------------ Edit Transaction Details ajax part start ---------------- /////////////////////////////
    // $(document).on('click', '#edit', function (e) {
    //     e.preventDefault();
    //     let id = $(this).data('id');
    //     $.ajax({
    //         url: "/transaction/edit/details",
    //         method: 'GET',
    //         data: { id: id },
    //         success: function (res) {
    //             $('#dId').val(res.transaction.id);

    //             $('#updateGroupe').html('');
    //             $('#updateGroupe').append(`<option value="" >Select Transaction Groupe</option>`);
    //             $.each(res.groupes, function (key, groupe) {
    //                 $('#updateGroupe').append(`<option value="${groupe.id}" ${res.transaction.tran_groupe_id === groupe.id ? 'selected' : ''}>${groupe.tran_groupe_name}</option>`);
    //             });

    //             $('#updateHead').html('');
    //             $('#updateHead').append(`<option value="" >Select Transaction Head</option>`);
    //             $.each(res.heads, function (key, head) {
    //                 $('#updateHead').append(`<option value="${head.id}" ${res.transaction.tran_head_id === head.id ? 'selected' : ''}>${head.tran_head_name}</option>`);
    //             });

    //             $('#updateQuantity').val(res.transaction.quantity);
    //             $('#updateAmount').val(res.transaction.amount);
    //             $('#updateTotAmount').val(res.transaction.tot_amount);
    //         },
    //         error: function (err) {
    //             console.log(err)
    //         }
    //     });
    // });




    // /////////////// ------------------ Update Transaction Details ajax part start ---------------- /////////////////////////////
    // $(document).on('submit', '#EditTransactionForm', function (e) {
    //     e.preventDefault();
    //     let tranId = $('#updateTranId').val();
    //     let user = $('#updateUser').attr('data-id');
    //     let locations = $('#updateLocation').attr('data-id');
    //     let formData = new FormData(this);
    //     formData.append('user', user === undefined ? '' : user);
    //     formData.append('location', locations === undefined ? '' : locations);
    //     $.ajax({
    //         url: `transaction/update/details`,
    //         method: 'POST',
    //         data: formData,
    //         processData: false,
    //         contentType: false,
    //         cache: false,
    //         beforeSend: function () {
    //             $(document).find('span.error').text('');
    //         },
    //         success: function (res) {
    //             console.log(res);
    //             if (res.status == "success") {
    //                 getTransactionGrid(tranId, '.update_transaction_grid tbody', '#updateAmountRP', '#updateNetAmount', '#updateBalance', '#updateTotalDiscount', '#updateAdvance');
    //                 $('#dId').val('');
    //                 $('#updateGroupe').val('');
    //                 $('#updateHead').val('');
    //                 $('#updateQuantity').val('1');
    //                 $('#updateAmount').val('');
    //                 $('#updateTotAmount').val('');
    //                 toastr.success('Transaction Details Updated Successfully', 'Updated!');
    //             }
    //         },
    //         error: function (err) {
    //             let error = err.responseJSON;
    //             $.each(error.errors, function (key, value) {
    //                 $('#update_' + key + "_error").text(value);
    //             })
    //         }
    //     });
    // });



    // /////////////// ------------------ Update Transaction Main ajax part start ---------------- /////////////////////////////
    // $(document).on('click', '#UpdateMainTransaction', function (e) {
    //     e.preventDefault();
    //     let id = $('#id').val();
    //     let type = $('#updateType').val();
    //     let amountRP = $('#updateAmountRP').val();
    //     let totalDiscount = $('#updateTotalDiscount').val();
    //     let netAmount = $('#updateNetAmount').val();
    //     let advance = $('#updateAdvance').val();
    //     let balance = $('#updateBalance').val();
    //     $.ajax({
    //         url: `transaction/update/main`,
    //         method: 'PUT',
    //         data: { id: id, type: type, amountRP: amountRP, totalDiscount: totalDiscount, netAmount: netAmount, advance: advance, balance: balance },
    //         beforeSend: function () {
    //             $(document).find('span.error').text('');
    //         },
    //         success: function (res) {
    //             console.log(res);
    //             if (res.status == "success") {
    //                 $('.details').load(location.href + ' .details');
    //                 $('#editTransaction').hide();
    //                 toastr.success('Transaction Main Updated Successfully', 'Updated!');
    //             }
    //         },
    //         error: function (err) {
    //             let error = err.responseJSON;
    //             $.each(error.errors, function (key, value) {
    //                 $('#update_' + key + "_error").text(value);
    //             })
    //         }
    //     });
    // });



    // /////////////// ------------------ Delete Transaction Details ajax part start ---------------- /////////////////////////////
    // $(document).on('click', '#delete', function (e) {
    //     e.preventDefault();
    //     let tranId = $('#tranId').val();
    //     let updateTranId = $('#updateTranId').val();
    //     let id = $(this).data('id');
    //     if (confirm('Are You Sure to Delete This Transaction ??')) {
    //         $.ajax({
    //             url: `transaction/delete/details`,
    //             method: 'DELETE',
    //             data: { id: id },
    //             success: function (res) {
    //                 if (res.status == "success") {
    //                     if (updateTranId != "") {
    //                         getTransactionGrid(updateTranId, '.update_transaction_grid tbody', '#updateAmountRP', '#updateNetAmount', '#updateBalance', '#updateTotalDiscount', '#updateAdvance');
    //                     }
    //                     else if (tranId != "") {
    //                         getTransactionGrid(tranId, '.transaction_grid tbody', '#amountRP', '#netAmount', '#balance', '#totalDiscount', '#advance');
    //                     }
    //                     $('.details').load(location.href + ' .details');
    //                     $('#search').val('');
    //                     toastr.success('Transaction Details Deleted Successfully', 'Deleted!');
    //                 }
    //             }
    //         });
    //     }
    // });



    // /////////////// ------------------ Delete Transaction Main ajax part start ---------------- /////////////////////////////
    // $(document).on('click', '#deleteMain', function (e) {
    //     e.preventDefault();
    //     let id = $(this).data('id');
    //     if (confirm('Are You Sure to Delete This Transaction ??')) {
    //         $.ajax({
    //             url: `/transaction/delete/main`,
    //             method: 'DELETE',
    //             data: { id: id },
    //             success: function (res) {
    //                 if (res.status == "success") {
    //                     $('.details').load(location.href + ' .details');
    //                     $('#search').val('');
    //                     toastr.success('Transaction Main Data Deleted Successfully', 'Deleted!');
    //                 }
    //             }
    //         });
    //     }
    // });


    // /////////////// ------------------ Pagination ajax part start ---------------- /////////////////////////////
    // $(document).on('click', '.paginate a', function (e) {
    //     e.preventDefault();
    //     let type = "";
    //     let startDate = $('#startDate').val();
    //     let endDate = $('#endDate').val();
    //     let page = $(this).attr('href').split('page=')[1];
    //     searchTransaction(`/transaction/pagination?page=${page}`, { startDate: startDate, endDate: endDate, type: type });
    // });



    // /////////////// ------------------ Search ajax part start ---------------- /////////////////////////////
    // $(document).on('keyup', '#search', function (e) {
    //     e.preventDefault();
    //     let startDate = $('#startDate').val();
    //     let endDate = $('#endDate').val();
    //     let search = $(this).val();
    //     let type = "";
    //     let searchOption = $("#searchOption").val();
    //     if (searchOption == "1") {
    //         searchTransaction(`/transaction/search/tranid`, { search: search, startDate: startDate, endDate: endDate, type: type })
    //     }
    //     if (searchOption == "2") {
    //         searchTransaction(`/transaction/search/invoice`, { search: search, startDate: startDate, endDate: endDate, type: type })
    //     }
    //     if (searchOption == "3") {
    //         searchTransaction(`/transaction/search/with`, { search: search, startDate: startDate, endDate: endDate, type: type })
    //     }
    //     if (searchOption == "4") {
    //         searchTransaction(`/transaction/search/user`, { search: search, startDate: startDate, endDate: endDate, type: type })
    //     }
    // });






    // /////////////// ------------------ Search Pagination ajax part start ---------------- /////////////////////////////
    // $(document).on('click', '.search-paginate a', function (e) {
    //     e.preventDefault();
    //     $('.paginate').addClass('hidden');
    //     let startDate = $('#startDate').val();
    //     let endDate = $('#endDate').val();
    //     let search = $('#search').val();
    //     let type = "";
    //     let searchOption = $("#searchOption").val();
    //     let page = $(this).attr('href').split('page=')[1];
    //     if (searchOption == "1") {
    //         searchTransaction(`/transaction/pagination/tranid?page=${page}`, { search: search, startDate: startDate, endDate: endDate, type: type })
    //     }
    //     if (searchOption == "2") {
    //         searchTransaction(`/transaction/pagination/invoice?page=${page}`, { search: search, startDate: startDate, endDate: endDate, type: type })
    //     }
    //     if (searchOption == "3") {
    //         searchTransaction(`/transaction/pagination/with?page=${page}`, { search: search, startDate: startDate, endDate: endDate, type: type })
    //     }
    //     if (searchOption == "4") {
    //         searchTransaction(`/transaction/pagination/user?page=${page}`, { search: search, startDate: startDate, endDate: endDate, type: type })
    //     }

    // });



    // //get last transaction id by transaction type function
    // function getTransactionId(type, targetElement) {
    //     $.ajax({
    //         url: "/transaction/get/tranid",
    //         method: 'GET',
    //         data: { type: type },
    //         success: function (res) {
    //             if (res.status === 'success') {
    //                 $(targetElement).val(res.id);
    //                 getTransactionGrid(res.id, '.transaction_grid tbody', '#amountRP', '#netAmount', '#balance', '#totalDiscount', '#advance');
    //             }
    //             else {
    //                 $(targetElement).val(res.tran_id);
    //             }

    //         }
    //     });
    // }


    // //get last transaction with by transaction type function
    // function getTransactionWith(type, targetElement) {
    //     $.ajax({
    //         url: "/transaction/get/tranwith",
    //         method: 'GET',
    //         data: { type: type },
    //         success: function (res) {
    //             if (res.status === 'success') {
    //                 // Create options dynamically
    //                 $(targetElement).empty();
    //                 $(targetElement).append(`<option value="" }>Select Transaction With</option>`);
    //                 $.each(res.tranwith, function (key, withs) {
    //                     $(targetElement).append(`<option value="${withs.id}"}>${withs.tran_with_name}</option>`);
    //                 });
    //             }

    //         }
    //     });
    // }



    // //get last transaction id by transaction type function
    // function getTransactionGroupeByType(type, targetElement) {
    //     $.ajax({
    //         url: "/transaction/get/groupeby/type",
    //         method: 'GET',
    //         data: { type: type },
    //         success: function (res) {
    //             if (res.status === 'success') {
    //                 $(targetElement).html('');
    //                 $(targetElement).append(`<option value="" >Select Transaction Groupe</option>`);
    //                 $.each(res.groupes, function (key, groupe) {
    //                     $(targetElement).append(`<option value="${groupe.id}">${groupe.tran_groupe_name}</option>`);
    //                 });
    //             }
    //             else {
    //                 $(targetElement).val(res.tran_id);
    //             }

    //         }
    //     });
    // }


    // //Get Inserted Transacetion Grid By Transaction Id Function
    // function getTransactionGrid(tranId, grid, amount = "", total = "", balances = "", discount = "", advances = "") {
    //     $.ajax({
    //         url: "/transaction/get/transactiongrid",
    //         method: 'GET',
    //         data: { tranId: tranId },
    //         success: function (res) {
    //             if (res.status === 'success') {
    //                 $(grid).html(res.data);

    //                 let transactions = res.transaction.data;
    //                 // Calculate total amount
    //                 let totalAmount = transactions.reduce((sum, transaction) => sum + transaction.tot_amount, 0);
    //                 $(amount).val(totalAmount);

    //                 let totalDiscount = parseInt($(discount).val());
    //                 let advance = parseInt($(advances).val());

    //                 let netAmount = totalAmount - totalDiscount;
    //                 let balance = netAmount - advance;
    //                 $(total).val(netAmount);
    //                 $(balances).val(balance);
    //             }
    //             else {
    //                 $(grid).html('');
    //             }

    //         }
    //     });
    // };




    // // Search Transaction Details
    // function searchTransaction(url, data) {
    //     $.ajax({
    //         url: url,
    //         method: 'GET',
    //         data: data,
    //         success: function (res) {
    //             if (res.status === 'success') {
    //                 $('.details').html(res.data);
    //                 if (res.paginate) {
    //                     $('.details').append('<div class="center search-paginate" id="paginate">' + res.paginate + '</div>');
    //                 }
    //             }
    //             else {
    //                 $('.details').html(`<span class="text-danger">Result not Found </span>`);
    //             }
    //         }
    //     });
    // }

// });