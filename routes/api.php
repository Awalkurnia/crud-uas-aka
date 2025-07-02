<?php

use App\Http\Controllers\JadwalLiveStreamingController;
use illuminate\Support\Facades\Route;

Route::apiResource('/jadwal-live-streaming', JadwalLiveStreamingController::class);

?>