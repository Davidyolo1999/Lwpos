<?php

use App\Http\Controllers\ExportController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\CategoriesController;
use App\Http\Livewire\ProductsController;
use App\Http\Livewire\PosController;
use App\Http\Livewire\RolesController;
use App\Http\Livewire\CoinsController;
use App\Http\Controllers\perfilcontroller;
use App\Http\Livewire\Permisoscontroller;
use App\Http\Livewire\Asignarcontroller;
use App\Http\Livewire\CashoutController;
use App\Http\Livewire\CompanyController;
use App\Http\Livewire\ReportsController;
use App\Http\Livewire\UsersController;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Exporter;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
    'confirm' => false,
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    //General Routes
    //Route::get('categories', CategoriesController::class)->middleware('role:Admin'); aplicamos este tipo de ruta solo para administradores del sistema aun cuando le asignemos el role no podra acceder ya que solo aplica a Admin
    Route::get('categories', CategoriesController::class);
    Route::get('products', ProductsController::class);
    Route::get('coins', CoinsController::class);
    Route::get('pos', PosController::class);
    
    Route::get('company', CompanyController::class)->middleware(('role:Admin'));

    Route::group(['middleware' => ['role:Admin']], function () {
        Route::get('roles', RolesController::class);
        Route::get('permisos', PermisosController::class);
        Route::get('asignar', AsignarController::class);
        Route::get('users', UsersController::class);
    });

    Route::get('cashout', CashoutController::class);
    Route::get('reports', ReportsController::class);
});

//Reports PDF
Route::get('report/pdf/{user}/{type}/{f1}/{f2}', [ExportController::class, 'reportPDF']);
Route::get('report/pdf/{user}/{type}', [ExportController::class, 'reportPDF']);

//Reports EXCEL
Route::get('report/excel/{user}/{type}/{f1}/{f2}', [ExportController::class, 'reporteExcel']);
Route::get('report/excel/{user}/{type}', [ExportController::class, 'reporteExcel']);

//User
Route::get('perfil', [Perfilcontroller::class, 'index'])->name('perfil.index');
Route::put('perfil/{user}',  [Perfilcontroller::class, 'actualizar_perfil'])->name('perfil.actualizar');

//Password
Route::get('password', [perfilcontroller::class, 'password'])->name('password.password');
Route::put('password/{user}/password',  [perfilcontroller::class, 'actualizar_password'])->name('password.contraseña');
