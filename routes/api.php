<?php


use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\DemandController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\LineController;
use App\Http\Controllers\MigrationController;
use App\Http\Controllers\OptionsContractsController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ReclamationController;
use App\Http\Controllers\SatisfactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\SuggController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::get('/products/search/{name}', [ProductController::class, 'search']);
Route::post('/add', [ClientController::class, 'add']);

Route::post('/products', [ProductController::class, 'store']);
Route::put('/products/{id}', [ProductController::class, 'update']);
oute::delete('/products/{id}', [ProductController::class, 'destroy']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::resource('products', ProductController::class);
*/

// Public routes

Route::post('/addf/{id}', [FactureController::class, 'add']);
Route::post('/addfauto/{id}', [FactureController::class, 'addauto']);
Route::get('/sanctum/csrf-cookie', [ClientController::class, 'getCSRFCookie']);

Route::post('/log', [ClientController::class, 'login']);
Route::post('/addc', [ContractController::class, 'add']);

Route::get('/produit', [ProduitController::class, 'look']);
Route::get('/produit/{clientId}', [ProduitController::class, 'add']);
    
    Route::post('/forgot-password', [ClientController::class, 'forgotpassword']);
  
    Route::post('/reset-forgottenpassword', [ClientController::class, 'resetforgottenpassword']);
    Route::post('/add', [ClientController::class, 'add']);
// Protected Routes
    Route::group(['middleware' => ['auth:sanctum']], function () {  
    //Client
    
    Route::get('/contract/{clientId}', [ContractController::class, 'monc']);
    Route::get('/option', [OptionsContractsController::class, 'look']);
    Route::put('/contrat/{id}', [OptionsContractsController::class, 'buy_option']);
    Route::post('/options', [OptionsContractsController::class, 'add']);
    
    
    
    Route::post('/logout', [ClientController::class, 'logout']);
    Route::post('/update_profile/{id}', [ClientController::class, 'update']);
    Route::get('/currentuser', [ClientController::class, 'getCurrentUser']);
    
    //Facture
    Route::post('/create-payment-intent', [StripePaymentController::class, 'createPaymentIntent']);
    Route::get('/factures/{clientId}', [FactureController::class, 'monf']);
    Route::put('/factures/{id}', [FactureController::class, 'updateResteAPayer']);

    //Demand
    Route::post('/Submitdemand/{id}', [DemandController::class, 'add']);
    Route::get('/Demands/{clientId}', [DemandController::class, 'history']);
    
    //Complain-reclamation
    Route::get('/Reclamations_history/{clientId}', [ReclamationController::class, 'history']);
    Route::post('/Submitreclamation/{id}', [ReclamationController::class, 'add']);
    //Migration
    Route::post('/Submitmigration/{id}', [MigrationController::class, 'add']);
    Route::get('/Migrations_history/{clientId}', [MigrationController::class, 'history']);
    //Line
    Route::post('/Submitline/{id}', [LineController::class, 'add']);
    Route::get('/LineHistory/{clientId}', [LineController::class, 'history']);
    //Sugg
    Route::post('/Submitsuggestion/{id}', [SuggController::class, 'add']);
    Route::get('/SuggestionsHistory/{clientId}', [SuggController::class, 'history']);
    //SS
    Route::post('/SubmitSS/{id}', [SatisfactionController::class, 'add']);
    Route::get('/contract/{clientId}', [ContractController::class, 'monc']);
    //mail
    Route::get('/maillist/{clientId}', [EmailController::class, 'maillist']);
    Route::post('/addmail/{id}', [EmailController::class, 'add']);

    
});



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});