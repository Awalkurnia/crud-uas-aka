<?Php

use App\Http\Controllers\MahasiswaController;
use illuminate\Support\Facades\Route;

Route::apiResource('/mahasiswa', MahasiswaController::class);

?>