<?php

use App\Http\Controllers\BackupController;
use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Blade\UserController;
use App\Http\Controllers\Blade\RoleController;
use App\Http\Controllers\Blade\PermissionController;
use App\Http\Controllers\Blade\HomeController;
use App\Http\Controllers\Blade\ApiUserController;
use App\Http\Controllers\Blade\RegionController;
use App\Http\Controllers\Blade\DistrictController;
use App\Http\Controllers\Blade\ClientController;
use App\Http\Controllers\ConstructionController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\TransactionController;

// Default laravel auth routes
Auth::routes(['register' => false]);

// Welcome page
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
// Web pages
Route::group(['middleware' => ['auth', 'checkUserRole']], function () {

    Route::get('/optimize-cache', [HomeController::class,'optimize'])->name('optimize.command');

    // Regions  
    Route::prefix('regions')->group(function () {
        Route::get('/', [RegionController::class, 'index'])->name('regionIndex');
        Route::get('/add', [RegionController::class, 'add'])->name('regionAdd');
        Route::post('/create', [RegionController::class, 'create'])->name('regionCreate');
        Route::get('/edit/{id}', [RegionController::class, 'edit'])->name('regionEdit');
        Route::post('/update/{id}', [RegionController::class, 'update'])->name('regionUpdate');
        Route::delete('/delete/{id}', [RegionController::class, 'destroy'])->name('regionDestroy');
    });
    // Districts 
    Route::prefix('districts')->group(function () {
        Route::get('/', [DistrictController::class, 'index'])->name('districtIndex');
        Route::get('/add', [DistrictController::class, 'add'])->name('districtAdd');
        Route::post('/create', [DistrictController::class, 'create'])->name('districtCreate');
        Route::get('/edit/{id}', [DistrictController::class, 'edit'])->name('districtEdit');
        Route::post('/update/{id}', [DistrictController::class, 'update'])->name('districtUpdate');
        Route::delete('/delete/{id}', [DistrictController::class, 'destroy'])->name('districtDestroy');
    });
    // Products
    Route::prefix('clients')->group(function () {
        Route::get('/', [ClientController::class, 'index'])->name('clientIndex');
        
        Route::get('/data', [ClientController::class, 'getClientsData'])->name('clients.data');
        Route::get('/add', [ClientController::class, 'add'])->name('clientAdd');
        Route::get('/{id}', [ClientController::class, 'show'])->name('clientDetails');
        Route::post('/create', [ClientController::class, 'create'])->name('clientCreate');
        Route::get('/edit/{id}', [ClientController::class, 'edit'])->name('clientEdit');
        Route::delete('/delete/{id}', [ClientController::class, 'delete'])->name('clientDestroy');
        Route::match(['put', 'post'], 'product/{id}', [ClientController::class, 'update'])->name('clientUpdate');
        Route::post('/toggle-status/{id}', [ClientController::class, 'toggleclientActivation'])->name('clientActivation');
    });
    Route::get('/apz-second', [ClientController::class, 'apz_second'])->name('apz.second');

    // Permissions
    Route::prefix('permissions')->group(function () {
        Route::get('/', [PermissionController::class, 'index'])->name('permissionIndex');
        Route::get('/add', [PermissionController::class, 'add'])->name('permissionAdd');
        Route::post('/create', [PermissionController::class, 'create'])->name('permissionCreate');
        Route::get('/{id}/edit', [PermissionController::class, 'edit'])->name('permissionEdit');
        Route::post('/update/{id}', [PermissionController::class, 'update'])->name('permissionUpdate');
        Route::delete('/delete/{id}', [PermissionController::class, 'destroy'])->name('permissionDestroy');
    });
    // Roles
    Route::prefix('roles')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('roleIndex');
        Route::get('/add', [RoleController::class, 'add'])->name('roleAdd');
        Route::post('/create', [RoleController::class, 'create'])->name('roleCreate');
        Route::get('/{role_id}/edit', [RoleController::class, 'edit'])->name('roleEdit');
        Route::post('/update/{role_id}', [RoleController::class, 'update'])->name('roleUpdate');
        Route::delete('/delete/{id}', [RoleController::class, 'destroy'])->name('roleDestroy');
    });
    // ApiUsers
    Route::prefix('api-users')->group(function () {
        Route::get('/', [ApiUserController::class, 'index'])->name('api-userIndex');
        Route::get('/add', [ApiUserController::class, 'add'])->name('api-userAdd');
        Route::post('/create', [ApiUserController::class, 'create'])->name('api-userCreate');
        Route::get('/show/{id}', [ApiUserController::class, 'show'])->name('api-userShow');
        Route::get('/{id}/edit', [ApiUserController::class, 'edit'])->name('api-userEdit');
        Route::post('/update/{id}', [ApiUserController::class, 'update'])->name('api-userUpdate');
        Route::delete('/delete/{id}', [ApiUserController::class, 'destroy'])->name('api-userDestroy');
        Route::delete('-token/delete/{id}', [ApiUserController::class, 'destroyToken'])->name('api-tokenDestroy');
    });
    // import
    Route::prefix('import')->group(function () {
        Route::get('/', [ImportController::class, 'index'])->name('import');
        Route::post('/', [ImportController::class, 'import'])->name('import.xls');
        Route::post('_debat', [ImportController::class, 'import_debat'])->name('import_debat.xls');
        Route::post('_credit', [ImportController::class, 'import_credit'])->name('import_credit.xls');
    });
    // Transactions
    Route::prefix('transactions')->group(function () {
        Route::get('/all', [TransactionController::class,'index'])->name('transactions.index');
        Route::get('/art', [TransactionController::class,'art'])->name('transactions.art');
        Route::get('/ads', [TransactionController::class,'ads'])->name('transactions.ads');
        Route::get('/payers', [TransactionController::class,'payers'])->name('transactions.payers');
        Route::get('/{id}', [TransactionController::class,'show'])->name('transactions.show');
    });
    // Backup
    Route::prefix('backups')->group(function () {
        Route::get('/', [BackupController::class, 'index'])->name('backup.index');
        Route::get('/{id}', [BackupController::class, 'show'])->name('backup.show');
        Route::any('/download/{filename}', [BackupController::class, 'download'])->name('backup.download');
        Route::delete('/{filename}', [BackupController::class, 'delete'])->name('backup.delete');
        Route::any('/backup-delete', [BackupController::class, 'deleteAll'])->name('backup.deleteAll');
    });
    // File
    Route::prefix('files')->group(function () {
        Route::get('/doc/{id}', [FileController::class, 'show'])->name('word');
        Route::get('/test/{id}', [FileController::class, 'test'])->name('test.word');
        Route::get('/downloading-excel/{id}', [FileController::class, 'downloadTableData'])->name('download.table.data');
        Route::get('/select-columns', [FileController::class, 'showColumnSelectionForm'])->name('select.columns');
        Route::get('/download-excel', [FileController::class, 'downloadExcel'])->name('download.excel');
    });
    
    // History
    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
    Route::get('/request-confirm', [HistoryController::class, 'confirm'])->name('request.confirm');
    Route::get('/history/{id}', [HistoryController::class, 'showHistory'])->name('history.show');



    Route::get('/import/backup', [BackupController::class, 'import'])->name('backup.import');
});

Route::group(['middleware' => ['auth']], function () {
   // Users
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('userIndex');
        Route::get('/add', [UserController::class, 'add'])->name('userAdd');
        Route::post('/create', [UserController::class, 'create'])->name('userCreate');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('userEdit');
        Route::post('/update/{id}', [UserController::class, 'update'])->name('userUpdate');
        Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('userDestroy');
        Route::get('/theme-set/{id}', [UserController::class, 'setTheme'])->name('userSetTheme');
    });
    // Constructions
    Route::prefix('constructions')->group(function () {
        Route::get('/', [ConstructionController::class,'index'])->name('construction.index');
        Route::get('/{id}', [ConstructionController::class,'show'])->name('construction.show');
        Route::get('/{id}/edit', [ConstructionController::class,'edit'])->name('construction.edit');
        Route::any('/update/{id}', [ConstructionController::class, 'update'])->name('construction.update');
        Route::post('/update-status', [ConstructionController::class, 'updateStatus'])->name('updateStatus');
    });
    
    // Chat
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat', [ChatController::class, 'store'])->name('chat.store');
    Route::put('/chat/{id}', [ChatController::class, 'update'])->name('chat.update');
    Route::delete('/chat/{id}', [ChatController::class, 'destroy'])->name('chat.destroy');




});

Route::get('/language/{lang}', function ($lang) {
    $lang = strtolower($lang);
    if ($lang == 'ru' || $lang == 'uz') {
        session([
            'locale' => $lang
        ]);
    }
    return redirect()->back();
})->name('changelang');
