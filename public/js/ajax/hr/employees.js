







$(document).ready(function () {

    //Show Employee Experience Details on details modal
    $(document).on('click', '.EmployeeExperienceDetails', function (e) {
        let modal = $(this).attr('data-modal-id');
        let id = $(this).attr('data-id');
        $.ajax({
            url: "/new/employee/experience",
            method: 'GET',
            data: {id:id},
            success: function (res) {
                $("#"+ modal).show();
                $('.employeeexperiencedetails').html(res.data)
            },
            error: function (err) {
                console.log(err)
            }
        });
    });

    

    ///////////// ------------------ Edit Employee ajax part start ---------------- /////////////////////////////
    $(document).on('click', '.EmployeeEdit', function () {
        let modalId = $(this).data('modal-id');
        let id = $(this).data('id');
        $.ajax({
            url: `/employees/edit`,
            method: 'GET',
            data: { id:id },
            success: function (res) {
                $('#id').val(id);
                $('#employee_id').val(res.employeeinfo.employee_id);
                $('#update_name').val(res.employeeinfo.name);
                $('#update_name').focus();
                $('#update_fathers_name').val(res.employeeinfo.fathers_name);
                $('#update_mothers_name').val(res.employeeinfo.mothers_name);
                $('#update_date_of_birth').val(res.employeeinfo.date_of_birth);
                $('#update_religion').val(res.employeeinfo.religion);
                $('#update_marital_status').val(res.employeeinfo.marital_status);
                $('#update_nationality').val(res.employeeinfo.nationality);
                $('#update_phn_no').val(res.employeeinfo.phn_no);
                $('#update_blood_group').val(res.employeeinfo.blood_group);
                $('#update_email').val(res.employeeinfo.email);
                $('#update_address').val(res.employeeinfo.address)

                // Create options dynamically based on the status value
                $('#update_gender').empty();
                $('#update_gender').append(`<option value="male" ${res.employeeinfo.gender === 'male' ? 'selected' : ''}>Male</option>
                                         <option value="female" ${res.employeeinfo.gender === 'female' ? 'selected' : ''}>Female</option>
                                         <option value="others" ${res.employeeinfo.gender === 'others' ? 'selected' : ''}>Others</option>`);
                $('#updatePreviewImage').attr('src',`/storage/profiles/${res.employee.image}`).show();

                var modal = document.getElementById(modalId);
                modal.style.display = 'block';


                $('#emp_id').val(res.employeeinfo.emp_id);
                $('#update_level_of_education').val(res.employeeinfo.level_of_education);
                $('#update_degree_title').val(res.employeeinfo.degree_title);
                $('#update_group').val(res.employeeinfo.group);
                $('#update_institution_name').val(res.employeeinfo.institution_name);
                $('#update_result').val(res.employeeinfo.designation.result);
                $('#update_scale').val(res.employeeinfo.designation.scale);
                $('#update_cgpa').val(res.employeeinfo.cgpa);
                $('#update_batch').val(res.employeeinfo.batch);
                $('#update_passing_year').val(res.employeeinfo.passing_year);
                

                $('#emp_id').val(res.employeeinfo.emp_id);
                $('#update_training_title').val(res.employeeinfo.training_title);
                $('#update_country').val(res.employeeinfo.country);
                $('#update_topic').val(res.employeeinfo.topic);
                $('#update_institution_name1').val(res.employeeinfo.institution_name);
                $('#update_start_date').val(res.employeeinfo.start_date);
                $('#update_end_date').val(res.employeeinfo.end_date);
                $('#update_training_year').val(res.employeeinfo.training_year);
        

                $('#emp_id').val(res.employeeinfo.emp_id);
                $('#update_company_name').val(res.employeeinfo.company_name);
                $('#update_designation').val(res.employeeinfo.designation);
                $('#update_start_date').val(res.employeeinfo.designation.start_date);
                $('#update_end_date').val(res.employeeinfo.end_date);
                $('#update_department').val(res.employeeinfo.department);
                $('#update_company_location').val(res.employeeinfo.company_location);


                $('#emp_id').val(res.employeeinfo.emp_id);
                $('#update_joining_date').val(res.employeeinfo.location.joining_date);
                $('#update_joining_location').val(res.employeeinfo.joining_location);
                $('#update_department1').val(res.employeeinfo.designation.department);
                $('#update_designation1').val(res.employeeinfo.designation);
            
            },
            error: function (err) {
                console.log(err);
            }
        });
    });



    /////////////// ------------------ Update Employees ajax part start ---------------- /////////////////////////////
    $(document).on('submit', '#EmployeeEditForm', function (e) {
        $.ajax({
            url: `/employees/update`,
            method: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            beforeSend:function() {
                $(document).find('span.error').text('');  
            },
            success: function (res) {
                if (res.status == "success") {
                    $('#EmployeeEdit').hide();
                    $('#EditEmployeeForm')[0].reset();
                    $('#search').val('');
                    $('.employeeinfo').load(location.href + ' .employeeinfo');
                    toastr.success('Employee Updated Successfully', 'Updated!');
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

    /////////////// ------------------ Delete Employee ajax part start ---------------- /////////////////////////////
    $(document).on('click', '#delete', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
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