<?php

use App\Http\Controllers\Controller;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Dashboard\Clients;
use App\Http\Livewire\Dashboard\DetailFacture;
use App\Http\Livewire\Dashboard\Facture;
use App\Http\Livewire\Dashboard\Main;
use App\Http\Livewire\Dashboard\NewFacture;
use App\Http\Livewire\Dashboard\Products;
use App\Models\Invoice;
use Illuminate\Support\Facades\Route;
use Barryvdh\DomPDF\Facade\Pdf;

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

Route::any('/login', Login::class)->name('login');
Route::any('/logout', [Controller::class, 'logout']);


Route::middleware(['auth'])->group(function () {
    Route::any('/', Main::class);
    Route::any('/clients', Clients::class);
    Route::any('/products', Products::class);
    Route::any('/factures', Facture::class);
    Route::any('/new-factures', NewFacture::class);
    Route::any('/facture/detail/{id}', DetailFacture::class);
    Route::any('/print/{id}', function ($id) {

        $invoice = Invoice::find($id);
        view()->share('invoice', $invoice);
        $pdf = PDF::loadView('livewire.dashboard.facture-pdf', $invoice->toArray());
        return $pdf->download('invoice.pdf');
    });
});
