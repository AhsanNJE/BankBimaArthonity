<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\ClientController;
use App\Http\Controllers\Backend\BankController;
use App\Http\Controllers\Backend\EmployeeController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\Backend\TransactionController;
use App\Http\Controllers\Backend\PartyPaymentController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\PayRollController;
use App\Http\Controllers\Backend\InfoController;
use App\Http\Controllers\Backend\InventoryController;
use App\Http\Controllers\Backend\ManufacturerController;
use App\Http\Controllers\Backend\CategoryController;

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

/*---------------------------------- Admin Login -----------------------------------------------*/

Route::prefix('admin')->group(function(){

    Route::get('/login', [AdminController::class, 'Index'])->name('login_from');
    Route::post('/login/owner', [AdminController::class, 'Login'])->name('admin.login');
    Route::get('/dashboard', [AdminController::class, 'Dashboard'])->name('admin.dashboard')->middleware('admin');
    Route::get('/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/register', [AdminController::class, 'AdminRegister'])->name('admin.register');
    Route::post('/register/create', [AdminController::class, 'AdminRegisterCreate'])->name('admin.register.create');
});

/*--------------------------------End Admin Login ----------------------------------------------*/

Route::get('/', function () {
    return view('welcome');
});

// ********************************************** Admin Controller routes *************************************** //
// Route::get('admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// ********************************************** Employee Controller routes *************************************** //

Route::controller(EmployeeController::class)->group(function () {
    Route::prefix('/admin/employees')->group(function () {
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
        Route::get('/details', 'ShowEmployeeDetails')->name('show.employee.details');
        Route::post('/insert/employees', 'InsertEmployees')->name('insert.employees');
        Route::get('/edit/employees', 'EditEmployees')->name('edit.employees');
        Route::put('/update/employees', 'UpdateEmployees')->name('update.employees');
        Route::delete('/delete/employees', 'DeleteEmployees')->name('delete.employees');
        //search routes start
        Route::get('/search/employees', 'SearchEmployees')->name('search.employees.name');
        Route::get('/search/employees/email', 'SearchEmployeeByEmail')->name('search.employees.email');
        Route::get('/search/employees/phone', 'SearchEmployeeByPhone')->name('search.employees.phone');
        Route::get('/search/employees/location', 'SearchEmployeeByLocation')->name('search.employees.location');
        Route::get('/search/employees/address', 'SearchEmployeeByAddress')->name('search.employees.address');
        Route::get('/search/employees/nid', 'SearchEmployeeByNid')->name('search.employees.nid');
        Route::get('/search/employees/dob', 'SearchEmployeeByDob')->name('search.employees.dob');
        Route::get('/search/employees/department', 'SearchEmployeeByDepartment')->name('search.employees.department');
        Route::get('/search/employees/designation', 'SearchEmployeeByDesignation')->name('search.employees.designation');
        Route::get('/search/employees/type', 'SearchEmployeeByType')->name('search.employees.type');
        //pagination routes start
        Route::get('/pagination', 'EmployeePagination');
        Route::get('/search/pagination', 'SearchEmployees');
        Route::get('/search/pagination/email', 'SearchEmployeeByEmail');
        Route::get('/search/pagination/phone', 'SearchEmployeeByPhone');
        Route::get('/search/pagination/location', 'SearchEmployeeByLocation');
        Route::get('/search/pagination/address', 'SearchEmployeeByAddress');
        Route::get('/search/pagination/nid', 'SearchEmployeeByNid');
        Route::get('/search/pagination/dob', 'SearchEmployeeByDob');
        Route::get('/search/pagination/department', 'SearchEmployeeByDepartment');
        Route::get('/search/pagination/designation', 'SearchEmployeeByDesignation');
        Route::get('/search/pagination/type', 'SearchEmployeeByType');
        //search list routs
        Route::get('/get/employeeby/name', 'GetEmployeeByName')->name('get.employee.by.name');
    });
});


// ********************************************** Supplier Controller routes *************************************** //

Route::controller(SupplierController::class)->group(function () {

    ///////////// --------------- Suppliers routes ----------- ///////////////////
    //crud routes start
    Route::get('/suppliers', 'ShowSuppliers')->name('show.suppliers');
    Route::get('/supplier/details', 'ShowSupplierDetails')->name('show.supplier.details');
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
    Route::get('/search/supplier/type', 'SearchSupplierByType')->name('search.supplier.type');
    //pagination routes start
    Route::get('/supplier/pagination', 'SupplierPagination');
    Route::get('/supplier/name/pagination', 'SearchSuppliers');
    Route::get('/supplier/email/pagination', 'SearchSupplierByEmail');
    Route::get('/supplier/phone/pagination', 'SearchSupplierByContact');
    Route::get('/supplier/address/pagination', 'SearchSupplierByAddress');
    Route::get('/supplier/location/pagination', 'SearchSupplierByLocation');
    Route::get('/supplier/type/pagination', 'SearchSupplierByType');
    //search list routs
    Route::get('/get/supplierby/name', 'GetSupplierByName')->name('get.supplier.by.name');
});


// ********************************************** Client Controller routes *************************************** //

Route::controller(ClientController::class)->group(function () {

    ///////////// --------------- Clients routes ----------- ///////////////////
    //crud routes start
    Route::get('/clients', 'ShowClients')->name('show.clients');
    Route::get('/client/details', 'ShowClientDetails')->name('show.client.details');
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
    Route::get('/search/client/type', 'SearchClientByType')->name('search.client.type');
    //pagination routes start
    Route::get('/client/pagination', 'ClientPagination');
    Route::get('/client/name/pagination', 'SearchClients');
    Route::get('/client/email/pagination', 'SearchClientByEmail');
    Route::get('/client/contact/pagination', 'SearchClientByContact');
    Route::get('/client/location/pagination', 'SearchClientByLocation');
    Route::get('/client/address/pagination', 'SearchClientByAddress');
    Route::get('/client/type/pagination', 'SearchClientByType');
    //search list routs
});



// ********************************************** Bank Controller routes *************************************** //

Route::controller(BankController::class)->group(function () {
    ///////////// --------------- Banks routes ----------- ///////////////////
    //crud routes start
    Route::get('/banks', 'ShowBanks')->name('show.banks');
    Route::get('/bank/details', 'ShowBankDetails')->name('show.bank.details');
    Route::post('/insert/banks', 'InsertBanks')->name('insert.banks');
    Route::get('/edit/banks', 'EditBanks')->name('edit.banks');
    Route::put('/update/banks', 'UpdateBanks')->name('update.banks');
    Route::delete('/delete/banks', 'DeleteBanks')->name('delete.banks');
    //search routes start
    Route::get('/search/bank/name', 'SearchBanks')->name('search.bank.name');
    Route::get('/search/bank/email', 'SearchBankByEmail')->name('search.bank.email');
    Route::get('/search/bank/contact', 'SearchBankByContact')->name('search.bank.contact');
    Route::get('/search/bank/location', 'SearchBankByLocation')->name('search.bank.location');
    Route::get('/search/bank/address', 'SearchBankByAddress')->name('search.bank.address');
    //pagination routes start
    Route::get('/bank/pagination', 'BankPagination');
    Route::get('/bank/name/pagination', 'SearchBanks');
    Route::get('/bank/email/pagination', 'SearchBankByEmail');
    Route::get('/bank/contact/pagination', 'SearchBankByContact');
    Route::get('/bank/location/pagination', 'SearchBankByLocation');
    Route::get('/bank/address/pagination', 'SearchBankByAddress');
    //search list routs
});







// ********************************************** Transaction Controller routes *************************************** //

Route::controller(TransactionController::class)->group(function () {
    Route::prefix('/transaction')->group(function () {

        ////////////////////////// --------------- Transaction Types routes ----------- /////////////////////////
        //crud routes start
        Route::get('/types', 'ShowTransactionTypes')->name('show.transaction.types');
        Route::post('/insert/types', 'InsertTransactionTypes')->name('insert.transaction.types');
        Route::get('/edit/types', 'EditTransactionTypes')->name('edit.transaction.types');
        Route::put('/update/types', 'UpdateTransactionTypes')->name('update.transaction.types');
        Route::delete('/delete/types', 'DeleteTransactionTypes')->name('delete.transaction.types');
        //search routes start
        Route::get('/search/types', 'SearchTransactionTypes')->name('search.transaction.types');
        //pagination routes start
        Route::get('/types/pagination', 'TransactionTypePagination');
        Route::get('/types/search/pagination', 'SearchTransactionTypes');
        //search list routs
        Route::get('/get/types', 'GetTransactionType');



        ///////////// --------------- Tran With routes ----------- ///////////////////
        //crud routes start
        Route::get('/tranwith', 'ShowTranWith')->name('show.tranwith');
        Route::post('/insert/tranwith', 'InsertTranWith')->name('insert.tranwith');
        Route::get('/edit/tranwith', 'EditTranWith')->name('edit.tranwith');
        Route::put('/update/tranwith', 'UpdateTranWith')->name('update.tranwith');
        Route::delete('/delete/tranwith', 'DeleteTranWith')->name('delete.tranwith');
        //search routes start
        Route::get('/search/tranwith', 'SearchTranWith')->name('search.tranwith');
        //pagination routes start
        Route::get('/tranwith/pagination', 'TranWithPagination');
        Route::get('/tranwith/search/pagination', 'SearchTranWith');


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
        Route::get('/get/groupeby/type', 'GetTransactionGroupeByType');



        ///////////// --------------- Tran With Groupe routes ----------- ///////////////////
        //crud routes start
        Route::get('/tranwithgroupe', 'ShowTranWithGroupe')->name('show.tranwithgroupe');
        Route::post('/insert/tranwithgroupe', 'InsertTranWithGroupe')->name('insert.tranwithgroupe');
        Route::get('/edit/tranwithgroupe', 'EditTranWithGroupe')->name('edit.tranwithgroupe');
        Route::put('/update/tranwithgroupe', 'UpdateTranWithGroupe')->name('update.tranwithgroupe');
        Route::delete('/delete/tranwithgroupe', 'DeleteTranWithGroupe')->name('delete.tranwithgroupe');
        //search routes start
        Route::get('/search/tranwithgroupe/with', 'SearchTranWithGroupeByWith')->name('search.tranwithgroupe.with');
        Route::get('/search/tranwithgroupe/groupe', 'SearchTranWithGroupeByGroupe')->name('search.tranwithgroupe.groupe');
        //pagination routes start
        Route::get('/tranwithgroupe/pagination', 'TranWithGroupePagination');
        Route::get('/tranwithgroupe/search/pagination/with', 'SearchTranWithGroupeByWith');
        Route::get('/tranwithgroupe/search/pagination/groupe', 'SearchTranWithGroupeByGroupe');




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
        Route::get('/print', 'PrintTransactionDetails')->name('print.transaction');
        //search routes start
        Route::get('/search/date', 'ShowTransactionByDate')->name('search.transaction.date');
        Route::get('/search/tranid', 'SearchTransactionByTranId')->name('show.transaction.tranid');
        Route::get('/search/user', 'SearchTransactionByTranUser')->name('show.transaction.user');
        //pagination routes start
        Route::get('/pagination', 'TransactionPagination');
        Route::get('/pagination/date', 'ShowTransactionByDate');
        Route::get('/pagination/tranid', 'SearchTransactionByTranId');
        Route::get('/pagination/user', 'SearchTransactionByTranUser');
        //search list routs
        Route::get('/get/tranid', 'GetTransactionId');
        Route::get('/get/tranwith', 'GetTransactionWith');
        Route::get('/get/groupes/with', 'GetTransactionGroupeByWith');
        Route::get('/get/tranuser', 'GetTransactionUser');
        Route::get('/get/transactiongrid', 'GetTransactionGrid');
        Route::get('/getdetails/tranid', 'GetTransactionDetailsByTranId');

        // Transactionn Receive Details Routes
        Route::get('/receive', 'ShowTransactionReceive')->name('show.transaction.receive');

        // Transactionn Payment Details Routes
        Route::get('/payment', 'ShowTransactionPayment')->name('show.transaction.payment');
        
        // Positive Adjustment Routes
        Route::get('/positive', 'ShowPositiveAdjustment')->name('show.positive.adjustment');

        // Negative Adjustment Routes
        Route::get('/negative', 'ShowNegativeAdjustment')->name('show.negative.adjustment');


        ////////////////////////// --------------- Bank Transaction routes ----------- ///////////////////////////
        // Bank Withdraw transaction crude Routes
        Route::get('/bank/withdraw', 'ShowBankWithdraws')->name('show.bank.withdraws');
        Route::put('/bank/update', 'UpdateBankTransactions')->name('update.bank.transactions');
        Route::delete('/bank/withdraw/delete', 'DeleteBankWithdraws')->name('delete.bank.withdraws');
        // Bank Deposit transaction crude Routes
        Route::get('/bank/deposit', 'ShowBankDeposits')->name('show.bank.deposits');
        Route::delete('/bank/deposit/delete', 'DeleteBankDeposits')->name('delete.bank.deposits');
        



        ////////////////////////// --------------- Produt Transaction routes ----------- ///////////////////////////



    });
});


// ********************************************** PartyPayment Controller routes *************************************** //

Route::controller(PartyPaymentController::class)->group(function () {
    Route::prefix('/party')->group(function () {
        //main crude Routes
        Route::get('/', 'ShowParty')->name('show.party');
        Route::post('/insert/party', 'InsertParty')->name('insert.party');
        Route::get('/edit/party', 'EditParty')->name('edit.party');
        Route::put('/update/party', 'UpdateParty')->name('update.party');
        Route::delete('/delete/party', 'DeleteParty')->name('delete.party');
        //search routes start
        Route::get('/search/date', 'ShowPartyByDate')->name('search.party.date');
        Route::get('/search/tranid', 'SearchPartyByTranId')->name('search.party.tranid');
        Route::get('/search/user', 'SearchPartyByUser')->name('search.party.user');
        //pagination routes start
        Route::get('/pagination', 'PartyPagination');
        Route::get('/pagination/date', 'ShowPartyByDate');
        Route::get('/pagination/tranid', 'SearchPartyByTranId');
        Route::get('/pagination/user', 'SearchPartyByUser');

        //search list routs
        Route::get('/get/trandue/userid', 'GetTransactionDueByUserId');

        // Party Payment Receive Details Routes
        Route::get('/receive', 'ShowReceiveParty')->name('show.party.receive');

        // Party Payment Payment Details Routes
        Route::get('/payment', 'ShowPaymentParty')->name('show.party.payment');
    });
});


/////////////////////////////////////// Report Controller All Routes ////////////////////////////////

// Due Reports For Client & Supplier //
Route::controller(ReportController::class)->group(function () {
    //ALL
    Route::get('/pending/all/due', 'PendingAllDue')->name('pending.all.due');
    Route::post('/filter', 'Filter');
    Route::get('/pagination/pagination-data', 'Pagination');
    Route::get('/search/due/statement', 'SearchDueStatement')->name('search.due.statement');
    Route::get('/trans/invoice/{transinvoice_id}', 'TransInvoice')->name('trans.invoice');
    Route::get('/trans/invoice-download/{transpdfinvoice_id}', 'TransPdfInvoice');
    //Pay All Due Statement Update
    Route::get('/pending/all/due/{id}', 'PendingAllDueAjax');
    Route::post('/trans/update/due', 'TransUpdateDue')->name('trans.update.due');
    Route::get('/trans/details/{trans_id}', 'TransDetails')->name('trans.details');
    //Client
    Route::get('/client/due/transaction', 'ClientDueTransaction')->name('client.due.transaction');
    Route::post('/client/filter', 'ClientFilter');
    //Supplier
    Route::get('/supplier/due/transaction', 'SupplierDueTransaction')->name('supplier.due.transaction');
    Route::post('/supplier/filter', 'SupplierFilter');

    //////////////////////////// Party Reports Routes ///////////////////////////////////////////
    Route::get('/report/invoice/details', 'ReportInvoiceDetails')->name('report.invoice.details');
    Route::get('/report/groupe', 'ReportByGroupe')->name('report.groupe');
    Route::get('/summary/report', 'SummaryReport')->name('summary.report');
    Route::get('/party/summary/report', 'PartySummaryReport')->name('party.summary.report');
    Route::get('/party/details/report', 'PartyDetailsReport')->name('party.details.report');
    //pagination routes
    Route::get('/party/summary/report/pagination', 'PartySummaryReport');
    Route::get('/party/summary/report/search/pagination', 'SearchPartySummaryReport');
    Route::get('/party/details/report/pagination', 'PartyDetailsReport');
    Route::get('/party/details/report/search/pagination', 'SearchPartyDetailsReport');
    // Search Routes
    Route::get('/summary/report/search', 'SearchSummaryReport')->name('search.summary.report');
    Route::get('/report/groupe/search/date', 'SearchReportByGroupeDate')->name('report.groupe.search.date');
    Route::get('/party/summary/report/search', 'SearchPartySummaryReport')->name('party.summary.report.search');
    Route::get('/party/details/report/search', 'SearchPartyDetailsReport')->name('party.details.report.search');

    /////////////////////////////////// Balance Sheet Routes //////////////////////////////////////////////
    Route::get('/report/balancesheet/details', 'BalanceSheetDetailsReport')->name('report.balance.sheet.details');
    Route::get('/report/balancesheet/summary', 'BalanceSheetSummaryReport')->name('report.balance.sheet.summary');
    // Pagination Routes
    Route::get('/report/balancesheet/details/pagination', 'BalanceSheetDetailsReport');
    Route::get('/report/balancesheet/details/search/pagination', 'SearchBalanceSheetDetailsReport');
    Route::get('/report/balancesheet/summary/pagination', 'BalanceSheetSummaryReport');
    Route::get('/report/balancesheet/summary/search/pagination', 'SearchBalanceSheetSummaryReport');
    // Search Routes
    Route::get('/report/balancesheet/details/search', 'SearchBalanceSheetDetailsReport')->name('report.balance.sheet.details.search');
    Route::get('/report/balancesheet/summary/search', 'SearchBalanceSheetSummaryReport')->name('report.balance.sheet.summary.search');
});

///////////////////////////// PayRollController Controller ////////////////////////////////

Route::controller(PayRollController::class)->group(function(){
    ///Attendence All Route 
    Route::get('/employee/attend/list','EmployeeAttendenceList')->name('employee.attend.list'); 
    Route::get('/add/employee/attend','AddEmployeeAttendence')->name('add.employee.attend'); 
    Route::post('/employee/attend/store','EmployeeAttendenceStore')->name('employee.attend.store'); 
    Route::get('/edit/employee/attend/{date}','EditEmployeeAttendence')->name('employee.attend.edit'); 
    Route::get('/view/employee/attend/{date}','ViewEmployeeAttendence')->name('employee.attend.view');

    // payroll setup crude routes
    Route::get('/show/payroll/setup','ShowPayrollSetup')->name('show.payroll.setup'); 
    Route::post('/insert/payroll/setup','AddPayrollSetup')->name('add.payroll.setup'); 
    Route::get('/edit/payroll/setup','EditPayrollSetup')->name('edit.payroll.setup'); 
    Route::put('/update/payroll/setup','UpdatePayrollSetup')->name('update.payroll.setup'); 
    Route::delete('/delete/payroll/setup','DeletePayrollSetup')->name('delete.payroll.setup'); 
    // payroll setup search and pagination routes
    Route::get('/payroll/setup/pagination', 'PayrollSetupPagination');
    Route::get('/search/payroll/setup','SearchPayrollSetup');
    Route::get('/payroll/setup/get/user', 'GetPayrollSetupByUserId');


    // payroll middlewire crude routes
    Route::get('/show/payroll/middlewire','ShowPayrollMiddlewire')->name('show.payroll.middlewire'); 
    Route::post('/insert/payroll/middlewire','AddPayrollMiddlewire')->name('add.payroll.middlewire'); 
    Route::get('/edit/payroll/middlewire','EditPayrollMiddlewire')->name('edit.payroll.middlewire'); 
    Route::put('/update/payroll/middlewire','UpdatePayrollMiddlewire')->name('update.payroll.middlewire'); 
    Route::delete('/delete/payroll/middlewire','DeletePayrollMiddlewire')->name('delete.payroll.middlewire'); 
    // payroll middlewire search and pagination routes
    Route::get('/payroll/middlewire/pagination', 'PayrollMiddlewirePagination');
    Route::get('/search/payroll/middlewire','SearchPayrollMiddlewire');
    Route::get('/payroll/middlewire/get/user', 'GetPayrollMiddlewireByUserId');


    // payroll crude routes
    Route::get('/show/payroll','ShowPayroll')->name('show.payroll'); 
    Route::post('/insert/payroll','AddPayroll')->name('add.payroll'); 
    Route::get('/edit/payroll','EditPayroll')->name('edit.payroll'); 
    Route::put('/update/payroll','UpdatePayroll')->name('update.payroll'); 
    Route::delete('/delete/payroll','DeletePayroll')->name('delete.payroll'); 
    // payroll search and pagination routes
    Route::get('/payroll/pagination', 'PayrollPagination');
    Route::get('/payroll/get/user', 'GetPayrollByUserId');
    Route::get('/payroll/get/user/date', 'GetPayrollByUserIdAndDate');
    Route::get('/search/payroll', 'SearchPayroll');
});



////////////////////////// --------------- HR routes ----------- ///////////////////////////


    //Personal Routes
    Route::post('insert/personal/info', [InfoController::class, 'InsertPersonalDetails'])->name('insertpersonal.info');  
    Route::get('show/personal/info', [InfoController::class, 'ShowEmployeesPersonalInfo'])->name('show.personalinfo');
    Route::get('/new/employee/personal', [InfoController::class, 'EmployeesPersonalInfo'])->name('employee.personaldetails');
    //Edit Employee Personal
    Route::get('/edit/employee/personal', [InfoController::class,'EditEmployeePersonal'])->name('edit.employee.personal');
    Route::put('/update/employee/personal', [InfoController::class, 'UpdateEmployeePersonal'])->name('update.employee.personal');
    //Delete Personal
    Route::delete('/employee/personal/delete', [InfoController::class, 'DeleteEmployeePersonal'])->name('employee.personal.delete'); 
    //Personal search routes start
    Route::get('/search/employee/personal', [InfoController::class, 'SearchEmployeesPersonal'])->name('search.employee.personal.name');
    Route::get('/search/employee/personal/email', [InfoController::class, 'SearchEmployeePersonalByEmail'])->name('search.employee.personal.email');
    Route::get('/search/employee/personal/phone', [InfoController::class, 'SearchEmployeePersonalByPhone'])->name('search.employee.personal.phone');
    Route::get('/search/employee/personal/location', [InfoController::class, 'SearchEmployeePersonalByLocation'])->name('search.employee.personal.location');
    Route::get('/search/employee/personal/address', [InfoController::class,'SearchEmployeePersonalByAddress'])->name('search.employee.personal.address');
    Route::get('/search/employee/personal/nid', [InfoController::class,'SearchEmployeePersonalByNid'])->name('search.employee.personal.nid');
    Route::get('/search/employee/personal/dob', [InfoController::class,'SearchEmployeePersonalByDob'])->name('search.employee.personal.dob');
    Route::get('/search/employee/personal/department', [InfoController::class,'SearchEmployeePersonalByDepartment'])->name('search.employee.personal.department');
    Route::get('/search/employee/personal/designation', [InfoController::class,'SearchEmployeePersonalByDesignation'])->name('search.employee.personal.designation');
    //Personal pagination routes start
    Route::get('/personal/pagination', [InfoController::class,'EmployeePersonalPagination']);
    Route::get('/search/page/personal', [InfoController::class,'SearchEmployeesPersonal']);
    Route::get('/search/page/personal/email', [InfoController::class,'SearchEmployeePersonalByEmail']);
    Route::get('/search/page/personal/phone', [InfoController::class,'SearchEmployeePersonalByPhone']);
    Route::get('/search/page/personal/location', [InfoController::class,'SearchEmployeePersonalByLocation']);
    Route::get('/search/page/personal/address', [InfoController::class,'SearchEmployeePersonalByAddress']);
    Route::get('/search/page/personal/nid', [InfoController::class,'SearchEmployeePersonalByNid']);
    Route::get('/search/page/personal/dob', [InfoController::class,'SearchEmployeePersonalByDob']);
    Route::get('/search/page/personal/department', [InfoController::class,'SearchEmployeePersonalByDepartment']);
    Route::get('/search/page/personal/designation', [InfoController::class,'SearchEmployeePersonalByDesignation']);
    //search list routs
    Route::get('/get/employee/personal/by/name', [InfoController::class,'GetEmployeePersonalByName'])->name('get.employee.personalby.name');




    //Education Routes 
    Route::post('insert/education/info', [InfoController::class, 'InsertEducationDetails'])->name('inserteducation.info');
    Route::get('show/education/info', [InfoController::class, 'ShowEmployeesEducationInfo'])->name('show.educationinfo');
    Route::get('/new/employee/education', [InfoController::class, 'EmployeesEducationInfo'])->name('employee.educationdetails');
    Route::get('/employee/education', [InfoController::class, 'EmployeesEducation'])->name('employee.education');
    //Edit Employee Education
    Route::get('/edit/employee/education', [InfoController::class,'EditEmployeeEducation'])->name('edit.employee.education');
    Route::put('/update/employee/education', [InfoController::class, 'UpdateEmployeeEducation'])->name('update.employee.education');
    //Delete Education
    Route::delete('/employee/education/delete', [InfoController::class, 'DeleteEmployeeEducation'])->name('employee.education.delete');
    //Education search routes start
    Route::get('/search/employee/education', [InfoController::class, 'SearchEmployeesEducation'])->name('search.employee.education.name');
    Route::get('/search/employee/education/email', [InfoController::class, 'SearchEmployeeEducationByEmail'])->name('search.employee.education.email');
    Route::get('/search/employee/education/phone', [InfoController::class, 'SearchEmployeeEducationByPhone'])->name('search.employee.education.phone');
    Route::get('/search/employee/education/location', [InfoController::class, 'SearchEmployeeEducationByLocation'])->name('search.employee.education.location');
    Route::get('/search/employee/education/address', [InfoController::class,'SearchEmployeeEducationByAddress'])->name('search.employee.education.address');
    Route::get('/search/employee/education/nid', [InfoController::class,'SearchEmployeeEducationByNid'])->name('search.employee.education.nid');
    Route::get('/search/employee/education/dob', [InfoController::class,'SearchEmployeeEducationByDob'])->name('search.employee.education.dob');
    Route::get('/search/employee/education/department', [InfoController::class,'SearchEmployeeEducationByDepartment'])->name('search.employee.education.department');
    Route::get('/search/employee/education/designation', [InfoController::class,'SearchEmployeeEducationByDesignation'])->name('search.employee.education.designation');
    //Education pagination routes start
    Route::get('/education/pagination', [InfoController::class,'EmployeeEducationPagination']);
    Route::get('/search/page/education', [InfoController::class,'SearchEmployeesEducation']);
    Route::get('/search/page/education/email', [InfoController::class,'SearchEmployeeEducationByEmail']);
    Route::get('/search/page/education/phone', [InfoController::class,'SearchEmployeeEducationByPhone']);
    Route::get('/search/page/education/location', [InfoController::class,'SearchEmployeeEducationByLocation']);
    Route::get('/search/page/education/address', [InfoController::class,'SearchEmployeeEducationByAddress']);
    Route::get('/search/page/education/nid', [InfoController::class,'SearchEmployeeEducationByNid']);
    Route::get('/search/page/education/dob', [InfoController::class,'SearchEmployeeEducationByDob']);
    Route::get('/search/page/education/department', [InfoController::class,'SearchEmployeeEducationByDepartment']);
    Route::get('/search/page/education/designation', [InfoController::class,'SearchEmployeeEducationByDesignation']);
    //search list routs
    Route::get('/get/employee/education/by/name', [InfoController::class,'GetEmployeeEducationByName'])->name('get.employee.educationby.name');





    //Training Routes
    Route::post('insert/training/info', [InfoController::class, 'InsertTrainingDetails'])->name('inserttraining.info');
    Route::get('show/training/info', [InfoController::class, 'ShowEmployeesTrainingInfo'])->name('show.traininginfo');
    Route::get('/new/employee/training', [InfoController::class, 'EmployeesTrainingInfo'])->name('employee.trainingdetails');
    Route::get('/employee/training', [InfoController::class, 'EmployeesTraining'])->name('employee.training');
    //Edit Employee Training
    Route::get('/edit/employee/training', [InfoController::class,'EditEmployeeTraining'])->name('edit.employee.training');
    Route::put('/update/employee/training', [InfoController::class, 'UpdateEmployeeTraining'])->name('update.employee.training');
    //Delete Training
    Route::delete('/employee/training/delete', [InfoController::class, 'DeleteEmployeeTraining'])->name('employee.training.delete');
    //Training search routes start
    Route::get('/search/employee/training', [InfoController::class, 'SearchEmployeesTraining'])->name('search.employee.training.name');
    Route::get('/search/employee/training/email', [InfoController::class, 'SearchEmployeeTrainingByEmail'])->name('search.employee.training.email');
    Route::get('/search/employee/training/phone', [InfoController::class, 'SearchEmployeeTrainingByPhone'])->name('search.employee.training.phone');
    Route::get('/search/employee/training/location', [InfoController::class, 'SearchEmployeeTrainingByLocation'])->name('search.employee.training.location');
    Route::get('/search/employee/training/address', [InfoController::class,'SearchEmployeeTrainingByAddress'])->name('search.employee.training.address');
    Route::get('/search/employee/training/nid', [InfoController::class,'SearchEmployeeTrainingByNid'])->name('search.employee.training.nid');
    Route::get('/search/employee/training/dob', [InfoController::class,'SearchEmployeeTrainingByDob'])->name('search.employee.training.dob');
    Route::get('/search/employee/training/department', [InfoController::class,'SearchEmployeeTrainingByDepartment'])->name('search.employee.training.department');
    Route::get('/search/employee/training/designation', [InfoController::class,'SearchEmployeeTrainingByDesignation'])->name('search.employee.training.designation');
    //Training pagination routes start
    Route::get('/training/pagination', [InfoController::class,'EmployeeTrainingPagination']);
    Route::get('/search/page/training', [InfoController::class,'SearchEmployeesTraining']);
    Route::get('/search/page/training/email', [InfoController::class,'SearchEmployeeTrainingByEmail']);
    Route::get('/search/page/training/phone', [InfoController::class,'SearchEmployeeTrainingByPhone']);
    Route::get('/search/page/training/location', [InfoController::class,'SearchEmployeeTrainingByLocation']);
    Route::get('/search/page/training/address', [InfoController::class,'SearchEmployeeTrainingByAddress']);
    Route::get('/search/page/training/nid', [InfoController::class,'SearchEmployeeTrainingByNid']);
    Route::get('/search/page/training/dob', [InfoController::class,'SearchEmployeeTrainingByDob']);
    Route::get('/search/page/training/department', [InfoController::class,'SearchEmployeeTrainingByDepartment']);
    Route::get('/search/page/training/designation', [InfoController::class,'SearchEmployeeTrainingByDesignation']);
    //search list routs
    Route::get('/get/employee/training/by/name', [InfoController::class,'GetEmployeeTrainingByName'])->name('get.employee.trainingby.name');




    //Experience Routes
    Route::post('insert/experience/info', [InfoController::class, 'InsertExperienceDetails'])->name('insertexperience.info');
    Route::get('show/experience/info', [InfoController::class, 'ShowEmployeesExperienceInfo'])->name('show.experienceinfo');
    Route::get('/new/employee/experience', [InfoController::class, 'EmployeesExperienceInfo'])->name('employee.experiencedetails');
    Route::get('/employee/experience', [InfoController::class, 'EmployeesExperience'])->name('employee.experience');
    //Edit Employee Experience
    Route::get('/edit/employee/experience', [InfoController::class,'EditEmployeeExperience'])->name('edit.employee.experience');
    Route::put('/update/employee/experience', [InfoController::class, 'UpdateEmployeeExperience'])->name('update.employee.experience');
    //Delete Experience
    Route::delete('/employee/experience/delete', [InfoController::class, 'DeleteEmployeeExperience'])->name('employee.experience.delete');
    //Experience search routes start
    Route::get('/search/employee/experience', [InfoController::class, 'SearchEmployeesExperience'])->name('search.employee.experience.name');
    Route::get('/search/employee/experience/email', [InfoController::class, 'SearchEmployeeExperienceByEmail'])->name('search.employee.experience.email');
    Route::get('/search/employee/experience/phone', [InfoController::class, 'SearchEmployeeExperienceByPhone'])->name('search.employee.experience.phone');
    Route::get('/search/employee/experience/location', [InfoController::class, 'SearchEmployeeExperienceByLocation'])->name('search.employee.experience.location');
    Route::get('/search/employee/experience/address', [InfoController::class,'SearchEmployeeExperienceByAddress'])->name('search.employee.experience.address');
    Route::get('/search/employee/experience/nid', [InfoController::class,'SearchEmployeeExperienceByNid'])->name('search.employee.experience.nid');
    Route::get('/search/employee/experience/dob', [InfoController::class,'SearchEmployeeExperienceByDob'])->name('search.employee.experience.dob');
    Route::get('/search/employee/experience/department', [InfoController::class,'SearchEmployeeExperienceByDepartment'])->name('search.employee.experience.department');
    Route::get('/search/employee/experience/designation', [InfoController::class,'SearchEmployeeExperienceByDesignation'])->name('search.employee.experience.designation');
    //experience pagination routes start
    Route::get('/experience/pagination', [InfoController::class,'EmployeeExperiencePagination']);
    Route::get('/search/page/experience', [InfoController::class,'SearchEmployeesExperience']);
    Route::get('/search/page/experience/email', [InfoController::class,'SearchEmployeeExperienceByEmail']);
    Route::get('/search/page/experience/phone', [InfoController::class,'SearchEmployeeExperienceByPhone']);
    Route::get('/search/page/experience/location', [InfoController::class,'SearchEmployeeExperienceByLocation']);
    Route::get('/search/page/experience/address', [InfoController::class,'SearchEmployeeExperienceByAddress']);
    Route::get('/search/page/experience/nid', [InfoController::class,'SearchEmployeeExperienceByNid']);
    Route::get('/search/page/experience/dob', [InfoController::class,'SearchEmployeeExperienceByDob']);
    Route::get('/search/page/experience/department', [InfoController::class,'SearchEmployeeExperienceByDepartment']);
    Route::get('/search/page/experience/designation', [InfoController::class,'SearchEmployeeExperienceByDesignation']);
    //search list routs
    Route::get('/get/employee/experience/by/name', [InfoController::class,'GetEmployeeExperienceByName'])->name('get.employee.experienceby.name');



    //Organization Routes
    Route::post('insert/organization/info', [InfoController::class, 'InsertOrganizationDetails'])->name('insertorganization.info');
    Route::get('show/organization/info', [InfoController::class, 'ShowEmployeesOrganizationInfo'])->name('show.organizationinfo');
    Route::get('/new/employee/organization', [InfoController::class, 'EmployeesOrganizationInfo'])->name('employee.organizationdetails');
    Route::get('/employee/organization', [InfoController::class, 'EmployeesOrganization'])->name('employee.organization');
    //Edit Employee Organization
    Route::get('/edit/employee/organization', [InfoController::class,'EditEmployeeOrganization'])->name('edit.employee.organization');
    Route::put('/update/employee/organization', [InfoController::class, 'UpdateEmployeeOrganization'])->name('update.employee.organization');
    //Delete Organization
    Route::delete('/employee/organization/delete', [InfoController::class, 'DeleteEmployeeOrganization'])->name('employee.organization.delete');
    //Organization search routes start
    Route::get('/search/employee/organization', [InfoController::class, 'SearchEmployeesOrganization'])->name('search.employee.organization.name');
    Route::get('/search/employee/organization/email', [InfoController::class, 'SearchEmployeeOrganizationByEmail'])->name('search.employee.organization.email');
    Route::get('/search/employee/organization/phone', [InfoController::class, 'SearchEmployeeOrganizationByPhone'])->name('search.employee.organization.phone');
    Route::get('/search/employee/organization/location', [InfoController::class, 'SearchEmployeeOrganizationByLocation'])->name('search.employee.organization.location');
    Route::get('/search/employee/organization/address', [InfoController::class,'SearchEmployeeOrganizationByAddress'])->name('search.employee.organization.address');
    Route::get('/search/employee/organization/nid', [InfoController::class,'SearchEmployeeOrganizationByNid'])->name('search.employee.organization.nid');
    Route::get('/search/employee/organization/dob', [InfoController::class,'SearchEmployeeOrganizationByDob'])->name('search.employee.organization.dob');
    Route::get('/search/employee/organization/department', [InfoController::class,'SearchEmployeeOrganizationByDepartment'])->name('search.employee.organization.department');
    Route::get('/search/employee/organization/designation', [InfoController::class,'SearchEmployeeOrganizationByDesignation'])->name('search.employee.organization.designation');
    //Organization pagination routes start
    Route::get('/organization/pagination', [InfoController::class,'EmployeeOrganizationPagination']);
    Route::get('/search/page/organization', [InfoController::class,'SearchEmployeesOrganization']);
    Route::get('/search/page/organization/email', [InfoController::class,'SearchEmployeeOrganizationByEmail']);
    Route::get('/search/page/organization/phone', [InfoController::class,'SearchEmployeeOrganizationByPhone']);
    Route::get('/search/page/organization/location', [InfoController::class,'SearchEmployeeOrganizationByLocation']);
    Route::get('/search/page/organization/address', [InfoController::class,'SearchEmployeeOrganizationByAddress']);
    Route::get('/search/page/organization/nid', [InfoController::class,'SearchEmployeeOrganizationByNid']);
    Route::get('/search/page/organization/dob', [InfoController::class,'SearchEmployeeOrganizationByDob']);
    Route::get('/search/page/organization/department', [InfoController::class,'SearchEmployeeOrganizationByDepartment']);
    Route::get('/search/page/organization/designation', [InfoController::class,'SearchEmployeeOrganizationByDesignation']);
    //search list routs
    Route::get('/get/employee/organization/by/name', [InfoController::class,'GetEmployeeOrganizationByName'])->name('get.employee.organizationby.name');

    //////////////// ------------------ Manufacturer Routes ------------------- //////////////////

    Route::post('insert/manufacturer', [ManufacturerController::class, 'InsertManufacturer'])->name('insert.manufacturer');
    Route::get('show/manufacturer/list', [ManufacturerController::class, 'ShowManufacturerList'])->name('show.manufacturer.list');
    Route::get('/manufacturer/info', [ManufacturerController::class, 'ManufacturerInfo'])->name('manufacturer.info');
    //Edit Employee Manufacturer
    Route::get('/edit/manufacturer', [ManufacturerController::class,'EditManufacturer'])->name('edit.manufacturer');
    Route::put('/update/manufacturer', [ManufacturerController::class, 'UpdateManufacturer'])->name('update.manufacturer');
    //Delete Manufacturer
    Route::delete('/manufacturer/delete', [ManufacturerController::class, 'DeleteManufacturer'])->name('manufacturer.delete');
    //Manufacturer search routes start
    Route::get('/search/manufacturer', [ManufacturerController::class, 'SearchManufacturer'])->name('search.manufacturer.name');
    //Manufacturer pagination routes start
    Route::get('/manufacturer/pagination', [ManufacturerController::class,'ManufacturerPagination']);
    Route::get('/search/page/manufacturer', [ManufacturerController::class,'SearchManufacturer']);
    Route::get('/get/manufacturer/name', [ManufacturerController::class, 'GetManufacturerByName']);


    //////////////// ------------------ Category Routes ------------------- //////////////////

    Route::post('insert/category', [CategoryController::class, 'InsertCategory'])->name('insert.category');
    Route::get('show/category/list', [CategoryController::class, 'ShowCategoryList'])->name('show.category.list');
    Route::get('/category/info', [CategoryController::class, 'CategoryInfo'])->name('category.info');
    //Edit Employee Category
    Route::get('/edit/category', [CategoryController::class,'EditCategory'])->name('edit.category');
    Route::put('/update/category', [CategoryController::class, 'UpdateCategory'])->name('update.category');
    //Delete Category
    Route::delete('/category/delete', [CategoryController::class, 'DeleteCategory'])->name('category.delete');
    //Category search routes start
    Route::get('/search/category', [CategoryController::class, 'SearchCategory'])->name('search.category.name');
    //Category pagination routes start
    Route::get('/category/pagination', [CategoryController::class,'CategoryPagination']);
    Route::get('/search/page/category', [CategoryController::class,'SearchCategory']);
    Route::get('/get/category/name', [CategoryController::class, 'GetCategoryByName']);




    //////////////// ------------------ Form Routes ------------------- //////////////////

    Route::post('/insert/form', [InventoryController::class, 'InsertForm'])->name('insert.form');
    Route::get('/show/form/list', [InventoryController::class, 'ShowFormList'])->name('show.form.list');
    //Edit Form
    Route::get('/edit/form', [InventoryController::class,'EditForm'])->name('edit.form');
    Route::put('/update/form', [InventoryController::class, 'UpdateForm'])->name('update.form');
    //Delete Form
    Route::delete('/form/delete', [InventoryController::class, 'DeleteForm'])->name('form.delete');
    //Form search routes start
    Route::get('/search/form', [InventoryController::class, 'SearchForm'])->name('search.form.name');
    //Form pagination routes start
    Route::get('/form/pagination', [InventoryController::class,'FormPagination']);
    Route::get('/search/page/form', [InventoryController::class,'SearchForm']);
    Route::get('/get/form/name', [InventoryController::class, 'GetFormByName']);



    //////////////// ------------------ Unit Routes ------------------- //////////////////

    Route::post('/insert/unit', [InventoryController::class, 'InsertUnit'])->name('insert.unit');
    Route::get('/show/unit/list', [InventoryController::class, 'ShowUnitList'])->name('show.unit.list');
    //Edit Unit
    Route::get('/edit/unit', [InventoryController::class,'EditUnit'])->name('edit.unit');
    Route::put('/update/unit', [InventoryController::class, 'UpdateUnit'])->name('update.unit');
    //Delete Unit
    Route::delete('/unit/delete', [InventoryController::class, 'DeleteUnit'])->name('unit.delete');
    //Unit search routes start
    Route::get('/search/unit', [InventoryController::class, 'SearchUnit'])->name('search.unit.name');
    //Unit pagination routes start
    Route::get('/unit/pagination', [InventoryController::class,'UnitPagination']);
    Route::get('/search/page/unit', [InventoryController::class,'SearchUnit']);
    Route::get('/get/unit/name', [InventoryController::class, 'GetUnitByName']);


    
///////////////////////////// InventoryController Routes ////////////////////////////////
Route::controller(InventoryController::class)->group(function(){
    Route::prefix('/inventory')->group(function () {



        Route::post('/insert/transaction/main', 'InsertInventoryTransactionMain')->name('insert.inventory.transaction.main');
        //////////////// ------------------ Inventory Purchase Routes ------------------- //////////////////
        // Inventory Purchase Crude Routes
        Route::get('/purchase', 'ShowInventoryPurchase')->name('show.inventory.purchase');
        Route::post('/insert/purchase', 'InsertInventoryPurchase')->name('insert.inventory.purchase');
        Route::post('/insert/purchase/main', 'InsertInventoryPurchaseMain')->name('insert.inventory.purchase.main');
        Route::get('/edit/purchase', 'EditInventoryPurchase')->name('edit.inventory.purchase');
        Route::put('/update/purchase', 'UpdateInventoryPurchase')->name('update.inventory.purchase');
        Route::delete('/delete/purchase', 'DeleteInventoryPurchase')->name('delete.inventory.purchase');
        
        
        
        
        
        // Inventory Issue Crude Routes
        Route::get('/issue', 'ShowInventoryIssue')->name('show.inventory.issue');
        Route::post('/insert/issue', 'InsertInventoryIssue')->name('insert.inventory.issue');
        Route::post('/insert/issue/main', 'InsertInventoryIssueMain')->name('insert.inventory.issue.main');
        Route::get('/edit/issue', 'EditInventoryIssue')->name('edit.inventory.issue');
        Route::put('/update/issue', 'UpdateInventoryIssue')->name('update.inventory.issue');
        Route::delete('/delete/issue', 'DeleteInventoryIssue')->name('delete.inventory.issue');
        //Inventory Issue Search Routes
        Route::get('/issue/pagination', 'InventoryIssuePagination');
        Route::get('/issue/search/date', 'ShowInventoryIssueByDate');
        Route::get('/issue/search/tranid', 'SearchInventoryIssueByTranId');
        Route::get('/issue/search/user', 'SearchInventoryIssueByTranUser');
        // Inventory Issue Pagination Routes'
        Route::get('/issue/pagination/date', 'ShowInventoryIssueByDate');
        Route::get('/issue/pagination/tranid', 'SearchInventoryIssueByTranId');
        Route::get('/issue/pagination/user', 'SearchInventoryIssueByTranUser');

        
        
        
        
        // Inventory Return Crude Routes
        Route::get('/return', 'ShowInventoryReturn')->name('show.inventory.return');
        Route::post('/insert/return', 'InsertInventoryReturn')->name('insert.inventory.return');
        Route::post('/insert/return/main', 'InsertInventoryReturnMain')->name('insert.inventory.return.main');
        Route::get('/edit/return', 'EditInventoryReturn')->name('edit.inventory.return');
        Route::put('/update/return', 'UpdateInventoryReturn')->name('update.inventory.return');
        Route::delete('/delete/return', 'DeleteInventoryReturn')->name('delete.inventory.return');

    });

     //////////////// ------------------ Store Routes ------------------- //////////////////

     Route::post('insert/store', [InventoryController::class, 'InsertStore'])->name('insert.store');
     Route::get('show/store/list', [InventoryController::class, 'ShowStoreList'])->name('show.store.list');
     //Edit Store
     Route::get('/edit/store', [InventoryController::class,'EditStore'])->name('edit.store');
     Route::put('/update/store', [InventoryController::class, 'UpdateStore'])->name('update.store');
     //Delete Store
     Route::delete('/store/delete', [InventoryController::class, 'DeleteStore'])->name('store.delete');
     //Store search routes start
     Route::get('/search/store', [InventoryController::class, 'SearchStore'])->name('search.store.name');
     //Store pagination routes start
     Route::get('/store/pagination', [InventoryController::class,'StorePagination']);
     Route::get('/search/page/store', [InventoryController::class,'SearchStore']);
     Route::get('/get/store/name', [InventoryController::class, 'GetStoreByName']);

    ////////////////////////// --------------- Pharmacy Product routes ----------- ///////////////////////////
    //crud routes start
    Route::get('/pharmacyproduct', [InventoryController::class, 'ShowPharmacyProduct'])->name('show.pharmacy.product');
    Route::post('/insert/pharmacyproduct', [InventoryController::class, 'InsertPharmacyProduct'])->name('insert.pharmacy.product');
    Route::get('/edit/pharmacyproduct', [InventoryController::class, 'EditPharmacyProduct'])->name('edit.pharmacy.product');
    Route::put('/update/pharmacyproduct', [InventoryController::class, 'UpdatePharmacyProduct'])->name('update.pharmacy.product');
    Route::delete('/delete/pharmacyproduct', [InventoryController::class, 'DeletePharmacyProduct'])->name('delete.pharmacy.product');
   
    // //search routes start
    // Route::get('/search/heads', 'SearchTransactionHeads')->name('search.transaction.heads');
    // Route::get('/search/heads/groupe', 'SearchTransactionHeadsByGroupe')->name('search.transaction.heads.by.groupe');
    // //pagination routes start
    // Route::get('/heads/pagination', 'TransactionHeadPagination');
    // Route::get('/heads/search/pagination', 'SearchTransactionHeads');
    // Route::get('/heads/search/pagination/groupe', 'SearchTransactionHeadsByGroupe');
    // //search list routs
    Route::get('/get/products/groupe', 'GetProductByGroupe');
});
    
   