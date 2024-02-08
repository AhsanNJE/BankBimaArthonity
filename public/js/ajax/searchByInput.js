$(document).ready(function () {
    /////////////// ------------------ Search Department by name and add value to input ajax part start ---------------- /////////////////////////////
    //search Department on add modal
    $(document).on('keyup', '#department', function () {
        let department = $(this).val();
        console.log(department);
        $('#department').removeAttr('data-id');
        getDepartmentByName(department, '#department-list ul');
    });

    //add list value in Department input of add modal
    $(document).on('click', '#department-list li', function () {
        let value = $(this).text();
        let id = $(this).data('id');
        $('#department').val(value);
        $('#department').attr('data-id', id);
        $('#department-list ul').html('');
    });

    //search Department on edit modal
    $(document).on('keyup', '#updateDepartment', function () {
        let department = $(this).val();
        $('#updateDepartment').removeAttr('data-id');
        getDepartmentByName(department, '#update-department ul');
    });


    //add list value in Department input of add modal
    $(document).on('click', '#update-department li', function () {
        let value = $(this).text();
        let id = $(this).data('id');
        $('#updateDepartment').val(value);
        $('#updateDepartment').attr('data-id', id);
        $('#update-department ul').html('');
    });



    //search Department by name
    function getDepartmentByName(department, targetElement1) {
        $.ajax({
            url: "/admin/employees/getDepartmentByName",
            method: 'get',
            data: {department:department},
            success: function (res) {
                $(targetElement1).html(res);
            }
        });
    }

    /////////////// ------------------ Search Department by name and add value to input ajax part end ---------------- /////////////////////////////
    
   
});