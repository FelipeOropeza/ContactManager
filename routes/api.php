<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ContatoController;

Route::apiResource('/contatos', ContatoController::class);
