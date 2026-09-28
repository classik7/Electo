<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\ElectionController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\VoterController;
use App\Http\Controllers\AccreditationController;
use App\Http\Controllers\VotingController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\CandidateImportController;
use App\Http\Controllers\VoterImportController;

Route::get('/', function () {
    return view('electo.pages.home');
});


Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/dashboard',
        [DashboardController::class, 'index']
    )->name('dashboard');

	
	/*
|--------------------------------------------------------------------------
| BULK CANDIDATE IMPORT
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])
    ->prefix('admin/candidates/import')
    ->name('admin.candidates.import.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Import Page
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/',
            [CandidateImportController::class, 'create']
        )->name('create');


        /*
        |--------------------------------------------------------------------------
        | Download Template
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/template',
            [CandidateImportController::class, 'template']
        )->name('template');


        /*
        |--------------------------------------------------------------------------
        | Process Import
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/',
            [CandidateImportController::class, 'store']
        )->name('store');

    });
	
	/*
|--------------------------------------------------------------------------
| BULK VOTER IMPORT
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])
    ->prefix('admin/voters/import')
    ->name('admin.voters.import.')
    ->group(function () {

        Route::get(
            '/',
            [VoterImportController::class, 'create']
        )->name('create');

        Route::get(
            '/template',
            [VoterImportController::class, 'template']
        )->name('template');

        Route::post(
            '/',
            [VoterImportController::class, 'store']
        )->name('store');

    });
	
	
    /*
    |--------------------------------------------------------------------------
    | SECURITY PASSKEY
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/security/passkeys',
        function () {

            $user = auth()->user();

            $passkeys = \DB::table('passkeys')
                ->where('user_id', $user->id)
                ->latest()
                ->get();

            return view(
                'electo.security.passkeys',
                compact('passkeys')
            );
        }
    )->name('security.passkeys');


    /*
    |--------------------------------------------------------------------------
    | Accreditation
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/voters/{voter}/elections/{election}/accredit',
        [AccreditationController::class, 'show']
    )->name('accreditation.show');


    Route::post(
        '/voters/{voter}/elections/{election}/accredit/personal-device',
        [AccreditationController::class, 'personalDevice']
    )->name('accreditation.personal-device');


    Route::post(
        '/voters/{voter}/elections/{election}/accredit/public-device',
        [AccreditationController::class, 'publicDevice']
    )->name('accreditation.public-device');
	
	

    /*
    |--------------------------------------------------------------------------
    | Organization Trash
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/organizations/trash',
        [OrganizationController::class, 'trash']
    )->name('organizations.trash');


    Route::patch(
        '/organizations/{id}/restore',
        [OrganizationController::class, 'restore']
    )->name('organizations.restore');


    Route::delete(
        '/organizations/{id}/force-delete',
        [OrganizationController::class, 'forceDelete']
    )->name('organizations.force-delete');


    /*
    |--------------------------------------------------------------------------
    | Voting
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/voters/{voter}/elections/{election}/vote/start',
        [VotingController::class, 'start']
    )->name('voting.start');


    Route::get(
        '/voters/{voter}/elections/{election}/vote/{session}/ballot',
        [VotingController::class, 'ballot']
    )->name('voting.ballot');


    Route::post(
        '/voters/{voter}/elections/{election}/vote/{session}/review',
        [VotingController::class, 'review']
    )->name('voting.review');


    Route::post(
        '/voters/{voter}/elections/{election}/vote/{session}/submit',
        [VotingController::class, 'submit']
    )->name('voting.submit');


    Route::get(
        '/voters/{voter}/elections/{election}/vote/{session}/completed',
        [VotingController::class, 'completed']
    )->name('voting.completed');


   /*
|--------------------------------------------------------------------------
| MY VOTING
|--------------------------------------------------------------------------
|
| Election-selection page for the currently logged-in voter.
|
*/

Route::get(
    '/my-voting',
    [VotingController::class, 'index']
)->name('voting.my');

    /*
    |--------------------------------------------------------------------------
    | Results
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/elections/{election}/results',
        [ResultController::class, 'show']
    )->name('results.show');


    Route::get(
        '/results',
        [ResultController::class, 'index']
    )->name('results.index');


    /*
    |--------------------------------------------------------------------------
    | Certificates
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/elections/{election}/positions/{position}/candidates/{candidate}/certificate',
        [CertificateController::class, 'issue']
    )->name('certificates.issue');


    Route::get(
        '/certificates/{certificate}',
        [CertificateController::class, 'show']
    )->name('certificates.show');


    /*
    |--------------------------------------------------------------------------
    | Certificate Verification
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/certificates/verify/{verification_code}',
        [CertificateController::class, 'verify']
    )->name('certificates.verify');


    /*
    |--------------------------------------------------------------------------
    | Settings
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/settings',
        [SettingsController::class, 'index']
    )->name('settings.index');


    /*
    |--------------------------------------------------------------------------
    | General Settings
    |--------------------------------------------------------------------------
    */

    Route::put(
        '/settings',
        [SettingsController::class, 'update']
    )->name('settings.update');


    /*
    |--------------------------------------------------------------------------
    | Profile Information
    |--------------------------------------------------------------------------
    */

    Route::put(
        '/settings/profile',
        [SettingsController::class, 'updateProfile']
    )->name('settings.profile.update');


    /*
    |--------------------------------------------------------------------------
    | Profile Photo
    |--------------------------------------------------------------------------
    */

    Route::put(
        '/settings/profile/photo',
        [SettingsController::class, 'updateProfilePhoto']
    )->name('settings.profile.photo.update');


    /*
    |--------------------------------------------------------------------------
    | Password Security
    |--------------------------------------------------------------------------
    */

    Route::put(
        '/settings/security/password',
        [SettingsController::class, 'updatePassword']
    )->name('settings.security.password.update');

	/*
|--------------------------------------------------------------------------
| Two-Factor Authentication
|--------------------------------------------------------------------------
*/

Route::post(
    '/settings/security/2fa/enable',
    [SettingsController::class, 'enableTwoFactor']
)->name('settings.security.2fa.enable');


Route::post(
    '/settings/security/2fa/confirm',
    [SettingsController::class, 'confirmTwoFactor']
)->name('settings.security.2fa.confirm');


Route::post(
    '/settings/security/2fa/disable',
    [SettingsController::class, 'disableTwoFactor']
)->name('settings.security.2fa.disable');


Route::post(
    '/settings/security/2fa/recovery-codes',
    [SettingsController::class, 'regenerateRecoveryCodes']
)->name('settings.security.2fa.recovery-codes');


Route::post(
    '/notifications/{notification}/read',
    [NotificationController::class, 'markAsRead']
)->name('notifications.read');

Route::post(
    '/notifications/read-all',
    [NotificationController::class, 'markAllAsRead']
)->name('notifications.read.all');

    /*
    |--------------------------------------------------------------------------
    | Organizations
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'organizations',
        OrganizationController::class
    );


    /*
    |--------------------------------------------------------------------------
    | Candidates
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/candidates',
        [CandidateController::class, 'all']
    )->name('candidates.index');


    Route::get(
        '/elections/{election}/candidates',
        [CandidateController::class, 'index']
    )->name('elections.candidates');


    Route::get(
        '/candidates/create',
        [CandidateController::class, 'create']
    )->name('candidates.create');


    Route::post(
        '/candidates',
        [CandidateController::class, 'store']
    )->name('candidates.store');


    Route::get(
        '/candidates/{candidate}',
        [CandidateController::class, 'show']
    )->name('candidates.show');


    Route::get(
        '/candidates/{candidate}/edit',
        [CandidateController::class, 'edit']
    )->name('candidates.edit');


    Route::put(
        '/candidates/{candidate}',
        [CandidateController::class, 'update']
    )->name('candidates.update');


    Route::delete(
        '/candidates/{candidate}',
        [CandidateController::class, 'destroy']
    )->name('candidates.destroy');


    /*
    |--------------------------------------------------------------------------
    | Elections
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/electo-ui',
        function () {
            return view('electo.ui-test');
        }
    );


    /*
    |--------------------------------------------------------------------------
    | Voter Election Assignment
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/voters/{voter}/elections/create',
        [VoterController::class, 'createElectionAssignment']
    )->name('voters.elections.create');


    Route::post(
        '/voters/{voter}/elections',
        [VoterController::class, 'assignToElection']
    )->name('voters.elections.store');


    Route::delete(
        '/voters/{voter}/elections/{election}',
        [VoterController::class, 'removeFromElection']
    )->name('voters.elections.destroy');


    /*
    |--------------------------------------------------------------------------
    | Voters
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'voters',
        VoterController::class
    );


    /*
    |--------------------------------------------------------------------------
    | Election Creation Wizard
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/elections/create/details',
        [ElectionController::class, 'details']
    )->name('elections.details');


    Route::get(
        '/elections/create/schedule',
        [ElectionController::class, 'schedule']
    )->name('elections.schedule');


    Route::get(
        '/elections/create/positions',
        [ElectionController::class, 'positions']
    )->name('elections.positions');


    /*
    |--------------------------------------------------------------------------
    | Elections Resource
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'elections',
        ElectionController::class
    );

});


require __DIR__ . '/auth.php';