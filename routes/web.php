<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\ClientController;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\Backend\TransactionController;
use App\Http\Controllers\Backend\PartyPaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});




// ********************************************** Admin Controller routes *************************************** //
Route::get('admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');








// ********************************************** Employee Controller routes *************************************** //

Route::controller(EmployeeController::class)->group(function(){
    Route::prefix('/admin/employees')->group(function(){

        ///////////// --------------- Location routes ----------- ///////////////////
        //crud routes start
        Route::get('/locations', 'ShowLocations')->name('show.locations');
        Route::post('/insertLocations', 'InsertLocations')->name('insert.locations');
        Route::get('/editLocations', 'EditLocations')->name('edit.locations');
        Route::put('/updateLocations', 'UpdateLocations')->name('update.locations');
        Route::delete('/deleteLocations', 'DeleteLocations')->name('delete.locations');
        //search routes start
        Route::get('/searchLocations', 'SearchLocations')->name('search.locations');
        Route::get('/searchLocations/district', 'SearchLocationByDistrict')->name('search.locations.district');
        Route::get('/searchLocations/thana', 'SearchLocationByThana')->name('search.locations.thana');
        //pagination routes start
        Route::get('/locations/pagination', 'LocationPagination');
        Route::get('/locations/searchPagination', 'SearchLocations');
        Route::get('/locations/searchPagination/dictrict', 'SearchLocationByDistrict');
        Route::get('/locations/searchPagination/thana', 'SearchLocationByThana');
        //search list routs
        Route::get('/getLocationByThana', 'GetLocationByThana');



        ///////////// --------------- Department routes ----------- ///////////////////
        //crud routes start
        Route::get('/departments', 'ShowDepartments')->name('show.departments');
        Route::post('/insertDepartments', 'InsertDepartments')->name('insert.departments');
        Route::get('/editDepartments', 'EditDepartments')->name('edit.departments');
        Route::put('/updateDepartments', 'UpdateDepartments')->name('update.departments');
        Route::delete('/deleteDepartments', 'DeleteDepartments')->name('delete.departments');
        //search routes start
        Route::get('/searchDepartments', 'SearchDepartments')->name('search.departments');
        //pagination routes start
        Route::get('/departments/pagination', 'DepartmentPagination');
        Route::get('/departments/searchPagination', 'SearchDepartments');
        //search list routs
        Route::get('/getDepartmentByName', 'GetDepartmentByName');




        ///////////// --------------- Designation routes ----------- ///////////////////
        //crud routes start
        Route::get('/designations', 'ShowDesignations')->name('show.designations');
        Route::post('/insertDesignations', 'InsertDesignations')->name('insert.designations');
        Route::get('/editDesignations', 'EditDesignations')->name('edit.designations');
        Route::put('/updateDesignations', 'UpdateDesignations')->name('update.designations');
        Route::delete('/deleteDesignations', 'DeleteDesignations')->name('delete.designations');
        //search routes start
        Route::get('/searchDesignations', 'SearchDesignations')->name('search.designations');
        Route::get('/searchDesignations/department', 'SearchDesignationsByDepartment')->name('search.designations.by.department');
        //pagination routes start
        Route::get('/designations/pagination', 'DesignationPagination');
        Route::get('/designations/searchPagination', 'SearchDesignations');
        Route::get('/designations/searchPagination/department', 'SearchDesignationsByDepartment');
        //search list routs
        Route::get('/getDesignationByName/department', 'GetDesignationByNameAndDepartment');



        ///////////// --------------- Employees routes ----------- ///////////////////
        //crud routes start
        Route::get('/', 'ShowEmployees')->name('show.employees');
        Route::post('/insertEmployees', 'InsertEmployees')->name('insert.employees');
        Route::get('/editEmployees', 'EditEmployees')->name('edit.employees');
        Route::put('/updateEmployees', 'UpdateEmployees')->name('update.employees');
        Route::delete('/deleteEmployees', 'DeleteEmployees')->name('delete.employees');
        //search routes start
        Route::get('/searchUnits', 'SearchUnits')->name('search.employees');
        //pagination routes start
        Route::get('/pagination', 'EmployeePagination');
        Route::get('/searchPagination', 'SearchEmployees');
        //search list routs
        Route::get('/getEmployeeByName', 'GetUnitByName')->name('get.employee.by.name');
        
    });
});










// ********************************************** Supplier Controller routes *************************************** //

Route::controller(SupplierController::class)->group(function(){
    ///////////// --------------- Suppliers routes ----------- ///////////////////
    //crud routes start
    Route::get('/suppliers', 'ShowSuppliers')->name('show.suppliers');
    Route::post('/insertSuppliers', 'InsertSuppliers')->name('insert.suppliers');
    Route::get('/editSuppliers', 'EditSuppliers')->name('edit.suppliers');
    Route::put('/updateSuppliers', 'UpdateSuppliers')->name('update.suppliers');
    Route::delete('/deleteSuppliers', 'DeleteSuppliers')->name('delete.suppliers');
    //search routes start
    Route::get('/searchSupplier/name', 'SearchSuppliers')->name('search.supplier.name');
    Route::get('/searchSupplier/email', 'SearchSupplierByEmail')->name('search.supplier.email');
    Route::get('/searchSupplier/phone', 'SearchSupplierByContact')->name('search.supplier.contact');
    Route::get('/searchSupplier/location', 'SearchSupplierByLocation')->name('search.supplier.location');
    Route::get('/searchSupplier/address', 'SearchSupplierByAddress')->name('search.supplier.address');
    //pagination routes start
    Route::get('/supplier/pagination', 'SupplierPagination');
    Route::get('/supplier/namePagination', 'SearchSuppliers');
    Route::get('/supplier/emailPagination', 'SearchSupplierByEmail');
    Route::get('/supplier/phonePagination', 'SearchSupplierByContact');
    Route::get('/supplier/addressPagination', 'SearchSupplierByAddress');
    Route::get('/supplier/locationPagination', 'SearchSupplierByLocation');
    //search list routs
    Route::get('/getSupplierByName', 'GetSupplierByName')->name('get.supplier.by.name');

});







// ********************************************** Client Controller routes *************************************** //

Route::controller(ClientController::class)->group(function(){
    ///////////// --------------- Clients routes ----------- ///////////////////
    //crud routes start
    Route::get('/clients', 'ShowClients')->name('show.clients');
    Route::post('/insertClients', 'InsertClients')->name('insert.clients');
    Route::get('/editClients', 'EditClients')->name('edit.clients');
    Route::put('/updateClients', 'UpdateClients')->name('update.clients');
    Route::delete('/deleteClients', 'DeleteClients')->name('delete.clients');
    //search routes start
    Route::get('/searchClient/name', 'SearchClients')->name('search.client.name');
    Route::get('/searchClient/email', 'SearchClientByEmail')->name('search.client.email');
    Route::get('/searchClient/contact', 'SearchClientByContact')->name('search.client.contact');
    Route::get('/searchClient/location', 'SearchClientByLocation')->name('search.client.address');
    Route::get('/searchClient/address', 'SearchClientByAddress')->name('search.client.address');
    //pagination routes start
    Route::get('/client/pagination', 'ClientPagination');
    Route::get('/client/namePagination', 'SearchClients');
    Route::get('/client/emailPagination', 'SearchClientByEmail');
    Route::get('/client/contactPagination', 'SearchClientByContact');
    Route::get('/client/locationPagination', 'SearchClientByLocation');
    Route::get('/client/addressPagination', 'SearchClientByAddress');
    //search list routs

});







// ********************************************** Transaction Controller routes *************************************** //

Route::controller(TransactionController::class)->group(function(){
    Route::prefix('/transaction')->group(function(){
        ////////////////////////// --------------- Transaction Groupes routes ----------- /////////////////////////
        //crud routes start
        Route::get('/groupes', 'ShowTransactionGroupes')->name('show.transaction.groupes');
        Route::post('/insertGroupes', 'InsertTransactionGroupes')->name('insert.transaction.groupes');
        Route::get('/editGroupes', 'EditTransactionGroupes')->name('edit.transaction.groupes');
        Route::put('/updateGroupes', 'UpdateTransactionGroupes')->name('update.transaction.groupes');
        Route::delete('/deleteGroupes', 'DeleteTransactionGroupes')->name('delete.transaction.groupes');
        //search routes start
        Route::get('/searchGroupes', 'SearchTransactionGroupes')->name('search.transaction.groupes');
        //pagination routes start
        Route::get('/groupes/pagination', 'TransactionGroupePagination');
        Route::get('/groupes/searchPagination', 'SearchTransactionGroupes');
        //search list routs
        Route::get('/getGroupeByName', 'GetTransactionGroupeByName');




        ////////////////////////// --------------- Transaction Heads routes ----------- ///////////////////////////
        //crud routes start
        Route::get('/heads', 'ShowTransactionHeads')->name('show.transaction.heads');
        Route::post('/insertHeads', 'InsertTransactionHeads')->name('insert.transaction.heads');
        Route::get('/editHeads', 'EditTransactionHeads')->name('edit.transaction.heads');
        Route::put('/updateHeads', 'UpdateTransactionHeads')->name('update.transaction.heads');
        Route::delete('/deleteHeads', 'DeleteTransactionHeads')->name('delete.transaction.heads');
        //search routes start
        Route::get('/searchHeads', 'SearchTransactionHeads')->name('search.transaction.heads');
        Route::get('/searchHeads/groupe', 'SearchTransactionHeadsByGroupe')->name('search.transaction.heads.by.groupe');
        //pagination routes start
        Route::get('/heads/pagination', 'TransactionHeadPagination');
        Route::get('/heads/searchPagination', 'SearchTransactionHeads');
        Route::get('/heads/searchPagination/groupe', 'SearchTransactionHeadsByGroupe');
        //search list routs
        Route::get('/getHeads/groupe', 'GetTransactionHeadByGroupe');


        ////////////////////////// --------------- Transaction Details routes ----------- ///////////////////////////
        //main crude Routes
        Route::get('/', 'ShowTransactions')->name('show.transaction');
        Route::post('/insertMain', 'InsertTransactionMain')->name('insert.transaction.main');
        Route::get('/editMain', 'EditTransactionMain')->name('edit.transaction.main');
        Route::put('/updateMain', 'UpdateTransactionMain')->name('update.transaction.main');
        Route::delete('/deleteMain', 'DeleteTransactionMain')->name('delete.transaction.main');
        //details crud routes start
        Route::post('/insertDetails', 'InsertTransactionDetails')->name('insert.transaction.details');
        Route::get('/editDetails', 'EditTransactionDetails')->name('edit.transaction.details');
        Route::put('/updateDetails', 'UpdateTransactionDetails')->name('update.transaction.details');
        Route::delete('/deleteDetails', 'DeleteTransactionDetails')->name('delete.transaction.details');
        
        //search routes start
        Route::get('/searchDetails', 'SearchTransactionDetails')->name('search.transaction.details');
        //pagination routes start
        Route::get('/details/pagination', 'TransactionHeadPagination');
        Route::get('/details/searchPagination', 'SearchTransactionDetails');
        //search list routs
        Route::get('/getDetails/TranId', 'GetTransactionDetailsByTranId');



        ////////////////////////// --------------- Transaction Main routes ----------- ///////////////////////////
        //search routes start
        Route::get('/searchMain', 'SearchTransactionMain')->name('search.transaction.main');
        //pagination routes start
        Route::get('/main/pagination', 'TransactionMainPagination');
        Route::get('/main/searchPagination', 'SearchTransactionMain');
        //search list routs
        Route::get('/getTranId', 'GetTransactionId');
        Route::get('/getTranUser', 'GetTransactionUser');
        Route::get('/getTransactionGrid', 'GetTransactionGrid');

    });



    Route::controller(PartyPaymentController::class)->group(function(){
        Route::prefix('/party')->group(function(){
            //main crude Routes
            Route::get('/', 'ShowParty')->name('show.party');
            Route::post('/insertParty', 'InsertParty')->name('insert.party');
            Route::get('/editParty', 'EditParty')->name('edit.party');
            Route::put('/updateParty', 'UpdateParty')->name('update.party');
            Route::delete('/deleteParty', 'DeleteParty')->name('delete.party');
            //search list routs
            Route::get('/getTranId', 'GetTransactionId');
            Route::get('/getTranUser', 'GetTransactionUser');
        });
    });
});