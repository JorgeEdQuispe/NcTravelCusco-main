<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BuscadoreController;
use App\Http\Controllers\DjmblogController;
use App\Http\Controllers\EnlacesCategorias;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImagenesController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\UserControler;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Oferta
Route::get('viagem-ao-Peru-e-Machu-Picchu', [EnlacesCategorias::class, 'landing'])->name('landing');
Route::post('/enviar-formulario', [MailController::class, 'enviarFormulario'])->name('enviar.formulario');

// Mensajes
Route::post('mensajeNc', [MailController::class, 'getMail'])->name('mensaje');

// Páginas de inicio
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/nikonctravel', [HomeController::class, 'index'])->name('home');

//Reportes
Route::resource('reportes', ReporteController::class)->middleware('auth')->names('reportes');
Route::get('reporte/{id}/pdf', [ReporteController::class, 'downloadPdf'])->name('reporte.pdf');
Route::get('reporte/{id}', [ReporteController::class, 'show'])->name('reporte');
Route::get('grid-data', [ReporteController::class, 'gridData'])->name('grid-data');
Route::post('enviar-correo/{id}', [ReporteController::class, 'enviarCorreo'])->name('enviar.correo');

// Usuarios
Route::resource('users', UserControler::class)->middleware('auth');
Route::post('upload_image', [ArticleController::class, 'uploadImage'])->name('upload');
Auth::routes();

// Crud de imagenes
Route::resource('imagenes', ImagenesController::class)->middleware('auth');
Route::resource('categoriasDjm', BuscadoreController::class)->names('cat');
Route::resource('blogsDjm', DjmblogController::class)->names('djm');
