<?php

use App\Http\Controllers\SubmissionController;
use Illuminate\Support\Facades\Route;

Route::prefix('submission')->name('submission.')->controller(SubmissionController::class)->group(function () {
    Route::post('submit', [SubmissionController::class, 'submissionSubmitAction'])->name('submit');
});
