$(document).ready(function () {
    /////////////// ------------------ Search Department by name and add value to input ajax part start ---------------- /////////////////////////////
    //Department Keyup Event
    $(document).on('keyup', '#department', function (e) {
        let department = $(this).val();
        let id = $(this).attr('data-id');
        DepartmentKeyUp(e, department, id, '#department', '#designation', '#department-list ul');
    });

    // Department Key down Event
    $(document).on('keydown', '#department', function (e) {
        let list = $('#department-list ul li');
        DepartmentKeyDown(e, list, '#department', '#department-list ul');
    });


    // Department List Key down Event
    $(document).on('keydown', '#department-list ul li', function (e) {
        let list = $('#department-list ul li');
        let focused = $('#department-list ul li:focus');
        DepartmentListKeyDown(e, list, focused, '#department', '#department-list ul');
    });


    // Department Focus Event
    $(document).on('focus', '#department', function (e) {
        let department = $(this).val();
        let id = $(this).attr('data-id');
        if(id == undefined){
            getDepartmentByName(department, '#department-list ul');
        }
        else{
            e.preventDefault();
        }
    });


    // Department Focous out event
    $(document).on('focusout', '#department', function (e) {
        let id = $(this).attr('data-id');
        if(id == undefined){
            $(document).on('click', function (e){
                if($(e.target).attr('tabindex') == undefined){
                    $('#department-list ul').html('');
                }
            });
        }
    });


    // Department List Click Event
    $(document).on('click', '#department-list li', function () {
        let value = $(this).text();
        let id = $(this).data('id');
        $('#department').val(value);
        $('#department').attr('data-id', id);
        $('#department-list ul').html('');
    });



    // Update Department Keyup event
    $(document).on('keyup', '#updateDepartment', function (e) {
        let department = $(this).val();
        let id = $(this).attr('data-id');
        DepartmentKeyUp(e, department, id, '#updateDepartment', '#updateDesignation', '#update-department ul');
    });



    // Update Department Keydown event
    $(document).on('keydown', '#updateDepartment', function (e) {
        let list = $('#update-department ul li');
        DepartmentKeyDown(e, list, '#updateDepartment', '#update-department ul');
    });



    // Update Department List Keydown event
    $(document).on('keydown', '#update-department ul li', function (e) {
        let list = $('#update-department ul li');
        let focused = $('#update-department ul li:focus');
        DepartmentListKeyDown(e, list, focused, '#updateDepartment', '#update-department ul');
    });



    // Update Department Focus Event
    $(document).on('focus', '#updateDepartment', function (e) {
        let department = $(this).val();
        let id = $(this).attr('data-id');
        if(id == undefined){
            getDepartmentByName(department, '#update-department ul');
        }
        else{
            e.preventDefault();
        }
    });


    
    // Update Department Focousout event
    $(document).on('focusout', '#updateDepartment', function (e) {
        let id = $(this).attr('data-id');
        if(id == undefined){
            $(document).on('click', function (e){
                if($(e.target).attr('tabindex') == undefined){
                    $('#update-department ul').html('');
                }
            });
        }
    });


    // Update Department Click Event
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
    function DepartmentKeyDown(e, list, targetElement1, targetElement2) {
        if (list.length > 0) {
            if (e.keyCode === 40) { // Down arrow key
                e.preventDefault();
                list.first().focus();
                $(targetElement1).val(list.first().text());
                $(targetElement1).attr("data-id", list.data('id'));
            } 
            else if (e.keyCode === 38) { // Up arrow key
                e.preventDefault();
                list.last().focus();
                $(targetElement1).val(list.last().text());
                $(targetElement1).attr("data-id", list.data('id'));
            } 
            else if (e.keyCode === 13) { // Enter key
                e.preventDefault();
            } 
            else if (e.keyCode === 9) { // Tab key
                $(targetElement2).html('');
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

    // Search Department by Name
    function getDepartmentByName(department, targetElement1) {
        $.ajax({
            url: "/admin/employees/get/department/name",
            method: 'GET',
            data: { department: department },
            success: function (res) {
                $(targetElement1).html(res);
            }
        });
    }

    /////////////// ------------------ Search Department by name and add value to input ajax part end ---------------- /////////////////////////////




    /////////////// ------------------ Search Designation by name and Department and add value to input ajax part start ---------------- /////////////////////////////
    // Designation Keyup event
    $(document).on('keyup', '#designation', function (e) {
        let department = $('#department').attr('data-id');
        let designation = $(this).val();
        let id = $(this).attr('data-id');
        DesignationKeyUp(e, department, designation, id, '#designation', '#designation-list ul');
    });


    // Designation Key Down Event
    $(document).on('keydown', '#designation', function (e) {
        let list = $('#designation-list ul li');
        DesignationKeyDown(e, list, '#designation', '#designation-list ul');
    });


    // Designation List key Down Event
    $(document).on('keydown', '#designation-list ul li', function (e) {
        let list = $('#designation-list ul li');
        let focused = $('#designation-list ul li:focus');
        DesignationListKeyDown(e, list, focused, '#designation', '#designation-list ul');
    });


    // Designation Focus Event
    $(document).on('focus', '#designation', function (e) {
        let designation = $(this).val();
        let department = $('#department').attr('data-id');
        let id = $(this).attr('data-id');
        if(id == undefined){
            getDesignationByNameAndDepartment(designation, '#designation-list ul', department);
        }
        else{
            e.preventDefault();
        }
    });


    // Designation Focousout event
    $(document).on('focusout', '#designation', function (e) {
        let id = $(this).attr('data-id');
        if(id == undefined){
            $(document).on('click', function (e){
                if($(e.target).attr('tabindex') == undefined){
                    $('#designation-list ul').html('');
                }
            });
        }
    });


    // Designation List Click event
    $(document).on('click', '#designation-list li', function () {
        let value = $(this).text();
        let id = $(this).data('id');
        $('#designation').val(value);
        $('#designation').attr('data-id', id);
        $('#designation-list ul').html('');
    });

    // Update Designation Keyup Event
    $(document).on('keyup', '#updateDesignation', function (e) {
        let department = $('#updateDepartment').attr('data-id');
        let designation = $(this).val();
        let id = $(this).attr('data-id');
        DesignationKeyUp(e, department, designation, id, '#updateDesignation', '#update-designation ul');
    });


    // Update Designation Keydown Event
    $(document).on('keydown', '#updateDesignation', function (e) {
        let list = $('#update-designation ul li');
        DesignationKeyDown(e, list, '#updateDesignation', '#update-designation ul');
    });


    // Update Designation List keydown Event
    $(document).on('keydown', '#update-designation ul li', function (e) {
        let list = $('#update-designation ul li');
        let focused = $('#update-designation ul li:focus');
        DesignationListKeyDown(e, list, focused, '#updateDesignation', '#update-designation ul');
    });


    // Update Designation List Click Event
    $(document).on('click', '#update-designation li', function () {
        let value = $(this).text();
        let id = $(this).data('id');
        $('#updateDesignation').val(value);
        $('#updateDesignation').attr('data-id', id);
        $('#update-designation ul').html('');
    });


    // Update Designation Focus Event
    $(document).on('focus', '#updateDesignation', function (e) {
        let designation = $(this).val();
        let department = $('#updateDepartment').attr('data-id');
        let id = $(this).attr('data-id');
        if(id == undefined){
            getDesignationByNameAndDepartment(designation, '#update-designation ul', department);
        }
        else{
            e.preventDefault();
        }
    });


    // Update Designation Focous out event
    $(document).on('focusout', '#updateDesignation', function (e) {
        let id = $(this).attr('data-id');
        if(id == undefined){
            $(document).on('click', function (e){
                if($(e.target).attr('tabindex') == undefined){
                    $('#update-designation ul').html('');
                }
            });
        }
    });



    // Designation Keyup Event Function
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


    // Designation Keydown Event Function
    function DesignationKeyDown(e, list, targetElement1, targetElement2) {
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
            else if (e.keyCode === 9) { // Tab key
                $(targetElement2).html('');
            }
        }
    }
    

    // Department List Keydown Event function
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


    // Search Designation by Name and Department
    function getDesignationByNameAndDepartment(designation, targetElement1, department = "") {
        $.ajax({
            url: "/admin/employees/get/designation/name/department",
            method: 'GET',
            data: { designation: designation, department: department },
            success: function (res) {
                $(targetElement1).html(res);
            }
        });
    }

    /////////////// ------------------ Search Designation by name and Department and add value to input ajax part end ---------------- /////////////////////////////



    /////////////// ------------------ Search Location by Upazila and add value to input ajax part start ---------------- /////////////////////////////
    // Location Keyup Event
    $(document).on('keyup', '#location', function (e) {
        let location = $(this).val();
        let id = $(this).attr('data-id');
        LocationKeyUp(e, location, id, '#location', '#location-list ul');
    });


    // Location Keydown Event
    $(document).on('keydown', '#location', function (e) {
        let list = $('#location-list ul li');
        LocationKeyDown(e, list, '#location', '#location-list ul');
    });


    // Location List keydown Event
    $(document).on('keydown', '#location-list ul li', function (e) {
        let list = $('#location-list ul li');
        let focused = $('#location-list ul li:focus');
        LocationListKeyDown(e, list, focused, '#location', '#location-list ul');
    });


    // Location List Click Event
    $(document).on('click', '#location-list li', function () {
        let value = $(this).text();
        let id = $(this).data('id');
        $('#location').val(value);
        $('#location').attr('data-id', id);
        $('#location-list ul').html('');
    });


    // Location Focus Event
    $(document).on('focus', '#location', function (e) {
        let location = $(this).val();
        let id = $(this).attr('data-id');
        if(id == undefined){
            getLocationByUpazila(location, '#location-list ul');
        }
        else{
            e.preventDefault();
        }
    });


    // Locaation Focousout event
    $(document).on('focusout', '#location', function (e) {
        let id = $(this).attr('data-id');
        if(id == undefined){
            $(document).on('click', function (e){
                if($(e.target).attr('tabindex') == undefined){
                    $('#location-list ul').html('');
                }
            });
        }
    });

    // Update Location Keyup Event
    $(document).on('keyup', '#updateLocation', function (e) {
        let location = $(this).val();
        let id = $(this).attr('data-id');
        LocationKeyUp(e, location, id, '#updateLocation', '#update-location ul');
    });


    // Update Location Keydown Event
    $(document).on('keydown', '#updateLocation', function (e) {
        let list = $('#update-location ul li');
        LocationKeyDown(e, list, '#updateLocation', '#update-location ul');
    });


    // Update Location List Keydown Event
    $(document).on('keydown', '#update-location ul li', function (e) {
        let list = $('#update-location ul li');
        let focused = $('#update-location ul li:focus');
        LocationListKeyDown(e, list, focused, '#updateLocation', '#update-location ul');
    });


    // Update Location List Click Event
    $(document).on('click', '#update-location li', function () {
        let value = $(this).text();
        let id = $(this).data('id');
        $('#updateLocation').val(value);
        $('#updateLocation').attr('data-id', id);
        $('#update-location ul').html('');
    });



    // Update Location Focus Event
    $(document).on('focus', '#updateLocation', function (e) {
        let location = $(this).val();
        let id = $(this).attr('data-id');
        if(id == undefined){
            getLocationByUpazila(location, '#update-location ul');
        }
        else{
            e.preventDefault();
        }
    });



    // Update Locaation Focousout Event
    $(document).on('focusout', '#updateLocation', function (e) {
        let id = $(this).attr('data-id');
        if(id == undefined){
            $(document).on('click', function (e){
                if($(e.target).attr('tabindex') == undefined){
                    $('#update-location ul').html('');
                }
            });
        }
    });


    // Location Keyup Event Function
    function LocationKeyUp(e, location, id, targetElement1, targetElement2){
        if (e.keyCode === 13) { // Enter Key
            e.preventDefault();
        }
        else if ((e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 8){
            //keyCode 65 = a, keyCode 90 = z, keyCode 96 = 0, keyCode 105 = 9, keyCode 8 = backSpace
            $(targetElement1).removeAttr('data-id');
            getLocationByUpazila(location, targetElement2);
        }
        else if (e.keyCode === 9) { // Tab key
            if (id != undefined) {
                e.preventDefault();
            }
            else{
                $(targetElement1).removeAttr('data-id');
                getLocationByUpazila(location, targetElement2);
            }
        }
    }


    // Location Keydown Event Function
    function LocationKeyDown(e, list, targetElement1, targetElement2) {
        if (list.length > 0) {
            if (e.keyCode === 40) { // Down arrow key
                e.preventDefault();
                list.first().focus();
                $(targetElement1).val(list.first().text());
                $(targetElement1).attr("data-id", list.data('id'));
            } 
            else if (e.keyCode === 38) { // Up arrow key
                e.preventDefault();
                list.last().focus();
                $(targetElement1).val(list.last().text());
                $(targetElement1).attr("data-id", list.data('id'));
            } 
            else if (e.keyCode === 13) { // Enter key
                e.preventDefault();
            } 
            else if (e.keyCode === 9) { // Tab key
                $(targetElement2).html('');
            }
        }
    }
    

    // Location List Keydown Event function
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

    // Search Location by Upazila
    function getLocationByUpazila(location, targetElement1) {
        $.ajax({
            url: "/admin/employees/get/location/upazila",
            method: 'GET',
            data: { location: location },
            success: function (res) {
                $(targetElement1).html(res);
            }
        });
    }

    /////////////// ------------------ Search Location by Upazila and add value to input ajax part end ---------------- /////////////////////////////



    ////////////// ------------------- Search Transaction User and add value to input ajax part start --------------- ////////////////////////////
    //search Transaction User on add modal
    $(document).on('keyup', '#user', function (e) {
        let tranUser = $(this).val();
        let tranUserType;
        let within;
        if ($('#within').length) {
            tranUserType = $('.with-checkbox:checked').map(function() {
                return $(this).val();
            }).get();
            within = 1;
        } else {
            tranUserType = $('#with').val();
            within = 0;
        }
        let id = $(this).attr('data-id');
        UserKeyUp(e, tranUserType, within, tranUser, id, '#user', '#user-list ul');
        $('.due-grid tbody, .due-grid tfoot').html('');
    });



    // User Key Down Event
    $(document).on('keydown', '#user', function (e) {
        let list = $('#user-list ul li');
        UserKeyDown(e, list, '#user', '#user-list ul');
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
        let withs = $(this).data('with');
        $('#user').val(value);
        $('#user').attr('data-id', id);
        $('#user').attr('data-with', withs);
        $('#user-list ul').html('');
        getDueListByUserId(id, '.due-grid tbody');
        getPayrollByUserId(id, '.payroll-grid tbody');
        // getPayrollSetupByUserId(id, '.setup tbody');
        // getPayrollMiddlewireByUserId(id, '.middlewire tbody');
    });



    // User Focus Event
    $(document).on('focus', '#user', function (e) {
        let tranUser = $(this).val();
        let tranUserType;
        let within;
        if ($('#within').length) {
            tranUserType = $('.with-checkbox:checked').map(function() {
                return $(this).val();
            }).get();
            within = 1;
        } else {
            tranUserType = $('#with').val();
            within = 0;
        }
        let id = $(this).attr('data-id');
        if(id == undefined){
            getTransactionUser(tranUserType, within, tranUser, '#user-list ul');
        }
        else{
            e.preventDefault();
        }
    });


    // User Focousout event
    $(document).on('focusout', '#user', function (e) {
        let id = $(this).attr('data-id');
        if(id == undefined){
            $(document).on('click', function (e){
                if($(e.target).attr('tabindex') == undefined){
                    $('#user-list ul').html('');
                }
            });
        }
    });



    //search Transaction User on edit modal
    $(document).on('keyup', '#updateUser', function (e) {
        let tranUser = $(this).val();
        let tranUserType;
        let within;
        if ($('#updatewithin').length) {
            tranUserType = $('.updatewith-checkbox:checked').map(function() {
                return $(this).val();
            }).get();
            within = 1;
        } else {
            tranUserType = $('#updateWith').val();
            within = 0;
        }
        let id = $(this).attr('data-id');
        UserKeyUp(e, tranUserType, within, tranUser, id, '#updateUser', '#update-user ul');
    });



    // Update User Key Down Event
    $(document).on('keydown', '#updateUser', function (e) {
        let list = $('#update-user ul li');
        UserKeyDown(e, list, '#updateUser', '#update-user ul');
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
        let withs = $(this).data('with');
        $('#updateUser').val(value);
        $('#updateUser').attr('data-id', id);
        $('#updateUser').attr('data-with', withs);
        $('#update-user ul').html('');
        getDueListByUserId(id, '.due-grid tbody');
    });


    // User Focus Event
    $(document).on('focus', '#updateUser', function (e) {
        let tranUser = $(this).val();
        let tranUserType;
        let within;
        if ($('#updatewithin').length) {
            tranUserType = $('.updatewith-checkbox:checked').map(function() {
                return $(this).val();
            }).get();
            within = 1;
        } else {
            tranUserType = $('#updateWith').val();
            within = 0;
        }
        let id = $(this).attr('data-id');
        if(id == undefined){
            getTransactionUser(tranUserType, within, tranUser, '#update-user ul');
        }
        else{
            e.preventDefault();
        }
    });


    // User Focousout event
    $(document).on('focusout', '#updateUser', function (e) {
        let id = $(this).attr('data-id');
        if(id == undefined){
            $(document).on('click', function (e){
                if($(e.target).attr('tabindex') == undefined){
                    $('#update-user ul').html('');
                }
            });
        }
    });



    // User Key Up Event Function
    function UserKeyUp(e, tranUserType, within, tranUser, id, targetElement1, targetElement2){
        if (e.keyCode === 13) { // Enter Key
            e.preventDefault();
        }
        else if ((e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 8){
            //keyCode 65 = a, keyCode 90 = z, keyCode 96 = 0, keyCode 105 = 9, keyCode 8 = backSpace
            $(targetElement1).removeAttr('data-id');
            $(targetElement1).removeAttr('data-with');
            getTransactionUser(tranUserType, within, tranUser, targetElement2);
        }
        else if (e.keyCode === 9) { // Tab key
            if (id != undefined) {
                e.preventDefault();
            }
            else{
                $(targetElement1).removeAttr('data-id');
                $(targetElement1).removeAttr('data-with');
                getTransactionUser(tranUserType, within, tranUser, targetElement2);
            }
        }
    }



    // User Key Down Event Function
    function UserKeyDown(e, list, targetElement1, targetElement2) {
        if (list.length > 0) {
            if (e.keyCode === 40) { // Down arrow key
                e.preventDefault();
                list.first().focus();
                $(targetElement1).val(list.first().text());
                $(targetElement1).attr("data-id", list.data('id'));
                $(targetElement1).attr("data-with", list.data('with'));
            } 
            else if (e.keyCode === 38) { // Up arrow key
                e.preventDefault();
                list.last().focus();
                $(targetElement1).val(list.last().text());
                $(targetElement1).attr("data-id", list.data('id'));
                $(targetElement1).attr("data-with", list.data('with'));
            } 
            else if (e.keyCode === 13) { // Enter key
                e.preventDefault();
            }
            else if (e.keyCode === 9) { // Tab key
                $(targetElement2).html('');
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
            $(targetElement1).attr("data-with", list.eq(nextIndex).data('with'));
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
            $(targetElement1).attr("data-with", list.eq(nextIndex).data('with'));
        } 
        else if (e.keyCode === 13) { // Enter key
            e.preventDefault();
            let id = $(targetElement1).attr('data-id');
            getDueListByUserId(id, '.due-grid tbody');
            getPayrollByUserId(id, '.payroll-grid tbody');
            // getPayrollSetupByUserId(id, '.setup tbody');
            // getPayrollMiddlewireByUserId(id, '.middlewire tbody');
            $(targetElement2).html('');
            $(targetElement1).focus();
        }
    }



    // Search Transaction User by Name
    function getTransactionUser(tranUserType, within, tranUser, targetElement1) {
        $.ajax({
            url: "/transaction/get/tranuser",
            method: 'GET',
            data: { tranUserType: tranUserType, within:within, tranUser: tranUser },
            success: function (res) {
                $(targetElement1).html(res);
            }
        });
    }


    // Get Due Payment list by User Id
    function getDueListByUserId(id, grid) {
        $.ajax({
            url: "/party/get/trandue/userid",
            method: 'GET',
            data: { id:id },
            success: function (res) {
                if(res.status === 'success'){
                    $(grid).html(res.data);
                    
                    let transactions = res.transaction.data;
                    // Calculate total amount
                    let totalAmount = transactions.reduce((sum, transaction) => sum + transaction.due, 0);
                    const formattedTotalAmount = totalAmount.toLocaleString('en-US');
                    $('.due-grid tfoot').html(`<tr>
                                                    <td colspan="4" style="text-align:right;"> Total Due: ${formattedTotalAmount} Tk.</td>
                                                </tr>`)
                }
                else{
                    $(grid).html('');
                }
                
            }
        });
    }

    //Get Payroll By User Id
    function getPayrollByUserId(id, grid) {
        $.ajax({
            url: "/payroll/get/user",
            method: 'GET',
            data: { id:id },
            success: function (res) {
                if(res.status === 'success'){
                    $(grid).html(res.data);
                }
                else{
                    $(grid).html('');
                }
                
            }
        });
    }


    ////////////// ------------------- Search Transaction user and add value to input ajax part end --------------- ////////////////////////////



    /////////////// ------------------ Search Heads By Name And Group add value to input ajax part start ---------------- /////////////////////////////
    // Head Keyup Event
    $(document).on('keyup', '#head', function (e) {
        let head = $(this).val();
        let groupe;
        let groupein;
        if ($('#groupein').length) {
            groupe = $('.groupe-checkbox:checked').map(function() {
                return $(this).val();
            }).get();
            groupein = 1;
        } else {
            groupe = $('#groupe').val();
            groupein = 0;
        }
        let id = $(this).attr('data-id');
        HeadKeyUp(e, groupe, groupein, head, id, '#head', '#head-list ul');
    });

    // Head Key down Event
    $(document).on('keydown', '#head', function (e) {
        let list = $('#head-list ul li');
        HeadKeyDown(e, list, '#head', '#head-list ul');
    });


    // Head List Key down Event
    $(document).on('keydown', '#head-list ul li', function (e) {
        let list = $('#head-list ul li');
        let focused = $('#head-list ul li:focus');
        HeadListKeyDown(e, list, focused, '#head', '#head-list ul');
    });


    // Head Focus Event
    $(document).on('focus', '#head', function (e) {
        let head = $(this).val();
        let groupe;
        let groupein;
        if ($('#groupein').length) {
            groupe = $('.groupe-checkbox:checked').map(function() {
                return $(this).val();
            }).get();
            groupein = 1;
        } else {
            groupe = $('#groupe').val();
            groupein = 0;
        }
        let id = $(this).attr('data-id');
        if(id == undefined){
            getHeadByGroupe(groupe, groupein, head,  '#head-list ul');
        }
        else{
            e.preventDefault();
        }
    });


    // Head Focous out event
    $(document).on('focusout', '#head', function (e) {
        let id = $(this).attr('data-id');
        if(id == undefined){
            $(document).on('click', function (e){
                if($(e.target).attr('tabindex') == undefined){
                    $('#head-list ul').html('');
                }
            });
        }
    });


    // Head List Click Event
    $(document).on('click', '#head-list li', function () {
        let value = $(this).text();
        let id = $(this).data('id');
        let groupe = $(this).data('groupe');
        $('#head').val(value);
        $('#head').attr('data-id', id);
        $('#head').attr('data-groupe', groupe);
        $('#head-list ul').html('');
    });



    // Update Head Keyup event
    $(document).on('keyup', '#updateHead', function (e) {
        let head = $(this).val();
        let groupe;
        let groupein;
        if ($('#updategroupein').length) {
            groupe = $('.updategroupe-checkbox:checked').map(function() {
                return $(this).val();
            }).get();
            groupein = 1;
        } else {
            groupe = $('#updategroupe').val();
            groupein = 0;
        }
        let id = $(this).attr('data-id');
        HeadKeyUp(e, groupe, groupein, head, id, '#updateHead', '#update-head ul');
    });



    // Update Head Keydown event
    $(document).on('keydown', '#updateHead', function (e) {
        let list = $('#update-head ul li');
        HeadKeyDown(e, list, '#updateHead', '#update-head ul');
    });



    // Update Head List Keydown event
    $(document).on('keydown', '#update-head ul li', function (e) {
        let list = $('#update-head ul li');
        let focused = $('#update-head ul li:focus');
        HeadListKeyDown(e, list, focused, '#updateHead', '#update-head ul');
    });



    // Update Head Focus Event
    $(document).on('focus', '#updateHead', function (e) {
        let head = $(this).val();
        let groupe;
        let groupein;
        if ($('#updategroupein').length) {
            groupe = $('.updategroupe-checkbox:checked').map(function() {
                return $(this).val();
            }).get();
            groupein = 1;
        } else {
            groupe = $('#updateGroupe').val();
            groupein = 0;
        }
        let id = $(this).attr('data-id');
        if(id == undefined){
            getHeadByGroupe(groupe, groupein, head, '#update-head ul');
        }
        else{
            e.preventDefault();
        }
    });


    
    // Update Head Focousout event
    $(document).on('focusout', '#updateHead', function (e) {
        let id = $(this).attr('data-id');
        if(id == undefined){
            $(document).on('click', function (e){
                if($(e.target).attr('tabindex') == undefined){
                    $('#update-head ul').html('');
                }
            });
        }
    });


    // Update Head Click Event
    $(document).on('click', '#update-head li', function () {
        let value = $(this).text();
        let id = $(this).data('id');
        let groupe = $(this).data('groupe');
        $('#updateHead').val(value);
        $('#updateHead').attr('data-id', id);
        $('#updateHead').attr('data-groupe', groupe);
        $('#update-head ul').html('');
    });



    // Head Key Up Event Function
    function HeadKeyUp(e, groupe, groupein, head, id, targetElement1, targetElement2){
        if (e.keyCode === 13) { // Enter Key
            e.preventDefault();
        }
        else if ((e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 8){
            //keyCode 65 = a, keyCode 90 = z, keyCode 96 = 0, keyCode 105 = 9, keyCode 8 = backSpace
            $(targetElement1).removeAttr('data-id');
            $(targetElement1).removeAttr('data-groupe');
            getHeadByGroupe(groupe, groupein, head,  targetElement2);
        }
        else if (e.keyCode === 9) { // Tab key
            if (id != undefined) {
                e.preventDefault();
            }
            else{
                $(targetElement1).removeAttr('data-id');
                $(targetElement1).removeAttr('data-groupe');
                getHeadByGroupe(groupe, groupein, head,  targetElement2);
            }
        }
    }


    // Head Key Down Event Function
    function HeadKeyDown(e, list, targetElement1, targetElement2) {
        if (list.length > 0) {
            if (e.keyCode === 40) { // Down arrow key
                e.preventDefault();
                list.first().focus();
                $(targetElement1).val(list.first().text());
                $(targetElement1).attr("data-id", list.data('id'));
                $(targetElement1).attr("data-groupe", list.data('groupe'));
            } 
            else if (e.keyCode === 38) { // Up arrow key
                e.preventDefault();
                list.last().focus();
                $(targetElement1).val(list.last().text());
                $(targetElement1).attr("data-id", list.data('id'));
                $(targetElement1).attr("data-groupe", list.data('groupe'));
            } 
            else if (e.keyCode === 13) { // Enter key
                e.preventDefault();
            } 
            else if (e.keyCode === 9) { // Tab key
                $(targetElement2).html('');
            }
        }
    }


    // Head List Key Down Event function
    function HeadListKeyDown(e, list, focused, targetElement1, targetElement2) {
        if (e.keyCode === 40) { // Down arrow key
            e.preventDefault();
            let nextIndex = focused.index() + 1;
            if (nextIndex >= list.length) {
                nextIndex = 0; // Loop to the first item
            }
            list.eq(nextIndex).focus();
            $(targetElement1).val(list.eq(nextIndex).text());
            $(targetElement1).attr("data-id", list.eq(nextIndex).data('id'));
            $(targetElement1).attr("data-groupe", list.eq(nextIndex).data('groupe'));
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
            $(targetElement1).attr("data-groupe", list.eq(prevIndex).data('groupe'));
        } 
        else if (e.keyCode === 13) { // Enter key
            e.preventDefault();
            $(targetElement2).html('');
            $(targetElement1).focus();
        }
    }

    // Search Head by Name
    function getHeadByGroupe(groupe, groupein, head, targetElement1) {
        $.ajax({
            url: "/transaction/get/heads/groupe",
            method: 'GET',
            data: { groupe: groupe, groupein:groupein, head:head },
            success: function (res) {
                $(targetElement1).html(res);
            }
        });
    }

    /////////////// ------------------ Search Head By Name And Groupe add value to input ajax part end ---------------- /////////////////////////////







    /////////////// ------------------ Search Manufacturer by Name and add value to input ajax part start ---------------- /////////////////////////////
    // Manufacturer Keyup Event
    $(document).on('keyup', '#manufacturer', function (e) {
        let manufacturer = $(this).val();
        let id = $(this).attr('data-id');
        ManufacturerKeyUp(e, manufacturer, id, '#manufacturer', '#manufacturer-list ul');
    });


    // Manufacturer Keydown Event
    $(document).on('keydown', '#manufacturer', function (e) {
        let list = $('#manufacturer-list ul li');
        ManufacturerKeyDown(e, list, '#manufacturer', '#manufacturer-list ul');
    });


    // Manufacturer List keydown Event
    $(document).on('keydown', '#manufacturer-list ul li', function (e) {
        let list = $('#manufacturer-list ul li');
        let focused = $('#manufacturer-list ul li:focus');
        ManufacturerListKeyDown(e, list, focused, '#manufacturer', '#manufacturer-list ul');
    });


    // Manufacturer List Click Event
    $(document).on('click', '#manufacturer-list li', function () {
        let value = $(this).text();
        let id = $(this).data('id');
        $('#manufacturer').val(value);
        $('#manufacturer').attr('data-id', id);
        $('#manufacturer-list ul').html('');
    });


    // Manufacturer Focus Event
    $(document).on('focus', '#manufacturer', function (e) {
        let manufacturer = $(this).val();
        let id = $(this).attr('data-id');
        if(id == undefined){
            getManufacturerByName(manufacturer, '#manufacturer-list ul');
        }
        else{
            e.preventDefault();
        }
    });


    // Manufacturer Focusout event
    $(document).on('focusout', '#manufacturer', function (e) {
        let id = $(this).attr('data-id');
        if(id == undefined){
            $(document).on('click', function (e){
                if($(e.target).attr('tabindex') == undefined){
                    $('#manufacturer-list ul').html('');
                }
            });
        }
    });

    // Update Manufacturer Keyup Event
    $(document).on('keyup', '#updateManufacturer', function (e) {
        let manufacturer = $(this).val();
        let id = $(this).attr('data-id');
        ManufacturerKeyUp(e, manufacturer, id, '#updateManufacturer', '#update-manufacturer ul');
    });


    // Update Manufacturer Keydown Event
    $(document).on('keydown', '#updateManufacturer', function (e) {
        let list = $('#update-manufacturer ul li');
        ManufacturerKeyDown(e, list, '#updateManufacturer', '#update-manufacturer ul');
    });


    // Update Manufacturer List Keydown Event
    $(document).on('keydown', '#update-manufacturer ul li', function (e) {
        let list = $('#update-manufacturer ul li');
        let focused = $('#update-manufacturer ul li:focus');
        ManufacturerListKeyDown(e, list, focused, '#updateManufacturer', '#update-manufacturer ul');
    });


    // Update Manufacturer List Click Event
    $(document).on('click', '#update-manufacturer li', function () {
        let value = $(this).text();
        let id = $(this).data('id');
        $('#updateManufacturer').val(value);
        $('#updateManufacturer').attr('data-id', id);
        $('#update-manufacturer ul').html('');
    });



    // Update Manufacturer Focus Event
    $(document).on('focus', '#updateManufacturer', function (e) {
        let manufacturer = $(this).val();
        let id = $(this).attr('data-id');
        if(id == undefined){
            getManufacturerByName(manufacturer, '#update-manufacturer ul');
        }
        else{
            e.preventDefault();
        }
    });



    // Update Locaation Focousout Event
    $(document).on('focusout', '#updateManufacturer', function (e) {
        let id = $(this).attr('data-id');
        if(id == undefined){
            $(document).on('click', function (e){
                if($(e.target).attr('tabindex') == undefined){
                    $('#update-manufacturer ul').html('');
                }
            });
        }
    });


    // Manufacturer Keyup Event Function
    function ManufacturerKeyUp(e, manufacturer, id, targetElement1, targetElement2){
        if (e.keyCode === 13) { // Enter Key
            e.preventDefault();
        }
        else if ((e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 8){
            //keyCode 65 = a, keyCode 90 = z, keyCode 96 = 0, keyCode 105 = 9, keyCode 8 = backSpace
            $(targetElement1).removeAttr('data-id');
            getManufacturerByName(manufacturer, targetElement2);
        }
        else if (e.keyCode === 9) { // Tab key
            if (id != undefined) {
                e.preventDefault();
            }
            else{
                $(targetElement1).removeAttr('data-id');
                getManufacturerByName(manufacturer, targetElement2);
            }
        }
    }


    // Manufacturer Keydown Event Function
    function ManufacturerKeyDown(e, list, targetElement1, targetElement2) {
        if (list.length > 0) {
            if (e.keyCode === 40) { // Down arrow key
                e.preventDefault();
                list.first().focus();
                $(targetElement1).val(list.first().text());
                $(targetElement1).attr("data-id", list.data('id'));
            } 
            else if (e.keyCode === 38) { // Up arrow key
                e.preventDefault();
                list.last().focus();
                $(targetElement1).val(list.last().text());
                $(targetElement1).attr("data-id", list.data('id'));
            } 
            else if (e.keyCode === 13) { // Enter key
                e.preventDefault();
            } 
            else if (e.keyCode === 9) { // Tab key
                $(targetElement2).html('');
            }
        }
    }
    

    // Manufacturer List Keydown Event function
    function ManufacturerListKeyDown(e, list, focused, targetElement1, targetElement2) {
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

    // Search Manufacturer by Name
    function getManufacturerByName(manufacturer, targetElement1) {
        $.ajax({
            url: "/get/manufacturer/name",
            method: 'GET',
            data: { manufacturer: manufacturer },
            success: function (res) {
                $(targetElement1).html(res);
            }
        });
    }

    /////////////// ------------------ Search Manufacturer by Name and add value to input ajax part end ---------------- /////////////////////////////








    /////////////// ------------------ Search Category by Name and add value to input ajax part start ---------------- /////////////////////////////
    // Category Keyup Event
    $(document).on('keyup', '#category', function (e) {
        let category = $(this).val();
        let id = $(this).attr('data-id');
        CategoryKeyUp(e, category, id, '#category', '#category-list ul');
    });


    // Category Keydown Event
    $(document).on('keydown', '#category', function (e) {
        let list = $('#category-list ul li');
        CategoryKeyDown(e, list, '#category', '#category-list ul');
    });


    // Category List keydown Event
    $(document).on('keydown', '#category-list ul li', function (e) {
        let list = $('#category-list ul li');
        let focused = $('#category-list ul li:focus');
        CategoryListKeyDown(e, list, focused, '#category', '#category-list ul');
    });


    // Category List Click Event
    $(document).on('click', '#category-list li', function () {
        let value = $(this).text();
        let id = $(this).data('id');
        $('#category').val(value);
        $('#category').attr('data-id', id);
        $('#category-list ul').html('');
    });


    // Category Focus Event
    $(document).on('focus', '#category', function (e) {
        let category = $(this).val();
        let id = $(this).attr('data-id');
        if(id == undefined){
            getCategoryByName(category, '#category-list ul');
        }
        else{
            e.preventDefault();
        }
    });


    // Locaation Focousout event
    $(document).on('focusout', '#category', function (e) {
        let id = $(this).attr('data-id');
        if(id == undefined){
            $(document).on('click', function (e){
                if($(e.target).attr('tabindex') == undefined){
                    $('#category-list ul').html('');
                }
            });
        }
    });

    // Update Category Keyup Event
    $(document).on('keyup', '#updateCategory', function (e) {
        let category = $(this).val();
        let id = $(this).attr('data-id');
        CategoryKeyUp(e, category, id, '#updateCategory', '#update-category ul');
    });


    // Update Category Keydown Event
    $(document).on('keydown', '#updateCategory', function (e) {
        let list = $('#update-category ul li');
        CategoryKeyDown(e, list, '#updateCategory', '#update-category ul');
    });


    // Update Category List Keydown Event
    $(document).on('keydown', '#update-category ul li', function (e) {
        let list = $('#update-category ul li');
        let focused = $('#update-category ul li:focus');
        CategoryListKeyDown(e, list, focused, '#updateCategory', '#update-category ul');
    });


    // Update Category List Click Event
    $(document).on('click', '#update-category li', function () {
        let value = $(this).text();
        let id = $(this).data('id');
        $('#updateCategory').val(value);
        $('#updateCategory').attr('data-id', id);
        $('#update-category ul').html('');
    });



    // Update Category Focus Event
    $(document).on('focus', '#updateCategory', function (e) {
        let category = $(this).val();
        let id = $(this).attr('data-id');
        if(id == undefined){
            getCategoryByName(category, '#update-category ul');
        }
        else{
            e.preventDefault();
        }
    });



    // Update Locaation Focousout Event
    $(document).on('focusout', '#updateCategory', function (e) {
        let id = $(this).attr('data-id');
        if(id == undefined){
            $(document).on('click', function (e){
                if($(e.target).attr('tabindex') == undefined){
                    $('#update-category ul').html('');
                }
            });
        }
    });


    // Category Keyup Event Function
    function CategoryKeyUp(e, category, id, targetElement1, targetElement2){
        if (e.keyCode === 13) { // Enter Key
            e.preventDefault();
        }
        else if ((e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 8){
            //keyCode 65 = a, keyCode 90 = z, keyCode 96 = 0, keyCode 105 = 9, keyCode 8 = backSpace
            $(targetElement1).removeAttr('data-id');
            getCategoryByName(category, targetElement2);
        }
        else if (e.keyCode === 9) { // Tab key
            if (id != undefined) {
                e.preventDefault();
            }
            else{
                $(targetElement1).removeAttr('data-id');
                getCategoryByName(category, targetElement2);
            }
        }
    }


    // Category Keydown Event Function
    function CategoryKeyDown(e, list, targetElement1, targetElement2) {
        if (list.length > 0) {
            if (e.keyCode === 40) { // Down arrow key
                e.preventDefault();
                list.first().focus();
                $(targetElement1).val(list.first().text());
                $(targetElement1).attr("data-id", list.data('id'));
            } 
            else if (e.keyCode === 38) { // Up arrow key
                e.preventDefault();
                list.last().focus();
                $(targetElement1).val(list.last().text());
                $(targetElement1).attr("data-id", list.data('id'));
            } 
            else if (e.keyCode === 13) { // Enter key
                e.preventDefault();
            } 
            else if (e.keyCode === 9) { // Tab key
                $(targetElement2).html('');
            }
        }
    }
    

    // Category List Keydown Event function
    function CategoryListKeyDown(e, list, focused, targetElement1, targetElement2) {
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

    // Search Category by Name
    function getCategoryByName(category, targetElement1) {
        $.ajax({
            url: "/get/category/name",
            method: 'GET',
            data: { category: category },
            success: function (res) {
                $(targetElement1).html(res);
            }
        });
    }

    /////////////// ------------------ Search Category by Name and add value to input ajax part end ---------------- /////////////////////////////



    /////////////// ------------------ Search Form by Name and add value to input ajax part start ---------------- /////////////////////////////
    // Form Keyup Event
    $(document).on('keyup', '#form', function (e) {
        let form = $(this).val();
        let id = $(this).attr('data-id');
        FormKeyUp(e, form, id, '#form', '#form-list ul');
    });


    // Form Keydown Event
    $(document).on('keydown', '#form', function (e) {
        let list = $('#form-list ul li');
        FormKeyDown(e, list, '#form', '#form-list ul');
    });


    // Form List keydown Event
    $(document).on('keydown', '#form-list ul li', function (e) {
        let list = $('#form-list ul li');
        let focused = $('#form-list ul li:focus');
        FormListKeyDown(e, list, focused, '#form', '#form-list ul');
    });


    // Form List Click Event
    $(document).on('click', '#form-list li', function () {
        let value = $(this).text();
        let id = $(this).data('id');
        $('#form').val(value);
        $('#form').attr('data-id', id);
        $('#form-list ul').html('');
    });


    // Form Focus Event
    $(document).on('focus', '#form', function (e) {
        let form = $(this).val();
        let id = $(this).attr('data-id');
        if(id == undefined){
            getFormByName(form, '#form-list ul');
        }
        else{
            e.preventDefault();
        }
    });


    // Locaation Focousout event
    $(document).on('focusout', '#form', function (e) {
        let id = $(this).attr('data-id');
        if(id == undefined){
            $(document).on('click', function (e){
                if($(e.target).attr('tabindex') == undefined){
                    $('#form-list ul').html('');
                }
            });
        }
    });

    // Update Form Keyup Event
    $(document).on('keyup', '#updateForm', function (e) {
        let form = $(this).val();
        let id = $(this).attr('data-id');
        FormKeyUp(e, form, id, '#updateForm', '#update-form ul');
    });


    // Update Form Keydown Event
    $(document).on('keydown', '#updateForm', function (e) {
        let list = $('#update-form ul li');
        FormKeyDown(e, list, '#updateForm', '#update-form ul');
    });


    // Update Form List Keydown Event
    $(document).on('keydown', '#update-form ul li', function (e) {
        let list = $('#update-form ul li');
        let focused = $('#update-form ul li:focus');
        FormListKeyDown(e, list, focused, '#updateForm', '#update-form ul');
    });


    // Update Form List Click Event
    $(document).on('click', '#update-form li', function () {
        let value = $(this).text();
        let id = $(this).data('id');
        $('#updateForm').val(value);
        $('#updateForm').attr('data-id', id);
        $('#update-form ul').html('');
    });



    // Update Form Focus Event
    $(document).on('focus', '#updateForm', function (e) {
        let form = $(this).val();
        let id = $(this).attr('data-id');
        if(id == undefined){
            getFormByName(form, '#update-form ul');
        }
        else{
            e.preventDefault();
        }
    });



    // Update Locaation Focousout Event
    $(document).on('focusout', '#updateForm', function (e) {
        let id = $(this).attr('data-id');
        if(id == undefined){
            $(document).on('click', function (e){
                if($(e.target).attr('tabindex') == undefined){
                    $('#update-form ul').html('');
                }
            });
        }
    });


    // Form Keyup Event Function
    function FormKeyUp(e, form, id, targetElement1, targetElement2){
        if (e.keyCode === 13) { // Enter Key
            e.preventDefault();
        }
        else if ((e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 8){
            //keyCode 65 = a, keyCode 90 = z, keyCode 96 = 0, keyCode 105 = 9, keyCode 8 = backSpace
            $(targetElement1).removeAttr('data-id');
            getFormByName(form, targetElement2);
        }
        else if (e.keyCode === 9) { // Tab key
            if (id != undefined) {
                e.preventDefault();
            }
            else{
                $(targetElement1).removeAttr('data-id');
                getFormByName(form, targetElement2);
            }
        }
    }


    // Form Keydown Event Function
    function FormKeyDown(e, list, targetElement1, targetElement2) {
        if (list.length > 0) {
            if (e.keyCode === 40) { // Down arrow key
                e.preventDefault();
                list.first().focus();
                $(targetElement1).val(list.first().text());
                $(targetElement1).attr("data-id", list.data('id'));
            } 
            else if (e.keyCode === 38) { // Up arrow key
                e.preventDefault();
                list.last().focus();
                $(targetElement1).val(list.last().text());
                $(targetElement1).attr("data-id", list.data('id'));
            } 
            else if (e.keyCode === 13) { // Enter key
                e.preventDefault();
            } 
            else if (e.keyCode === 9) { // Tab key
                $(targetElement2).html('');
            }
        }
    }
    

    // Form List Keydown Event function
    function FormListKeyDown(e, list, focused, targetElement1, targetElement2) {
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

    // Search Form by Name
    function getFormByName(form, targetElement1) {
        $.ajax({
            url: "/get/form/name",
            method: 'GET',
            data: { form: form },
            success: function (res) {
                $(targetElement1).html(res);
            }
        });
    }

    /////////////// ------------------ Search Form by Name and add value to input ajax part end ---------------- /////////////////////////////






    /////////////// ------------------ Search Unit by Name and add value to input ajax part start ---------------- /////////////////////////////
    // Unit Keyup Event
    $(document).on('keyup', '#unit', function (e) {
        let unit = $(this).val();
        let id = $(this).attr('data-id');
        UnitKeyUp(e, unit, id, '#unit', '#unit-list ul');
    });


    // Unit Keydown Event
    $(document).on('keydown', '#unit', function (e) {
        let list = $('#unit-list ul li');
        UnitKeyDown(e, list, '#unit', '#unit-list ul');
    });


    // Unit List keydown Event
    $(document).on('keydown', '#unit-list ul li', function (e) {
        let list = $('#unit-list ul li');
        let focused = $('#unit-list ul li:focus');
        UnitListKeyDown(e, list, focused, '#unit', '#unit-list ul');
    });


    // Unit List Click Event
    $(document).on('click', '#unit-list li', function () {
        let value = $(this).text();
        let id = $(this).data('id');
        $('#unit').val(value);
        $('#unit').attr('data-id', id);
        $('#unit-list ul').html('');
    });


    // Unit Focus Event
    $(document).on('focus', '#unit', function (e) {
        let unit = $(this).val();
        let id = $(this).attr('data-id');
        if(id == undefined){
            getUnitByName(unit, '#unit-list ul');
        }
        else{
            e.preventDefault();
        }
    });


    // Locaation Focousout event
    $(document).on('focusout', '#unit', function (e) {
        let id = $(this).attr('data-id');
        if(id == undefined){
            $(document).on('click', function (e){
                if($(e.target).attr('tabindex') == undefined){
                    $('#unit-list ul').html('');
                }
            });
        }
    });

    // Update Unit Keyup Event
    $(document).on('keyup', '#updateUnit', function (e) {
        let unit = $(this).val();
        let id = $(this).attr('data-id');
        UnitKeyUp(e, unit, id, '#updateUnit', '#update-unit ul');
    });


    // Update Unit Keydown Event
    $(document).on('keydown', '#updateUnit', function (e) {
        let list = $('#update-unit ul li');
        UnitKeyDown(e, list, '#updateUnit', '#update-unit ul');
    });


    // Update Unit List Keydown Event
    $(document).on('keydown', '#update-unit ul li', function (e) {
        let list = $('#update-unit ul li');
        let focused = $('#update-unit ul li:focus');
        UnitListKeyDown(e, list, focused, '#updateUnit', '#update-unit ul');
    });


    // Update Unit List Click Event
    $(document).on('click', '#update-unit li', function () {
        let value = $(this).text();
        let id = $(this).data('id');
        $('#updateUnit').val(value);
        $('#updateUnit').attr('data-id', id);
        $('#update-unit ul').html('');
    });



    // Update Unit Focus Event
    $(document).on('focus', '#updateUnit', function (e) {
        let unit = $(this).val();
        let id = $(this).attr('data-id');
        if(id == undefined){
            getUnitByName(unit, '#update-unit ul');
        }
        else{
            e.preventDefault();
        }
    });



    // Update Locaation Focousout Event
    $(document).on('focusout', '#updateUnit', function (e) {
        let id = $(this).attr('data-id');
        if(id == undefined){
            $(document).on('click', function (e){
                if($(e.target).attr('tabindex') == undefined){
                    $('#update-unit ul').html('');
                }
            });
        }
    });


    // Unit Keyup Event Function
    function UnitKeyUp(e, unit, id, targetElement1, targetElement2){
        if (e.keyCode === 13) { // Enter Key
            e.preventDefault();
        }
        else if ((e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 8){
            //keyCode 65 = a, keyCode 90 = z, keyCode 96 = 0, keyCode 105 = 9, keyCode 8 = backSpace
            $(targetElement1).removeAttr('data-id');
            getUnitByName(unit, targetElement2);
        }
        else if (e.keyCode === 9) { // Tab key
            if (id != undefined) {
                e.preventDefault();
            }
            else{
                $(targetElement1).removeAttr('data-id');
                getUnitByName(unit, targetElement2);
            }
        }
    }


    // Unit Keydown Event Function
    function UnitKeyDown(e, list, targetElement1, targetElement2) {
        if (list.length > 0) {
            if (e.keyCode === 40) { // Down arrow key
                e.preventDefault();
                list.first().focus();
                $(targetElement1).val(list.first().text());
                $(targetElement1).attr("data-id", list.data('id'));
            } 
            else if (e.keyCode === 38) { // Up arrow key
                e.preventDefault();
                list.last().focus();
                $(targetElement1).val(list.last().text());
                $(targetElement1).attr("data-id", list.data('id'));
            } 
            else if (e.keyCode === 13) { // Enter key
                e.preventDefault();
            } 
            else if (e.keyCode === 9) { // Tab key
                $(targetElement2).html('');
            }
        }
    }
    

    // Unit List Keydown Event function
    function UnitListKeyDown(e, list, focused, targetElement1, targetElement2) {
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

    // Search Unit by Name
    function getUnitByName(unit, targetElement1) {
        $.ajax({
            url: "/get/unit/name",
            method: 'GET',
            data: { unit: unit },
            success: function (res) {
                $(targetElement1).html(res);
            }
        });
    }

    /////////////// ------------------ Search Unit by Name and add value to input ajax part end ---------------- /////////////////////////////






     /////////////// ------------------ Search Store by Name and add value to input ajax part start ---------------- /////////////////////////////
    // Store Keyup Event
    $(document).on('keyup', '#store', function (e) {
        let store = $(this).val();
        let id = $(this).attr('data-id');
        StoreKeyUp(e, store, id, '#store', '#store-list ul');
    });


    // Store Keydown Event
    $(document).on('keydown', '#store', function (e) {
        let list = $('#store-list ul li');
        StoreKeyDown(e, list, '#store', '#store-list ul');
    });


    // Store List keydown Event
    $(document).on('keydown', '#store-list ul li', function (e) {
        let list = $('#store-list ul li');
        let focused = $('#store-list ul li:focus');
        StoreListKeyDown(e, list, focused, '#store', '#store-list ul');
    });


    // Store List Click Event
    $(document).on('click', '#store-list li', function () {
        let value = $(this).text();
        let id = $(this).data('id');
        $('#store').val(value);
        $('#store').attr('data-id', id);
        $('#store-list ul').html('');
    });


    // Store Focus Event
    $(document).on('focus', '#store', function (e) {
        let store = $(this).val();
        let id = $(this).attr('data-id');
        if(id == undefined){
            getStoreByName(store, '#store-list ul');
        }
        else{
            e.preventDefault();
        }
    });


    // Locaation Focousout event
    $(document).on('focusout', '#store', function (e) {
        let id = $(this).attr('data-id');
        if(id == undefined){
            $(document).on('click', function (e){
                if($(e.target).attr('tabindex') == undefined){
                    $('#store-list ul').html('');
                }
            });
        }
    });

    // Update Store Keyup Event
    $(document).on('keyup', '#updateStore', function (e) {
        let store = $(this).val();
        let id = $(this).attr('data-id');
        StoreKeyUp(e, store, id, '#updateStore', '#update-store ul');
    });


    // Update Store Keydown Event
    $(document).on('keydown', '#updateStore', function (e) {
        let list = $('#update-store ul li');
        StoreKeyDown(e, list, '#updateStore', '#update-store ul');
    });


    // Update Store List Keydown Event
    $(document).on('keydown', '#update-store ul li', function (e) {
        let list = $('#update-store ul li');
        let focused = $('#update-store ul li:focus');
        StoreListKeyDown(e, list, focused, '#updateStore', '#update-store ul');
    });


    // Update Store List Click Event
    $(document).on('click', '#update-store li', function () {
        let value = $(this).text();
        let id = $(this).data('id');
        $('#updateStore').val(value);
        $('#updateStore').attr('data-id', id);
        $('#update-store ul').html('');
    });



    // Update Store Focus Event
    $(document).on('focus', '#updateStore', function (e) {
        let store = $(this).val();
        let id = $(this).attr('data-id');
        if(id == undefined){
            getStoreByName(store, '#update-store ul');
        }
        else{
            e.preventDefault();
        }
    });



    // Update Locaation Focousout Event
    $(document).on('focusout', '#updateStore', function (e) {
        let id = $(this).attr('data-id');
        if(id == undefined){
            $(document).on('click', function (e){
                if($(e.target).attr('tabindex') == undefined){
                    $('#update-store ul').html('');
                }
            });
        }
    });


    // Store Keyup Event Function
    function StoreKeyUp(e, store, id, targetElement1, targetElement2){
        if (e.keyCode === 13) { // Enter Key
            e.preventDefault();
        }
        else if ((e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 8){
            //keyCode 65 = a, keyCode 90 = z, keyCode 96 = 0, keyCode 105 = 9, keyCode 8 = backSpace
            $(targetElement1).removeAttr('data-id');
            getStoreByName(store, targetElement2);
        }
        else if (e.keyCode === 9) { // Tab key
            if (id != undefined) {
                e.preventDefault();
            }
            else{
                $(targetElement1).removeAttr('data-id');
                getStoreByName(store, targetElement2);
            }
        }
    }


    // Store Keydown Event Function
    function StoreKeyDown(e, list, targetElement1, targetElement2) {
        if (list.length > 0) {
            if (e.keyCode === 40) { // Down arrow key
                e.preventDefault();
                list.first().focus();
                $(targetElement1).val(list.first().text());
                $(targetElement1).attr("data-id", list.data('id'));
            } 
            else if (e.keyCode === 38) { // Up arrow key
                e.preventDefault();
                list.last().focus();
                $(targetElement1).val(list.last().text());
                $(targetElement1).attr("data-id", list.data('id'));
            } 
            else if (e.keyCode === 13) { // Enter key
                e.preventDefault();
            } 
            else if (e.keyCode === 9) { // Tab key
                $(targetElement2).html('');
            }
        }
    }
    

    // Store List Keydown Event function
    function StoreListKeyDown(e, list, focused, targetElement1, targetElement2) {
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

    // Search Store by Name
    function getStoreByName(store, targetElement1) {
        $.ajax({
            url: "/get/store/name",
            method: 'GET',
            data: { store: store },
            success: function (res) {
                $(targetElement1).html(res);
            }
        });
    }

    /////////////// ------------------ Search Store by Name and add value to input ajax part end ---------------- /////////////////////////////


    /////////////// ------------------ Search Products By Name And Group add value to input ajax part start ---------------- /////////////////////////////
    // Head Keyup Event
    $(document).on('keyup', '#product', function (e) {
        let product = $(this).val();
        let groupe;
        let groupein;
        if ($('#groupein').length) {
            groupe = $('.groupe-checkbox:checked').map(function() {
                return $(this).val();
            }).get();
            groupein = 1;
        } else {
            groupe = $('#groupe').val();
            groupein = 0;
        }
        let id = $(this).attr('data-id');
        ProductKeyUp(e, groupe, groupein, product, id, '#product', '#product-list table tbody', '#mrp', '#cp', '#unit');
    });

    // Product Key down Event
    $(document).on('keydown', '#product', function (e) {
        let list = $('#product-list table tbody tr');
        ProductKeyDown(e, list, '#product', '#product-list table tbody', '#mrp', '#cp', '#unit');
    });


    // Product List Key down Event
    $(document).on('keydown', '#product-list table tbody tr', function (e) {
        let list = $('#product-list table tbody tr');
        let focused = $('#product-list table tbody tr:focus');
        ProductListKeyDown(e, list, focused, '#product', '#product-list table tbody', '#mrp', '#cp', '#unit');
    });


    // Product Focus Event
    $(document).on('focus', '#product', function (e) {
        let product = $(this).val();
        let groupe;
        let groupein;
        if ($('#groupein').length) {
            groupe = $('.groupe-checkbox:checked').map(function() {
                return $(this).val();
            }).get();
            groupein = 1;
        } else {
            groupe = $('#groupe').val();
            groupein = 0;
        }
        let id = $(this).attr('data-id');
        if(id == undefined){
            getProductByGroupe(groupe, groupein, product,  '#product-list table tbody');
        }
        else{
            e.preventDefault();
        }
    });


    // Product Focous out event
    $(document).on('focusout', '#product', function (e) {
        let id = $(this).attr('data-id');
        if(id == undefined){
            $(document).on('click', function (e){
                if($(e.target).attr('tabindex') == undefined){
                    $('#product-list table tbody').html('');
                }
            });
        }
    });


    // Product List Click Event
    $(document).on('click', '#product-list tbody tr', function () {
        let value = $(this).find('td:first').text();
        let id = $(this).data('id');
        let groupe = $(this).data('groupe');
        let cp = $(this).data('cp');
        let mrp = $(this).data('mrp');
        let unitid = $(this).data('unit-id');
        let unitname = $(this).data('unit');

        $('#product').val(value);
        $('#product').attr('data-id', id);
        $('#product').attr('data-groupe', groupe);
        $('#mrp').val(mrp);
        $('#cp').val(cp);
        $('#unit').val(unitname);
        $('#unit').attr('data-id', unitid);
        $('#product-list table tbody').html('');
        $('#product').focus();
        
    });



    // Update Product Keyup event
    $(document).on('keyup', '#updateProduct', function (e) {
        let product = $(this).val();
        let groupe;
        let groupein;
        if ($('#updategroupein').length) {
            groupe = $('.updategroupe-checkbox:checked').map(function() {
                return $(this).val();
            }).get();
            groupein = 1;
        } else {
            groupe = $('#updategroupe').val();
            groupein = 0;
        }
        let id = $(this).attr('data-id');
        ProductKeyUp(e, groupe, groupein, product, id, '#updateProduct', '#update-product table', '#updateMrp', '#updateCp', '#updateUnit');
    });



    // Update Product Keydown event
    $(document).on('keydown', '#updateProduct', function (e) {
        let list = $('#update-product table tbody tr');
        ProductKeyDown(e, list, '#updateProduct', '#update-product table', '#updateMrp', '#updateCp', '#updateUnit');
    });



    // Update Product List Keydown event
    $(document).on('keydown', '#update-product table tbody tr', function (e) {
        let list = $('#update-product table tbody tr');
        let focused = $('#update-product table tbody tr:focus');
        ProductListKeyDown(e, list, focused, '#updateProduct', '#update-product table', '#updateMrp', '#updateCp', '#updateUnit');
    });



    // Update Product Focus Event
    $(document).on('focus', '#updateProduct', function (e) {
        let product = $(this).val();
        let groupe;
        let groupein;
        if ($('#updategroupein').length) {
            groupe = $('.updategroupe-checkbox:checked').map(function() {
                return $(this).val();
            }).get();
            groupein = 1;
        } else {
            groupe = $('#updateGroupe').val();
            groupein = 0;
        }
        let id = $(this).attr('data-id');
        if(id == undefined){
            getProductByGroupe(groupe, groupein, product, '#update-product table');
        }
        else{
            e.preventDefault();
        }
    });


    
    // Update Product Focousout event
    $(document).on('focusout', '#updateProduct', function (e) {
        let id = $(this).attr('data-id');
        if(id == undefined){
            $(document).on('click', function (e){
                if($(e.target).attr('tabindex') == undefined){
                    $('#update-product table').html('');
                }
            });
        }
    });


    // Update Product Click Event
    $(document).on('click', '#update-product tbody tr', function () {
        let value = $(this).find('td:first').text();
        let id = $(this).data('id');
        let groupe = $(this).data('groupe');
        let cp = $(this).data('cp');
        let mrp = $(this).data('mrp');
        let unitid = $(this).data('unit-id');
        let unitname = $(this).data('unit');

        $('#updateProduct').val(value);
        $('#updateProduct').attr('data-id', id);
        $('#updateProduct').attr('data-groupe', groupe);
        $('#updateMrp').val(mrp);
        $('#updateCp').val(cp);
        $('#updateUnit').val(unitname);
        $('#updateUnit').attr('data-id', unitid);
        $('#update-product table').html('');
        $('#updateProduct').focus();
    });



    // Product Key Up Event Function
    function ProductKeyUp(e, groupe, groupein, product, id, targetElement1, targetElement2, targetElement3, targetElement4, targetElement5){
        if (e.keyCode === 13) { // Enter Key
            e.preventDefault();
        }
        else if ((e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 8){
            //keyCode 65 = a, keyCode 90 = z, keyCode 96 = 0, keyCode 105 = 9, keyCode 8 = backSpace
            $(targetElement1).removeAttr('data-id');
            $(targetElement1).removeAttr('data-groupe');
            $(targetElement5).removeAttr('data-id');
            $(targetElement3).val('');
            $(targetElement4).val('');
            $(targetElement5).val('');
            getProductByGroupe(groupe, groupein, product,  targetElement2);
        }
        else if (e.keyCode === 9) { // Tab key
            if (id != undefined) {
                e.preventDefault();
            }
            else{
                $(targetElement1).removeAttr('data-id');
                $(targetElement1).removeAttr('data-groupe');
                $(targetElement5).removeAttr('data-id');
                $(targetElement3).val('');
                $(targetElement4).val('');
                $(targetElement5).val('');
                getProductByGroupe(groupe, groupein, product,  targetElement2);
            }
        }
    }


    // Product Key Down Event Function
    function ProductKeyDown(e, list, targetElement1, targetElement2, targetElement3, targetElement4, targetElement5) {
        if (list.length > 0) {
            if (e.keyCode === 40) { // Down arrow key
                e.preventDefault();
                list.first().focus();
                $(targetElement1).val(list.first().find('td:first').text());
                $(targetElement1).attr("data-id", list.data('id'));
                $(targetElement1).attr("data-groupe", list.data('groupe'));
                $(targetElement5).attr('data-id',list.data('unit-id'));
                $(targetElement3).val(list.first().attr('data-mrp'));
                $(targetElement4).val(list.first().attr('data-cp'));
                $(targetElement5).val(list.first().attr('data-unit'));
            } 
            else if (e.keyCode === 38) { // Up arrow key
                e.preventDefault();
                list.last().focus();
                $(targetElement1).val(list.last().find('td:first').text());
                $(targetElement1).attr("data-id", list.data('id'));
                $(targetElement1).attr("data-groupe", list.data('groupe'));
                $(targetElement5).attr('data-id',list.data('unit-id'));
                $(targetElement3).val(list.last().attr('data-mrp'));
                $(targetElement4).val(list.last().attr('data-cp'));
                $(targetElement5).val(list.last().attr('data-unit'));
            } 
            else if (e.keyCode === 13) { // Enter key
                e.preventDefault();
            } 
            else if (e.keyCode === 9) { // Tab key
                $(targetElement2).html('');
            }
        }
    }


    // Product List Key Down Event function
    function ProductListKeyDown(e, list, focused, targetElement1, targetElement2, targetElement3, targetElement4, targetElement5) {
        if (e.keyCode === 40) { // Down arrow key
            e.preventDefault();
            let nextIndex = focused.index() + 1;
            if (nextIndex >= list.length) {
                nextIndex = 0; // Loop to the first item
            }
            list.eq(nextIndex).focus();
            $(targetElement1).val(list.eq(nextIndex).find('td:first').text());
            $(targetElement1).attr("data-id", list.eq(nextIndex).data('id'));
            $(targetElement1).attr("data-groupe", list.eq(nextIndex).data('groupe'));
            $(targetElement5).attr('data-id',list.data('unit-id'));
            $(targetElement3).val(list.eq(nextIndex).attr('data-mrp'));
            $(targetElement4).val(list.eq(nextIndex).attr('data-cp'));
            $(targetElement5).val(list.eq(nextIndex).attr('data-unit'));
        } 
        else if (e.keyCode === 38) { // Up arrow key
            e.preventDefault();
            let prevIndex = focused.index() - 1;
            if (prevIndex < 0) {
                prevIndex = list.length - 1; // Loop to the last item
            }
            list.eq(prevIndex).focus();
            $(targetElement1).val(list.eq(prevIndex).find('td:first').text());
            $(targetElement1).attr("data-id", list.eq(prevIndex).data('id'));
            $(targetElement1).attr("data-groupe", list.eq(prevIndex).data('groupe'));
            $(targetElement5).attr('data-id',list.data('unit-id'));
            $(targetElement3).val(list.eq(prevIndex).attr('data-mrp'));
            $(targetElement4).val(list.eq(prevIndex).attr('data-cp'));
            $(targetElement5).val(list.eq(prevIndex).attr('data-unit'));
        } 
        else if (e.keyCode === 13) { // Enter key
            e.preventDefault();
            $(targetElement2).html('');
            $(targetElement1).focus();
        }
        else if (e.keyCode === 9) { // Tab key
            e.preventDefault();
        }
    }

    // Search Product by Name
    function getProductByGroupe(groupe, groupein, product, targetElement1) {
        $.ajax({
            url: "/get/products/groupe",
            method: 'GET',
            data: { groupe: groupe, groupein:groupein, product:product },
            success: function (res) {
                $(targetElement1).html(res);
            }
        });
    }

    /////////////// ------------------ Search Head By Name And Groupe add value to input ajax part end ---------------- /////////////////////////////




});