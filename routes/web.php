<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\EmployeeController;

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


Route::get('admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');

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