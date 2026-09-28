<?php

use App\Http\Controllers\Api\AdminElectionController;
use App\Http\Controllers\Api\AdminElectionTypeController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ElectionController;
use App\Http\Controllers\Api\VotingController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\VotingHistoryController;
use App\Http\Controllers\Api\ResultController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Electo Mobile API
|--------------------------------------------------------------------------
*/

Route::prefix('v1')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Authentication
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/login',
        [AuthController::class, 'login']
    );


    /*
    |--------------------------------------------------------------------------
    | Protected Mobile API
    |--------------------------------------------------------------------------
    */

    Route::middleware('auth:sanctum')->group(function () {
		
		/*
|--------------------------------------------------------------------------
| Mobile Notifications
|--------------------------------------------------------------------------
*/

Route::get(
    '/notifications',
    [NotificationController::class, 'index']
);

Route::get(
    '/notifications/unread-count',
    [NotificationController::class, 'unreadCount']
);

Route::post(
    '/notifications/{notification}/read',
    [NotificationController::class, 'markAsRead']
);

Route::post(
    '/notifications/read-all',
    [NotificationController::class, 'markAllAsRead']
);

/*
|--------------------------------------------------------------------------
| Voting History
|--------------------------------------------------------------------------
*/

Route::get(
    '/voting-history',
    [VotingHistoryController::class, 'index']
);


        /*
        |--------------------------------------------------------------------------
        | Current User
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/me',
            [AuthController::class, 'me']
        );


        /*
        |--------------------------------------------------------------------------
        | Logout
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/logout',
            [AuthController::class, 'logout']
        );


        /*
        |--------------------------------------------------------------------------
        | Organizations
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/organizations',
            [\App\Http\Controllers\Api\OrganizationController::class, 'index']
        );

        Route::get(
            '/organizations/{organization}',
            [\App\Http\Controllers\Api\OrganizationController::class, 'show']
        );

        Route::post(
            '/organizations',
            [\App\Http\Controllers\Api\OrganizationController::class, 'store']
        );

        Route::put(
            '/organizations/{organization}',
            [\App\Http\Controllers\Api\OrganizationController::class, 'update']
        );

        Route::delete(
            '/organizations/{organization}',
            [\App\Http\Controllers\Api\OrganizationController::class, 'destroy']
        );


        /*
        |--------------------------------------------------------------------------
        | Admin - Election Management
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/admin/election-types',
            [AdminElectionTypeController::class, 'index']
        );

        Route::post(
            '/admin/elections',
            [AdminElectionController::class, 'store']
        );


        /*
        |--------------------------------------------------------------------------
        | Elections
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/elections',
            [ElectionController::class, 'index']
        );

        Route::get(
            '/elections/{election}/details',
            [ElectionController::class, 'show']
        );

	Route::get(
    	'/elections/{election}/results',
    	[ResultController::class, 'show']
	);

        /*
        |--------------------------------------------------------------------------
        | Voting
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/elections/{election}/start',
            [VotingController::class, 'start']
        );

        Route::post(
            '/elections/{election}/sessions/{session}/review',
            [VotingController::class, 'review']
        );

        Route::post(
            '/elections/{election}/sessions/{session}/submit',
            [VotingController::class, 'submit']
        );

    });

});