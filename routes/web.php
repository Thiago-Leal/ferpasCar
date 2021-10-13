<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustoController;
use App\Http\Controllers\ReceitaController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\TipoCustoController;
use App\Http\Controllers\TipoReceitaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;

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

Route::get ('/login', [LoginController::class, 'gate']);
Route::post ('/login', [LoginController::class, 'authenticate'])->name('login');
Route::post ('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post ('/register', [LoginController::class, 'register'])->name('register');

Route::group(['middleware' => 'auth'], function () {
	Route::get ('/',[RelatorioController::class, 'welcome'])->name('welcome');
	Route::get ('/home',[RelatorioController::class, 'welcome'])->name('welcome');
	Route::get ('/fluxo_caixa',[RelatorioController::class, 'fluxo_caixa'])->name('fluxo_caixa');

	Route::get ('/tipo_custo', [TipoCustoController::class, 'index'])->name('tipo_custo.index');
	Route::get ('/tipo_custo/create',[TipoCustoController::class, 'create'])->name('tipo_custo.create');
	Route::post('/tipo_custo', [TipoCustoController::class, 'store'])->name('tipo_custo.store');
	Route::get ('/tipo_custo/{tipo_custo}/edit', [TipoCustoController::class, 'edit'])->name('tipo_custo.edit');
	Route::patch ('/tipo_custo/{tipo_custo}',[TipoCustoController::class, 'update'])->name('tipo_custo.update');
	Route::delete('/tipo_custo/{tipo_custo}',[TipoCustoController::class, 'destroy'])->name('tipo_custo.destroy');
	Route::post('/tipo_custo/{tipo_custo}',[TipoCustoController::class, 'restroy'])->name('tipo_custo.restroy');

	Route::get ('/custo',[CustoController::class, 'index'])->name('custo.index');
	Route::get ('/custo/create', [CustoController::class, 'create'])->name('custo.create');
	Route::post('/custo',[CustoController::class, 'store'])->name('custo.store');
	Route::get ('/custo/{custo}/edit', [CustoController::class, 'edit'])->name('custo.edit');
	Route::patch ('/custo/{custo}',[CustoController::class, 'update'])->name('custo.update');
	Route::delete('/custo/{custo}',[CustoController::class, 'destroy'])->name('custo.destroy');
	Route::post('/custo/{custo}',[CustoController::class, 'restroy'])->name('custo.restroy');

	Route::get ('/tipo_receita', [TipoReceitaController::class, 'index'])->name('tipo_receita.index');
	Route::get ('/tipo_receita/create',[TipoReceitaController::class, 'create'])->name('tipo_receita.create');
	Route::post('/tipo_receita', [TipoReceitaController::class, 'store'])->name('tipo_receita.store');
	Route::get ('/tipo_receita/{tipo_receita}/edit', [TipoReceitaController::class, 'edit'])->name('tipo_receita.edit');
	Route::patch ('/tipo_receita/{tipo_receita}',[TipoReceitaController::class, 'update'])->name('tipo_receita.update');
	Route::delete('/tipo_receita/{tipo_receita}',[TipoReceitaController::class, 'destroy'])->name('tipo_receita.destroy');
	Route::post('/tipo_receita/{tipo_receita}',[TipoReceitaController::class, 'restroy'])->name('tipo_receita.restroy');

	Route::get ('/receita', [ReceitaController::class, 'index'])->name('receita.index');
	Route::get ('/receita/create',[ReceitaController::class, 'create'])->name('receita.create');
	Route::post('/receita', [ReceitaController::class, 'store'])->name('receita.store');
	Route::get ('/receita/{receita}/edit',[ReceitaController::class, 'edit'])->name('receita.edit');
	Route::patch ('/receita/{receita}', [ReceitaController::class, 'update'])->name('receita.update');
	Route::delete('/receita/{receita}', [ReceitaController::class, 'destroy'])->name('receita.destroy');
	Route::post('/receita/{receita}', [ReceitaController::class, 'restroy'])->name('receita.restroy');

	Route::get ('/user/edit',[UserController::class, 'edit'])->name('user.edit');
	Route::patch ('/user/{user}', [UserController::class, 'update'])->name('user.update');
});