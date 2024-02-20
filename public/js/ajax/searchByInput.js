$(document).ready(function () {
    /////////////// ------------------ Search Department by name and add value to input ajax part start ---------------- /////////////////////////////
    //search Department on add modal
    $(document).on('keyup', '#department', function (e) {
        let department = $(this).val();
        let id = $(this).attr('data-id');
        DepartmentKeyUp(e, department, id, '#department', '#designation', '#department-list ul');
    });


    $(document).on('keydown', '#department', function (e) {
        let list = $('#department-list ul li');
        DepartmentKeyDown(e, list, '#department');
    });

    $(document).on('keydown', '#department-list ul li', function (e) {
        let list = $('#department-list ul li');
        let focused = $('#department-list ul li:focus');
        DepartmentListKeyDown(e, list, focused, '#department', '#department-list ul');
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
    $(document).on('keyup', '#updateDepartment', function (e) {
        let department = $(this).val();
        let id = $(this).attr('data-id');
        DepartmentKeyUp(e, department, id, '#updateDepartment', '#updateDesignation', '#update-department ul');
    });


    $(document).on('keydown', '#updateDepartment', function (e) {
        let list = $('#update-department ul li');
        DepartmentKeyDown(e, list, '#updateDepartment');
    });

    $(document).on('keydown', '#update-department ul li', function (e) {
        let list = $('#update-department ul li');
        let focused = $('#update-department ul li:focus');
        DepartmentListKeyDown(e, list, focused, '#updateDepartment', '#update-department ul');
    });


    //add list value in Department input of add modal
    $(document).on('click', '#update-department li', function () {
        let value = $(this).text();
        let id = $(this).data('id');
        $('#updateDepartment').val(value);
        $('#updateDepartment').attr('data-id', id);
        $('#update-department ul').html('');
    });



    // Department Key Up Event Function
    function DepartmentKeyUp(e, department, id, targetElement1, targetElement2, targetElement3){
        if (e.keyCode === 13) { // Enter Key
            e.preventDefault();
        }
        else if ((e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 8){
            //keyCode 65 = a, keyCode 90 = z, keyCode 96 = 0, keyCode 105 = 9, keyCode 8 = backSpace
            $(targetElement1).removeAttr('data-id');
            $(targetElement2).removeAttr('data-id');
            $(targetElement2).val('');
            getDepartmentByName(department, targetElement3);
        }
        else if (e.keyCode === 9) { // Tab key
            if (id != undefined) {
                e.preventDefault();
            }
            else{
                $(targetElement1).removeAttr('data-id');
                $(targetElement2).removeAttr('data-id');
                $(targetElement2).val('');
                getDepartmentByName(department, targetElement3);
            }
        }
    }


    // Department Key Down Event Function
    function DepartmentKeyDown(e, list, targetElement1) {
        if (list.length > 0) {
            if (e.keyCode === 40) { // Down arrow key
                e.preventDefault();
                list.first().focus();
                $(targetElement1).val(list.first().text());
                $(targetElement1).attr("data-id", list.data('id'));
            } else if (e.keyCode === 38) { // Up arrow key
                e.preventDefault();
                list.last().focus();
                $(targetElement1).val(list.last().text());
                $(targetElement1).attr("data-id", list.data('id'));
            } else if (e.keyCode === 13) { // Enter key
                e.preventDefault();
            }
        }
    }


    // Department List Key Down Event function
    function DepartmentListKeyDown(e, list, focused, targetElement1, targetElement2) {
        if (e.keyCode === 40) { // Down arrow key
            e.preventDefault();
            let nextIndex = focused.index() + 1;
            if (nextIndex >= list.length) {
                nextIndex = 0; // Loop to the first item
            }
            list.eq(nextIndex).focus();
            $(targetElement1).val(list.eq(nextIndex).text());
            $(targetElement1).attr("data-id", list.eq(nextIndex).data('id'));
        } 
        else if (e.keyCode === 38) { // Up arrow key
            e.preventDefault();
            let prevIndex = focused.index() - 1;
            if (prevIndex < 0) {
                prevIndex = list.length - 1; // Loop to the last item
            }
            list.eq(prevIndex).focus();
            $(targetElement1).val(list.eq(prevIndex).text());
            $(targetElement1).attr("data-id", list.eq(prevIndex).data('id'));
        } 
        else if (e.keyCode === 13) { // Enter key
            e.preventDefault();
            $(targetElement2).html('');
            $(targetElement1).focus();
        }
    }

    //search Department by name
    function getDepartmentByName(department, targetElement1) {
        $.ajax({
            url: "/admin/employees/getDepartmentByName",
            method: 'get',
            data: { department: department },
            success: function (res) {
                $(targetElement1).html(res);
            }
        });
    }

    /////////////// ------------------ Search Department by name and add value to input ajax part end ---------------- /////////////////////////////




    /////////////// ------------------ Search Designation by name and Department and add value to input ajax part start ---------------- /////////////////////////////
    //search Designation on add modal
    $(document).on('keyup', '#designation', function (e) {
        let department = $('#department').attr('data-id');
        let designation = $(this).val();
        let id = $(this).attr('data-id');
        DesignationKeyUp(e, department, designation, id, '#designation', '#designation-list ul');
    });

    // Designation Key Down Event
    $(document).on('keydown', '#designation', function (e) {
        let list = $('#designation-list ul li');
        DesignationKeyDown(e, list, '#designation');
    });


    // Designation List key Down Event
    $(document).on('keydown', '#designation-list ul li', function (e) {
        let list = $('#designation-list ul li');
        let focused = $('#designation-list ul li:focus');
        DesignationListKeyDown(e, list, focused, '#designation', '#designation-list ul');
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
    $(document).on('keyup', '#updateDesignation', function (e) {
        let department = $('#updateDepartment').attr('data-id');
        let designation = $(this).val();
        let id = $(this).attr('data-id');
        DesignationKeyUp(e, department, designation, id, '#updateDesignation', '#update-designation ul');
    });


    // Designation Key Down Event
    $(document).on('keydown', '#updateDesignation', function (e) {
        let list = $('#update-designation ul li');
        DesignationKeyDown(e, list, '#updateDesignation');
    });


    // Designation List key Down Event
    $(document).on('keydown', '#update-designation ul li', function (e) {
        let list = $('#update-designation ul li');
        let focused = $('#update-designation ul li:focus');
        DesignationListKeyDown(e, list, focused, '#updateDesignation', '#update-designation ul');
    });


    //add list value in Designation input of add modal
    $(document).on('click', '#update-designation li', function () {
        let value = $(this).text();
        let id = $(this).data('id');
        $('#updateDesignation').val(value);
        $('#updateDesignation').attr('data-id', id);
        $('#update-designation ul').html('');
    });



    // Designation Key Up Event Function
    function DesignationKeyUp(e, department, designation, id, targetElement1, targetElement2){
        if (e.keyCode === 13) { // Enter Key
            e.preventDefault();
        }
        else if ((e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 8){
            //keyCode 65 = a, keyCode 90 = z, keyCode 96 = 0, keyCode 105 = 9, keyCode 8 = backSpace
            $(targetElement1).removeAttr('data-id');
            getDesignationByNameAndDepartment(designation, targetElement2, department);
        }
        else if (e.keyCode === 9) { // Tab key
            if (id != undefined) {
                e.preventDefault();
            }
            else{
                $(targetElement1).removeAttr('data-id');
                getDesignationByNameAndDepartment(designation, targetElement2, department);
            }
        }
    }


    // Designation Key Down Event Function
    function DesignationKeyDown(e, list, targetElement1) {
        if (list.length > 0) {
            if (e.keyCode === 40) { // Down arrow key
                e.preventDefault();
                list.first().focus();
                $(targetElement1).val(list.first().text());
                $(targetElement1).attr("data-id", list.data('id'));
            } else if (e.keyCode === 38) { // Up arrow key
                e.preventDefault();
                list.last().focus();
                $(targetElement1).val(list.last().text());
                $(targetElement1).attr("data-id", list.data('id'));
            } else if (e.keyCode === 13) { // Enter key
                e.preventDefault();
            }
        }
    }
    

    // Department List Key Down Event function
    function DesignationListKeyDown(e, list, focused, targetElement1, targetElement2) {
        if (e.keyCode === 40) { // Down arrow key
            e.preventDefault();
            let nextIndex = focused.index() + 1;
            if (nextIndex >= list.length) {
                nextIndex = 0; // Loop to the first item
            }
            list.eq(nextIndex).focus();
            $(targetElement1).val(list.eq(nextIndex).text());
            $(targetElement1).attr("data-id", list.eq(nextIndex).data('id'));
        } 
        else if (e.keyCode === 38) { // Up arrow key
            e.preventDefault();
            let prevIndex = focused.index() - 1;
            if (prevIndex < 0) {
                prevIndex = list.length - 1; // Loop to the last item
            }
            list.eq(prevIndex).focus();
            $(targetElement1).val(list.eq(prevIndex).text());
            $(targetElement1).attr("data-id", list.eq(prevIndex).data('id'));
        } 
        else if (e.keyCode === 13) { // Enter key
            e.preventDefault();
            $(targetElement2).html('');
            $(targetElement1).focus();
        }
    }


    //search Designation by name
    function getDesignationByNameAndDepartment(designation, targetElement1, department = "") {
        $.ajax({
            url: "/admin/employees/getDesignationByName/department",
            method: 'get',
            data: { designation: designation, department: department },
            success: function (res) {
                $(targetElement1).html(res);
            }
        });
    }

    /////////////// ------------------ Search Designation by name and Department and add value to input ajax part end ---------------- /////////////////////////////



    /////////////// ------------------ Search Location by Thana and add value to input ajax part start ---------------- /////////////////////////////
    //search Location on add modal
    $(document).on('keyup', '#location', function (e) {
        let location = $(this).val();
        let id = $(this).attr('data-id');
        LocationKeyUp(e, location, id, '#location', '#location-list ul');
    });


    // Location Key Down Event
    $(document).on('keydown', '#location', function (e) {
        let list = $('#location-list ul li');
        LocationKeyDown(e, list, '#location');
    });


    // Location List key Down Event
    $(document).on('keydown', '#location-list ul li', function (e) {
        let list = $('#location-list ul li');
        let focused = $('#location-list ul li:focus');
        LocationListKeyDown(e, list, focused, '#location', '#location-list ul');
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
    $(document).on('keyup', '#updateLocation', function (e) {
        let location = $(this).val();
        let id = $(this).attr('data-id');
        LocationKeyUp(e, location, id, '#updateLocation', '#update-location ul');
    });


    // Update Location Key Down Event
    $(document).on('keydown', '#updateLocation', function (e) {
        let list = $('#update-location ul li');
        LocationKeyDown(e, list, '#updateLocation');
    });


    // Update Location List key Down Event
    $(document).on('keydown', '#update-location ul li', function (e) {
        let list = $('#update-location ul li');
        let focused = $('#update-location ul li:focus');
        LocationListKeyDown(e, list, focused, '#updateLocation', '#update-location ul');
    });


    //add list value in Location input of add modal
    $(document).on('click', '#update-location li', function () {
        let value = $(this).text();
        let id = $(this).data('id');
        $('#updateLocation').val(value);
        $('#updateLocation').attr('data-id', id);
        $('#update-location ul').html('');
    });


    // Location Key Up Event Function
    function LocationKeyUp(e, location, id, targetElement1, targetElement2){
        if (e.keyCode === 13) { // Enter Key
            e.preventDefault();
        }
        else if ((e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 8){
            //keyCode 65 = a, keyCode 90 = z, keyCode 96 = 0, keyCode 105 = 9, keyCode 8 = backSpace
            $(targetElement1).removeAttr('data-id');
            getLocationByThana(location, targetElement2);
        }
        else if (e.keyCode === 9) { // Tab key
            if (id != undefined) {
                e.preventDefault();
            }
            else{
                $(targetElement1).removeAttr('data-id');
                getLocationByThana(location, targetElement2);
            }
        }
    }


    // Location Key Down Event Function
    function LocationKeyDown(e, list, targetElement1) {
        if (list.length > 0) {
            if (e.keyCode === 40) { // Down arrow key
                e.preventDefault();
                list.first().focus();
                $(targetElement1).val(list.first().text());
                $(targetElement1).attr("data-id", list.data('id'));
            } else if (e.keyCode === 38) { // Up arrow key
                e.preventDefault();
                list.last().focus();
                $(targetElement1).val(list.last().text());
                $(targetElement1).attr("data-id", list.data('id'));
            } else if (e.keyCode === 13) { // Enter key
                e.preventDefault();
            }
        }
    }
    

    // Location List Key Down Event function
    function LocationListKeyDown(e, list, focused, targetElement1, targetElement2) {
        if (e.keyCode === 40) { // Down arrow key
            e.preventDefault();
            let nextIndex = focused.index() + 1;
            if (nextIndex >= list.length) {
                nextIndex = 0; // Loop to the first item
            }
            list.eq(nextIndex).focus();
            $(targetElement1).val(list.eq(nextIndex).text());
            $(targetElement1).attr("data-id", list.eq(nextIndex).data('id'));
        } 
        else if (e.keyCode === 38) { // Up arrow key
            e.preventDefault();
            let prevIndex = focused.index() - 1;
            if (prevIndex < 0) {
                prevIndex = list.length - 1; // Loop to the last item
            }
            list.eq(prevIndex).focus();
            $(targetElement1).val(list.eq(prevIndex).text());
            $(targetElement1).attr("data-id", list.eq(prevIndex).data('id'));
        } 
        else if (e.keyCode === 13) { // Enter key
            e.preventDefault();
            $(targetElement2).html('');
            $(targetElement1).focus();
        }
    }

    //search Location by Thana
    function getLocationByThana(location, targetElement1) {
        $.ajax({
            url: "/admin/employees/getLocationByThana",
            method: 'get',
            data: { location: location },
            success: function (res) {
                $(targetElement1).html(res);
            }
        });
    }

    /////////////// ------------------ Search Location by Thana and add value to input ajax part end ---------------- /////////////////////////////

    

    ////////////// ------------------- Search Transaction user and add value to input ajax part start --------------- ////////////////////////////
    //search Transaction User on add modal
    $(document).on('keyup', '#user', function (e) {
        let tranUser = $(this).val();
        let tranUserType = $('#with').val();
        let id = $(this).attr('data-id');
        UserKeyUp(e, tranUserType, tranUser, id, '#user', '#user-list ul');
        
    });



    // User Key Down Event
    $(document).on('keydown', '#user', function (e) {
        let list = $('#user-list ul li');
        UserKeyDown(e, list, '#user');
    });



    // User List key Down Event
    $(document).on('keydown', '#user-list ul li', function (e) {
        let list = $('#user-list ul li');
        let focused = $('#user-list ul li:focus');
        UserListKeyDown(e, list, focused, '#user', '#user-list ul');
    });



    //add list value in Transaction User input of add modal
    $(document).on('click', '#user-list li', function () {
        let value = $(this).text();
        let id = $(this).data('id');
        $('#user').val(value);
        $('#user').attr('data-id', id);
        $('#user-list ul').html('');
    });



    //search Transaction User on edit modal
    $(document).on('keyup', '#updateUser', function (e) {
        let tranUser = $(this).val();
        let tranUserType = $('#with').val();
        let id = $(this).attr('data-id');
        UserKeyUp(e, tranUserType, tranUser, id, '#updateUser', '#update-user ul');
    });



    // Update User Key Down Event
    $(document).on('keydown', '#updateUser', function (e) {
        let list = $('#update-user ul li');
        UserKeyDown(e, list, '#updateUser');
    });



    // Update User List key Down Event
    $(document).on('keydown', '#update-user ul li', function (e) {
        let list = $('#update-user ul li');
        let focused = $('#update-user ul li:focus');
        UserListKeyDown(e, list, focused, '#updateUser', '#update-user ul');
    });



    //add list value in Transaction User input of add modal
    $(document).on('click', '#update-user li', function () {
        let value = $(this).text();
        let id = $(this).data('id');
        $('#updateUser').val(value);
        $('#updateUser').attr('data-id', id);
        $('#update-user ul').html('');
    });



    // User Key Up Event Function
    function UserKeyUp(e, tranUserType, tranUser, id, targetElement1, targetElement2){
        if (e.keyCode === 13) { // Enter Key
            e.preventDefault();
        }
        else if ((e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 8){
            //keyCode 65 = a, keyCode 90 = z, keyCode 96 = 0, keyCode 105 = 9, keyCode 8 = backSpace
            $(targetElement1).removeAttr('data-id');
            getTransactionUser(tranUserType, tranUser, targetElement2);
        }
        else if (e.keyCode === 9) { // Tab key
            if (id != undefined) {
                e.preventDefault();
            }
            else{
                $(targetElement1).removeAttr('data-id');
                getTransactionUser(tranUserType, tranUser, targetElement2);
            }
        }
    }



    // User Key Down Event Function
    function UserKeyDown(e, list, targetElement1) {
        if (list.length > 0) {
            if (e.keyCode === 40) { // Down arrow key
                e.preventDefault();
                list.first().focus();
                $(targetElement1).val(list.first().text());
                $(targetElement1).attr("data-id", list.data('id'));
            } else if (e.keyCode === 38) { // Up arrow key
                e.preventDefault();
                list.last().focus();
                $(targetElement1).val(list.last().text());
                $(targetElement1).attr("data-id", list.data('id'));
            } else if (e.keyCode === 13) { // Enter key
                e.preventDefault();
            }
        }
    }
    


    // User List Key Down Event function
    function UserListKeyDown(e, list, focused, targetElement1, targetElement2) {
        if (e.keyCode === 40) { // Down arrow key
            e.preventDefault();
            let nextIndex = focused.index() + 1;
            if (nextIndex >= list.length) {
                nextIndex = 0; // Loop to the first item
            }
            list.eq(nextIndex).focus();
            $(targetElement1).val(list.eq(nextIndex).text());
            $(targetElement1).attr("data-id", list.eq(nextIndex).data('id'));
        } 
        else if (e.keyCode === 38) { // Up arrow key
            e.preventDefault();
            let prevIndex = focused.index() - 1;
            if (prevIndex < 0) {
                prevIndex = list.length - 1; // Loop to the last item
            }
            list.eq(prevIndex).focus();
            $(targetElement1).val(list.eq(prevIndex).text());
            $(targetElement1).attr("data-id", list.eq(prevIndex).data('id'));
        } 
        else if (e.keyCode === 13) { // Enter key
            e.preventDefault();
            $(targetElement2).html('');
            $(targetElement1).focus();
        }
    }



    //search Transaction User by Name
    function getTransactionUser(tranUserType, tranUser, targetElement1) {
        $.ajax({
            url: "/transaction/getTranUser",
            method: 'get',
            data: { tranUserType: tranUserType, tranUser: tranUser },
            success: function (res) {
                $(targetElement1).html(res);
            }
        });
    }

    ////////////// ------------------- Search Transaction user and add value to input ajax part end --------------- ////////////////////////////


    // $(document).on('focusout', '#department, #designation, #location, #groupe, #user, #updateDepartment, #updateDesignation, #updateLocation, #updateGroupe, #updateUser', function() {
    //     // Check if no li element within div[id$="-list"] or div[id^="update-"] has focus
    //     if (!$('div[id$="-list"] li:focus').length && !$('div[id^="update-"] li:focus').length) {
    //         $('div[id$="-list"] ul').html('');
    //         $('div[id^="update-"] ul').html('');
    //     }
    // });
});