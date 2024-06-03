<?php

use App\Http\Controllers\AuditLogController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Blade\UserController;
use App\Http\Controllers\Blade\RoleController;
use App\Http\Controllers\Blade\PermissionController;
use App\Http\Controllers\Blade\HomeController;
use App\Http\Controllers\Blade\ApiUserController;
use App\Http\Controllers\Blade\RegionController;
use App\Http\Controllers\Blade\DistrictController;
use App\Http\Controllers\Blade\ProductController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FileController;

/*
|--------------------------------------------------------------------------
| Blade (front-end) Routes
|--------------------------------------------------------------------------
|
| Here is we write all routes which are related to web pages
| like UserManagement interfaces, Diagrams and others
|
*/

// Default laravel auth routes
Auth::routes(['register' => false]);

// Welcome page
Route::get('/', function () {
    return view('welcome');
});

// Web pages
Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/optimize-cache', [HomeController::class,'optimize'])->name('optimize.command');

    // Regions  
    // Route::prefix('regions')->name('region.')->group(function () {

    // });
    Route::get('/regions', [RegionController::class, 'index'])->name('regionIndex');
    Route::get('/region/add', [RegionController::class, 'add'])->name('regionAdd');
    Route::post('/region/create', [RegionController::class, 'create'])->name('regionCreate');
    Route::get('/region/edit/{id}', [RegionController::class, 'edit'])->name('regionEdit');
    Route::post('/region/update/{id}', [RegionController::class, 'update'])->name('regionUpdate');
    Route::delete('/region/delete/{id}', [RegionController::class, 'destroy'])->name('regionDestroy');

    // Districts 
    Route::get('/districts', [DistrictController::class, 'index'])->name('districtIndex');
    Route::get('/district/add', [DistrictController::class, 'add'])->name('districtAdd');
    Route::post('/district/create', [DistrictController::class, 'create'])->name('districtCreate');
    Route::get('/district/edit/{id}', [DistrictController::class, 'edit'])->name('districtEdit');
    Route::post('/district/update/{id}', [DistrictController::class, 'update'])->name('districtUpdate');
    Route::delete('/district/delete/{id}', [DistrictController::class, 'destroy'])->name('districtDestroy');

    // Products
    Route::get('/products', [ProductController::class, 'index'])->name('productIndex');

    Route::get('/products/data', [ProductController::class, 'getClientsData'])->name('clients.data');

    Route::get('/product/add', [ProductController::class, 'add'])->name('productAdd');
    Route::get('/product/{id}', [ProductController::class, 'show'])->name('productShow');
    Route::post('/product/create', [ProductController::class, 'create'])->name('productCreate');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('productEdit');
    Route::delete('/product/delete/{id}', [ProductController::class, 'delete'])->name('productDestroy');
    Route::match(['put', 'post'], '/product/update/{id}', [ProductController::class, 'update'])->name('productUpdate');
    Route::post('/product/toggle-status/{id}', [ProductController::class, 'toggleProductActivation'])->name('productActivation');

    // Audit-Log
    Route::get('audit-logs', [AuditLogController::class, 'index'])->name('audit-logs.index');

    // File
    Route::get('/doc/{id}', [FileController::class, 'show'])->name('word');
    Route::get('/downloading-exel/{id}', [FileController::class, 'downloadTableData'])->name('download.table.data');
    Route::get('/downloading-exel', [FileController::class, 'downloadExcel'])->name('download.excel');

    // Users
    Route::get('/users', [UserController::class, 'index'])->name('userIndex');
    Route::get('/user/add', [UserController::class, 'add'])->name('userAdd');
    Route::post('/user/create', [UserController::class, 'create'])->name('userCreate');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('userEdit');
    Route::post('/user/update/{id}', [UserController::class, 'update'])->name('userUpdate');
    Route::delete('/user/delete/{id}', [UserController::class, 'destroy'])->name('userDestroy');
    Route::get('/user/theme-set/{id}', [UserController::class, 'setTheme'])->name('userSetTheme');

    // Client
    Route::get('/clients', [ClientController::class, 'index'])->name('clientIndex');
    Route::get('/client/add', [ClientController::class, 'add'])->name('clientAdd');
    Route::post('/client/create', [ClientController::class, 'create'])->name('clientCreate');
    Route::get('/client/{id}/edit', [ClientController::class, 'edit'])->name('clientEdit');
    Route::post('/client/update/{id}', [ClientController::class, 'update'])->name('clientUpdate');
    Route::delete('/client/delete/{id}', [ClientController::class, 'destroy'])->name('clientDestroy');


    // Permissions
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissionIndex');
    Route::get('/permission/add', [PermissionController::class, 'add'])->name('permissionAdd');
    Route::post('/permission/create', [PermissionController::class, 'create'])->name('permissionCreate');
    Route::get('/permission/{id}/edit', [PermissionController::class, 'edit'])->name('permissionEdit');
    Route::post('/permission/update/{id}', [PermissionController::class, 'update'])->name('permissionUpdate');
    Route::delete('/permission/delete/{id}', [PermissionController::class, 'destroy'])->name('permissionDestroy');

    // Roles
    Route::get('/roles', [RoleController::class, 'index'])->name('roleIndex');
    Route::get('/role/add', [RoleController::class, 'add'])->name('roleAdd');
    Route::post('/role/create', [RoleController::class, 'create'])->name('roleCreate');
    Route::get('/role/{role_id}/edit', [RoleController::class, 'edit'])->name('roleEdit');
    Route::post('/role/update/{role_id}', [RoleController::class, 'update'])->name('roleUpdate');
    Route::delete('/role/delete/{id}', [RoleController::class, 'destroy'])->name('roleDestroy');

    // ApiUsers
    Route::get('/api-users', [ApiUserController::class, 'index'])->name('api-userIndex');
    Route::get('/api-user/add', [ApiUserController::class, 'add'])->name('api-userAdd');
    Route::post('/api-user/create', [ApiUserController::class, 'create'])->name('api-userCreate');
    Route::get('/api-user/show/{id}', [ApiUserController::class, 'show'])->name('api-userShow');
    Route::get('/api-user/{id}/edit', [ApiUserController::class, 'edit'])->name('api-userEdit');
    Route::post('/api-user/update/{id}', [ApiUserController::class, 'update'])->name('api-userUpdate');
    Route::delete('/api-user/delete/{id}', [ApiUserController::class, 'destroy'])->name('api-userDestroy');
    Route::delete('/api-user-token/delete/{id}', [ApiUserController::class, 'destroyToken'])->name('api-tokenDestroy');

    // Exel

});

// Change language session condition
Route::get('/language/{lang}', function ($lang) {
    $lang = strtolower($lang);
    if ($lang == 'ru' || $lang == 'uz') {
        session([
            'locale' => $lang
        ]);
    }
    return redirect()->back();
})->name('changelang');

/*
|--------------------------------------------------------------------------
| This is the end of Blade (front-end) Routes
|-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\
*/
