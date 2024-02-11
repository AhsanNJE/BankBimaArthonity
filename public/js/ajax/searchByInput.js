$(document).ready(function () {
    /////////////// ------------------ Search Department by name and add value to input ajax part start ---------------- /////////////////////////////
    //search Department on add modal
    $(document).on('keyup', '#department', function () {
        let department = $(this).val();
        $('#department').removeAttr('data-id');
        $('#designation').removeAttr('data-id');
        $('#designation').val('');
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
        $('#updateDesignation').removeAttr('data-id');
        $('#updateDesignation').val('');
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
    



    /////////////// ------------------ Search Designation by name and Department and add value to input ajax part start ---------------- /////////////////////////////
    //search Designation on add modal
    $(document).on('keyup', '#designation', function () {
        let department = $('#department').attr('data-id');
        let designation = $(this).val();
        $('#designation').removeAttr('data-id');
        getDesignationByNameAndDepartment(designation,  '#designation-list ul', department);
    });

    //add list value in Designation input of add modal
    $(document).on('click', '#designation-list li', function () {
        let value = $(this).text();
        let id = $(this).data('id');
        $('#designation').val(value);
        $('#designation').attr('data-id', id);
        $('#designation-list ul').html('');
    });

    //search Designation on edit modal
    $(document).on('keyup', '#updateDesignation', function () {
        let department = $('#updateDepartment').attr('data-id');
        let designation = $(this).val();
        $('#updateDesignation').removeAttr('data-id');
        getDesignationByNameAndDepartment(designation,  '#update-designation ul', department);
    });


    //add list value in Designation input of add modal
    $(document).on('click', '#update-designation li', function () {
        let value = $(this).text();
        let id = $(this).data('id');
        $('#updateDesignation').val(value);
        $('#updateDesignation').attr('data-id', id);
        $('#update-designation ul').html('');
    });



    //search Designation by name
    function getDesignationByNameAndDepartment(designation, targetElement1, department="") {
        $.ajax({
            url: "/admin/employees/getDesignationByName/department",
            method: 'get',
            data: {designation:designation, department:department},
            success: function (res) {
                $(targetElement1).html(res);
            }
        });
    }

    /////////////// ------------------ Search Designation by name and Department and add value to input ajax part end ---------------- /////////////////////////////
    


    /////////////// ------------------ Search Location by Thana and add value to input ajax part start ---------------- /////////////////////////////
    //search Location on add modal
    $(document).on('keyup', '#location', function () {
        let location = $(this).val();
        $('#location').removeAttr('data-id');
        getLocationByThana(location,  '#location-list ul');
    });

    //add list value in Location input of add modal
    $(document).on('click', '#location-list li', function () {
        let value = $(this).text();
        let id = $(this).data('id');
        $('#location').val(value);
        $('#location').attr('data-id', id);
        $('#location-list ul').html('');
    });

    //search Location on edit modal
    $(document).on('keyup', '#updateLocation', function () {
        let location = $(this).val();
        $('#updateLocation').removeAttr('data-id');
        getLocationByThana(location,  '#update-location ul');
    });


    //add list value in Location input of add modal
    $(document).on('click', '#update-location li', function () {
        let value = $(this).text();
        let id = $(this).data('id');
        $('#updateLocation').val(value);
        $('#updateLocation').attr('data-id', id);
        $('#update-location ul').html('');
    });



    //search Location by Thana
    function getLocationByThana(location, targetElement1) {
        $.ajax({
            url: "/admin/employees/getLocationByThana",
            method: 'get',
            data: {location:location},
            success: function (res) {
                $(targetElement1).html(res);
            }
        });
    }

    /////////////// ------------------ Search Location by Thana and add value to input ajax part end ---------------- /////////////////////////////
    



    /////////////// ------------------ Search Transaction Groupe and add value to input ajax part start ---------------- /////////////////////////////
    //search Transaction Groupe on add modal
    $(document).on('keyup', '#groupe', function () {
        let groupe = $(this).val();
        $('#groupe').removeAttr('data-id');
        getTransactionGroupeByName(groupe,  '#groupe-list ul');
    });

    //add list value in Transaction Groupe input of add modal
    $(document).on('click', '#groupe-list li', function () {
        let value = $(this).text();
        let id = $(this).data('id');
        $('#groupe').val(value);
        $('#groupe').attr('data-id', id);
        $('#groupe-list ul').html('');
    });

    //search Transaction Groupe on edit modal
    $(document).on('keyup', '#updateGroupe', function () {
        let groupe = $(this).val();
        $('#updateGroupe').removeAttr('data-id');
        getTransactionGroupeByName(groupe,  '#update-groupe ul');
    });


    //add list value in Transaction Groupe input of add modal
    $(document).on('click', '#update-groupe li', function () {
        let value = $(this).text();
        let id = $(this).data('id');
        $('#updateGroupe').val(value);
        $('#updateGroupe').attr('data-id', id);
        $('#update-groupe ul').html('');
    });



    //search Transaction Groupe by Name
    function getTransactionGroupeByName(groupe, targetElement1) {
        $.ajax({
            url: "/transaction/getGroupeByName",
            method: 'get',
            data: {groupe:groupe},
            success: function (res) {
                $(targetElement1).html(res);
            }
        });
    }

    /////////////// ------------------ Search Location by Thana and add value to input ajax part end ---------------- /////////////////////////////
    
   
});