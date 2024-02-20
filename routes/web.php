<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\Backend\ClientController;
use App\Http\Controllers\Backend\TransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
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
        Route::post('/insert/locations', 'InsertLocations')->name('insert.locations');
        Route::get('/edit/locations', 'EditLocations')->name('edit.locations');
        Route::put('/update/locations', 'UpdateLocations')->name('update.locations');
        Route::delete('/delete/locations', 'DeleteLocations')->name('delete.locations');
        //search routes start
        Route::get('/search/locations', 'SearchLocations')->name('search.locations');
        Route::get('/search/locations/district', 'SearchLocationByDistrict')->name('search.locations.district');
        Route::get('/search/locations/thana', 'SearchLocationByThana')->name('search.locations.thana');
        //pagination routes start
        Route::get('/locations/pagination', 'LocationPagination');
        Route::get('/locations/search/pagination', 'SearchLocations');
        Route::get('/locations/search/pagination/dictrict', 'SearchLocationByDistrict');
        Route::get('/locations/search/pagination/thana', 'SearchLocationByThana');
        //search list routs
        Route::get('/get/locationby/thana', 'GetLocationByThana');



        ///////////// --------------- Department routes ----------- ///////////////////
        //crud routes start
        Route::get('/departments', 'ShowDepartments')->name('show.departments');
        Route::post('/insert/departments', 'InsertDepartments')->name('insert.departments');
        Route::get('/edit/departments', 'EditDepartments')->name('edit.departments');
        Route::put('/update/departments', 'UpdateDepartments')->name('update.departments');
        Route::delete('/delete/departments', 'DeleteDepartments')->name('delete.departments');
        //search routes start
        Route::get('/search/departments', 'SearchDepartments')->name('search.departments');
        //pagination routes start
        Route::get('/departments/pagination', 'DepartmentPagination');
        Route::get('/departments/search/pagination', 'SearchDepartments');
        //search list routs
        Route::get('/get/departmentby/name', 'GetDepartmentByName');




        ///////////// --------------- Designation routes ----------- ///////////////////
        //crud routes start
        Route::get('/designations', 'ShowDesignations')->name('show.designations');
        Route::post('/insert/designations', 'InsertDesignations')->name('insert.designations');
        Route::get('/edit/designations', 'EditDesignations')->name('edit.designations');
        Route::put('/update/designations', 'UpdateDesignations')->name('update.designations');
        Route::delete('/delete/designations', 'DeleteDesignations')->name('delete.designations');
        //search routes start
        Route::get('/search/designations', 'SearchDesignations')->name('search.designations');
        Route::get('/search/designations/department', 'SearchDesignationsByDepartment')->name('search.designations.by.department');
        //pagination routes start
        Route::get('/designations/pagination', 'DesignationPagination');
        Route::get('/designations/search/pagination', 'SearchDesignations');
        Route::get('/designations/search/pagination/department', 'SearchDesignationsByDepartment');
        //search list routs
        Route::get('/get/designationby/name/department', 'GetDesignationByNameAndDepartment');



        ///////////// --------------- Employees routes ----------- ///////////////////
        //crud routes start 
        Route::get('/', 'ShowEmployees')->name('show.employees');
        Route::post('/insert/employees', 'InsertEmployees')->name('insert.employees');
        Route::get('/edit/employees', 'EditEmployees')->name('edit.employees');
        Route::put('/update/employees', 'UpdateEmployees')->name('update.employees');
        Route::delete('/delete/employees', 'DeleteEmployees')->name('delete.employees');
        //search routes start
        Route::get('/search/units', 'SearchUnits')->name('search.employees');
        //pagination routes start
        Route::get('/pagination', 'EmployeePagination');
        Route::get('/search/pagination', 'SearchEmployees');
        //search list routs
        Route::get('/get/employeeby/name', 'GetUnitByName')->name('get.employee.by.name');
        
    });
});










// ********************************************** Supplier Controller routes *************************************** //

Route::controller(SupplierController::class)->group(function(){
    ///////////// --------------- Suppliers routes ----------- ///////////////////
    //crud routes start
    Route::get('/suppliers', 'ShowSuppliers')->name('show.suppliers');
    Route::post('/insert/suppliers', 'InsertSuppliers')->name('insert.suppliers');
    Route::get('/edit/suppliers', 'EditSuppliers')->name('edit.suppliers');
    Route::put('/update/suppliers', 'UpdateSuppliers')->name('update.suppliers');
    Route::delete('/delete/suppliers', 'DeleteSuppliers')->name('delete.suppliers');
    //search routes start
    Route::get('/search/supplier/name', 'SearchSuppliers')->name('search.supplier.name');
    Route::get('/search/supplier/email', 'SearchSupplierByEmail')->name('search.supplier.email');
    Route::get('/search/supplier/phone', 'SearchSupplierByContact')->name('search.supplier.contact');
    Route::get('/search/supplier/location', 'SearchSupplierByLocation')->name('search.supplier.location');
    Route::get('/search/supplier/address', 'SearchSupplierByAddress')->name('search.supplier.address');
    //pagination routes start
    Route::get('/supplier/pagination', 'SupplierPagination');
    Route::get('/supplier/name/pagination', 'SearchSuppliers');
    Route::get('/supplier/email/pagination', 'SearchSupplierByEmail');
    Route::get('/supplier/phone/pagination', 'SearchSupplierByContact');
    Route::get('/supplier/address/pagination', 'SearchSupplierByAddress');
    Route::get('/supplier/location/pagination', 'SearchSupplierByLocation');
    //search list routs
    Route::get('/get/supplierby/name', 'GetSupplierByName')->name('get.supplier.by.name');

});







// ********************************************** Client Controller routes *************************************** //

Route::controller(ClientController::class)->group(function(){
    ///////////// --------------- Clients routes ----------- ///////////////////
    //crud routes start
    Route::get('/clients', 'ShowClients')->name('show.clients');
    Route::post('/insert/clients', 'InsertClients')->name('insert.clients');
    Route::get('/edit/clients', 'EditClients')->name('edit.clients');
    Route::put('/update/clients', 'UpdateClients')->name('update.clients');
    Route::delete('/delete/clients', 'DeleteClients')->name('delete.clients');
    //search routes start
    Route::get('/search/client/name', 'SearchClients')->name('search.client.name');
    Route::get('/search/client/email', 'SearchClientByEmail')->name('search.client.email');
    Route::get('/search/client/contact', 'SearchClientByContact')->name('search.client.contact');
    Route::get('/search/client/location', 'SearchClientByLocation')->name('search.client.location');
    Route::get('/search/client/address', 'SearchClientByAddress')->name('search.client.address');
    //pagination routes start
    Route::get('/client/pagination', 'ClientPagination');
    Route::get('/client/name/pagination', 'SearchClients');
    Route::get('/client/email/pagination', 'SearchClientByEmail');
    Route::get('/client/contact/pagination', 'SearchClientByContact');
    Route::get('/client/location/pagination', 'SearchClientByLocation');
    Route::get('/client/address/pagination', 'SearchClientByAddress');
    //search list routs

});







// ********************************************** Transaction Controller routes *************************************** //

Route::controller(TransactionController::class)->group(function(){
    Route::prefix('/transaction')->group(function(){
        ////////////////////////// --------------- Transaction Groupes routes ----------- /////////////////////////
        //crud routes start
        Route::get('/groupes', 'ShowTransactionGroupes')->name('show.transaction.groupes');
        Route::post('/insert/groupes', 'InsertTransactionGroupes')->name('insert.transaction.groupes');
        Route::get('/edit/groupes', 'EditTransactionGroupes')->name('edit.transaction.groupes');
        Route::put('/update/groupes', 'UpdateTransactionGroupes')->name('update.transaction.groupes');
        Route::delete('/delete/groupes', 'DeleteTransactionGroupes')->name('delete.transaction.groupes');
        //search routes start
        Route::get('/search/groupes', 'SearchTransactionGroupes')->name('search.transaction.groupes');
        //pagination routes start
        Route::get('/groupes/pagination', 'TransactionGroupePagination');
        Route::get('/groupes/search/pagination', 'SearchTransactionGroupes');
        //search list routs
        Route::get('/get/groupeby/name', 'GetTransactionGroupeByName');




        ////////////////////////// --------------- Transaction Heads routes ----------- ///////////////////////////
        //crud routes start
        Route::get('/heads', 'ShowTransactionHeads')->name('show.transaction.heads');
        Route::post('/insert/heads', 'InsertTransactionHeads')->name('insert.transaction.heads');
        Route::get('/edit/heads', 'EditTransactionHeads')->name('edit.transaction.heads');
        Route::put('/update/heads', 'UpdateTransactionHeads')->name('update.transaction.heads');
        Route::delete('/delete/heads', 'DeleteTransactionHeads')->name('delete.transaction.heads');
        //search routes start
        Route::get('/search/heads', 'SearchTransactionHeads')->name('search.transaction.heads');
        Route::get('/search/heads/groupe', 'SearchTransactionHeadsByGroupe')->name('search.transaction.heads.by.groupe');
        //pagination routes start
        Route::get('/heads/pagination', 'TransactionHeadPagination');
        Route::get('/heads/search/pagination', 'SearchTransactionHeads');
        Route::get('/heads/search/pagination/groupe', 'SearchTransactionHeadsByGroupe');
        //search list routs
        Route::get('/get/headsby/name/groupe', 'GetTransactionHeadByGroupe');
    });
});