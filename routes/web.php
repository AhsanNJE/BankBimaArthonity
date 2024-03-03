<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\ClientController;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\Backend\TransactionController;
use App\Http\Controllers\Backend\PartyPaymentController;
use App\Http\Controllers\Backend\ReportController;

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
        Route::post('/insert/locations', 'InsertLocations')->name('insert.locations');
        Route::get('/edit/locations', 'EditLocations')->name('edit.locations');
        Route::put('/update/locations', 'UpdateLocations')->name('update.locations');
        Route::delete('/delete/locations', 'DeleteLocations')->name('delete.locations');
        //search routes start
        Route::get('/search/locations', 'SearchLocations')->name('search.locations');
        Route::get('/search/locations/district', 'SearchLocationByDistrict')->name('search.locations.district');
        Route::get('/search/locations/upazila', 'SearchLocationByUpazila')->name('search.locations.upazila');
        //pagination routes start
        Route::get('/locations/pagination', 'LocationPagination');
        Route::get('/locations/search/pagination', 'SearchLocations');
        Route::get('/locations/search/pagination/dictrict', 'SearchLocationByDistrict');
        Route::get('/locations/search/pagination/upazila', 'SearchLocationByUpazila');
        //search list routs
        Route::get('/get/location/upazila', 'GetLocationByUpazila');



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
        Route::get('/get/department/name', 'GetDepartmentByName');


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
        Route::get('/get/designation/name/department', 'GetDesignationByNameAndDepartment');



        ///////////// --------------- Employees routes ----------- ///////////////////
        //crud routes start 
        Route::get('/', 'ShowEmployees')->name('show.employees');
        Route::post('/insert/employees', 'InsertEmployees')->name('insert.employees');
        Route::get('/edit/employees', 'EditEmployees')->name('edit.employees');
        Route::put('/update/employees', 'UpdateEmployees')->name('update.employees');
        Route::delete('/delete/employees', 'DeleteEmployees')->name('delete.employees');
        //search routes start
        Route::get('/search/employees', 'SearchEmployees')->name('search.employees');
        //pagination routes start
        Route::get('/pagination', 'EmployeePagination');
        Route::get('/search/pagination', 'SearchEmployees');
        //search list routs
        Route::get('/get/employeeby/name', 'GetEmployeeByName')->name('get.employee.by.name');
        
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
        Route::get('/get/heads/groupe', 'GetTransactionHeadByGroupe');


        ////////////////////////// --------------- Transaction Details routes ----------- ///////////////////////////
        //main crude Routes
        Route::get('/', 'ShowTransactions')->name('show.transaction');
        Route::post('/insert/main', 'InsertTransactionMain')->name('insert.transaction.main');
        Route::get('/edit/main', 'EditTransactionMain')->name('edit.transaction.main');
        Route::put('/update/main', 'UpdateTransactionMain')->name('update.transaction.main');
        Route::delete('/delete/main', 'DeleteTransactionMain')->name('delete.transaction.main');
        //details crud routes start
        Route::post('/insert/details', 'InsertTransactionDetails')->name('insert.transaction.details');
        Route::get('/edit/details', 'EditTransactionDetails')->name('edit.transaction.details');
        Route::put('/update/details', 'UpdateTransactionDetails')->name('update.transaction.details');
        Route::delete('/delete/details', 'DeleteTransactionDetails')->name('delete.transaction.details');
        
        //search routes start
        Route::get('/search/details', 'SearchTransactionDetails')->name('search.transaction.details');
        //pagination routes start
        Route::get('/details/pagination', 'TransactionHeadPagination');
        Route::get('/details/search/pagination', 'SearchTransactionDetails');
        //search list routs
        Route::get('/getdetails/tranid', 'GetTransactionDetailsByTranId');



        ////////////////////////// --------------- Transaction Main routes ----------- ///////////////////////////
        //search routes start
        Route::get('/search/main', 'SearchTransactionMain')->name('search.transaction.main');
        //pagination routes start
        Route::get('/main/pagination', 'TransactionMainPagination');
        Route::get('/main/search/pagination', 'SearchTransactionMain');
        //search list routs
        Route::get('/get/tranid', 'GetTransactionId');
        Route::get('/get/tranuser', 'GetTransactionUser');
        Route::get('/get/transactiongrid', 'GetTransactionGrid');

    });
});



Route::controller(PartyPaymentController::class)->group(function(){
    Route::prefix('/party')->group(function(){
        //main crude Routes
        Route::get('/', 'ShowParty')->name('show.party');
        Route::post('/insert/party', 'InsertParty')->name('insert.party');
        Route::get('/edit/party', 'EditParty')->name('edit.party');
        Route::put('/update/party', 'UpdateParty')->name('update.party');
        Route::delete('/delete/party', 'DeleteParty')->name('delete.party');
        //search list routs
        Route::get('/get/tranid', 'GetTransactionId');
        Route::get('/get/tranuser', 'GetTransactionUser');
        Route::get('/get/trandue/userid', 'GetTransactionDueByUserId');
    });
});


/////////////////////////////////////// Report Controller All Routes ////////////////////////////////

// Due Reports For Client & Supplier //
Route::controller(ReportController::class)->group(function(){
    //ALL
    Route::get('/pending/all/due','PendingAllDue')->name('pending.all.due');
    Route::post('/filter','Filter');
    Route::get('/pagination/pagination-data', 'Pagination');
    Route::get('/search/due/statement', 'SearchDueStatement')->name('search.due.statement');
    //Pay All Due Statement Update
    Route::get('/pending/all/due/{id}','PendingAllDueAjax');
    Route::post('/trans/update/due','TransUpdateDue')->name('trans.update.due');
    Route::get('/trans/details/{trans_id}','TransDetails')->name('trans.details');
    //Client
    Route::get('/client/due/transaction', 'ClientDueTransaction')->name('client.due.transaction');
    Route::post('/client/filter', 'ClientFilter');
    //Supplier
    Route::get('/supplier/due/transaction', 'SupplierDueTransaction')->name('supplier.due.transaction');
    Route::post('/supplier/filter', 'SupplierFilter');
});