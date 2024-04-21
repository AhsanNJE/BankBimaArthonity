//Organization Detail Input Field Empty Error
$(document).on('submit', '#AddOrganizationDetailForm', function (e) {
    e.preventDefault();
    let user = $('#user').attr('data-id');
    let locations = $('#location').attr('data-id');
    let department = $('#department').attr('data-id');
    let designation = $('#designation').attr('data-id');
    let formData = new FormData(this);
    formData.append('user', user === undefined ? '' : user);
    formData.append('location', locations === undefined ? '' : locations);
    formData.append('department', department === undefined ? '' : department);
    formData.append('designation', designation === undefined ? '' : designation);
    
    $.ajax({
        url: "/insert/organization/info",
        method: 'POST',
        processData: false,
        contentType: false,
        cache: false,
        data: formData,
        beforeSend:function() {
            $(document).find('span.error').text('');  
        },
        success: function (res) {
            console.log(res)
            if (res.status == "success") {
                $('#AddOrganizationDetailForm')[0].reset();
                $('#name').focus();
                $('#user').removeAttr('data-id');
                $('#location').removeAttr('data-id');
                $('#search').val('');
                $('.employee').load(location.href + ' .employee');
                $('#previewImage').attr('src',`#`).hide();
                toastr.success('Organization Detail Added Successfully', 'Added!');
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

$(document).ready(function () {
    //Show Employee Organization Details on details modal
    $(document).on('click', '.EmployeeOrganizationDetails', function (e) {
        let modal = $(this).attr('data-modal-id');
        let id = $(this).attr('data-id');
        $.ajax({
            url: "/new/employee/organization",
            method: 'GET',
            data: {id:id},
            success: function (res) {
                $("#"+ modal).show();
                $('.employeeorganizationdetails').html(res.data)
            },
            error: function (err) {
                console.log(err)
            }
        });
    });
/////////////// ------------------ Delete Employee ajax part start ---------------- /////////////////////////////
$(document).on('click', '#delete', function (e) {
    e.preventDefault();
    let id = $(this).data('emp_id');
    if (confirm('Are You Sure to Delete This Employee ??')) {
        $.ajax({
            url: `/employees/delete`,
            method: 'DELETE',
            data: { id:id },
            success: function (res) {
                if (res.status == "success") {
                    $('.employee').load(location.href + ' .employee');
                    $('#search').val('');
                    toastr.success('Employee Deleted Successfully', 'Deleted!');
                }
            }
        });
    }
});

});