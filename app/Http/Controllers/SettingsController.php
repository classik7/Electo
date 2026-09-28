<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use PragmaRX\Google2FA\Google2FA;
use App\Services\NotificationService;

class SettingsController extends Controller
{
    /**
     * Display settings page.
     */
   /**
 * Display settings page.
 */
public function index()
{
    $user = auth()->user();

    /*
    |--------------------------------------------------------------------------
    | User Settings
    |--------------------------------------------------------------------------
    */

    $settings = $user->settings()->firstOrCreate(
        [],
        [
            'theme' => 'dark',

            'email_notifications' => true,
            'election_notifications' => true,
            'result_notifications' => true,
            'certificate_notifications' => true,
            'security_notifications' => true,

            'election_reminders' => true,
            'election_registration_updates' => true,
            'voting_confirmation' => true,
            'election_closing_reminders' => true,
			'certificate_issued_notifications' => true,
			'certificate_status_updates' => true,
			'certificate_verification_updates' => true,
			'certificate_availability_updates' => true,
        ]
    );


    /*
    |--------------------------------------------------------------------------
    | Two-Factor Authentication
    |--------------------------------------------------------------------------
    */

    $twoFactor = $user->twoFactorAuthentication;


    /*
    |--------------------------------------------------------------------------
    | Pending 2FA Setup
    |--------------------------------------------------------------------------
    */

    $twoFactorSetup = false;
    $twoFactorSecret = null;
    $twoFactorQrUrl = null;

    if (
        $twoFactor &&
        !$twoFactor->enabled &&
        !$twoFactor->confirmed_at &&
        $twoFactor->secret
    ) {

        try {

            $twoFactorSecret = Crypt::decryptString(
                $twoFactor->secret
            );

            $google2fa = app(Google2FA::class);

            $twoFactorQrUrl = $google2fa->getQRCodeUrl(
                config('app.name', 'Electo'),
                $user->email,
                $twoFactorSecret
            );

            $twoFactorSetup = true;

        } catch (\Throwable $e) {

            report($e);

            $twoFactorSetup = false;
            $twoFactorSecret = null;
            $twoFactorQrUrl = null;
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Registered Passkeys / Devices
    |--------------------------------------------------------------------------
    |
    | Only load passkeys if the User model actually provides
    | the passkeys() relationship.
    |
    */

    $passkeys = collect();

    if (method_exists($user, 'passkeys')) {

        $passkeys = $user->passkeys()
            ->latest()
            ->get();
    }


    /*
    |--------------------------------------------------------------------------
    | Return Settings Page
    |--------------------------------------------------------------------------
    */

    return view(
        'electo.settings.index',
        compact(
            'user',
            'settings',
            'twoFactor',
            'passkeys',
            'twoFactorSetup',
            'twoFactorSecret',
            'twoFactorQrUrl'
        )
    );
}


    /**
     * Update appearance, notifications and election preferences.
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([

            /*
            |--------------------------------------------------------------------------
            | Appearance
            |--------------------------------------------------------------------------
            */

            'theme' => [
                'required',
                'in:light,dark,system',
            ],


            /*
            |--------------------------------------------------------------------------
            | Notification Preferences
            |--------------------------------------------------------------------------
            */

            'email_notifications' => [
                'nullable',
                'boolean',
            ],

            'election_notifications' => [
                'nullable',
                'boolean',
            ],

            'result_notifications' => [
                'nullable',
                'boolean',
            ],

            'certificate_notifications' => [
                'nullable',
                'boolean',
            ],

            'security_notifications' => [
                'nullable',
                'boolean',
            ],


            /*
            |--------------------------------------------------------------------------
            | Election Preferences
            |--------------------------------------------------------------------------
            */

            'election_reminders' => [
                'nullable',
                'boolean',
            ],

            'election_registration_updates' => [
                'nullable',
                'boolean',
            ],

            'voting_confirmation' => [
                'nullable',
                'boolean',
            ],

            'election_closing_reminders' => [
                'nullable',
                'boolean',
            ],
			
			/*
|--------------------------------------------------------------------------
| Certificate Preferences
|--------------------------------------------------------------------------
*/

'certificate_issued_notifications' => [
    'nullable',
    'boolean',
],

'certificate_status_updates' => [
    'nullable',
    'boolean',
],

'certificate_verification_updates' => [
    'nullable',
    'boolean',
],

'certificate_availability_updates' => [
    'nullable',
    'boolean',
],

        ]);


        /*
        |--------------------------------------------------------------------------
        | Get / Create Settings
        |--------------------------------------------------------------------------
        */

        $settings = $user->settings()->firstOrCreate();


        /*
        |--------------------------------------------------------------------------
        | Update Settings
        |--------------------------------------------------------------------------
        */

        $settings->update([

            /*
            |--------------------------------------------------------------------------
            | Appearance
            |--------------------------------------------------------------------------
            */

            'theme' =>
                $validated['theme'],


            /*
            |--------------------------------------------------------------------------
            | Notification Preferences
            |--------------------------------------------------------------------------
            */

            'email_notifications' =>
                $request->boolean('email_notifications'),

            'election_notifications' =>
                $request->boolean('election_notifications'),

            'result_notifications' =>
                $request->boolean('result_notifications'),

            'certificate_notifications' =>
                $request->boolean('certificate_notifications'),

            'security_notifications' =>
                $request->boolean('security_notifications'),


            /*
            |--------------------------------------------------------------------------
            | Election Preferences
            |--------------------------------------------------------------------------
            */

            'election_reminders' =>
                $request->boolean('election_reminders'),

            'election_registration_updates' =>
                $request->boolean('election_registration_updates'),

            'voting_confirmation' =>
                $request->boolean('voting_confirmation'),

            'election_closing_reminders' =>
                $request->boolean('election_closing_reminders'),

        ]);


        /*
        |--------------------------------------------------------------------------
        | Response
        |--------------------------------------------------------------------------
        */

        return back()->with(
            'success',
            'Settings updated successfully.'
        );
    }


    /**
     * Update account name and email.
     */
    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')
                    ->ignore($user->id),
            ],
        ]);

        $user->name =
            $validated['name'];

        $user->email =
            $validated['email'];

        $user->save();

        return back()->with(
            'success',
            'Profile information updated successfully.'
        );
    }


    /**
     * Upload or remove profile photo.
     */
    public function updateProfilePhoto(Request $request)
    {
        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | Remove profile photo
        |--------------------------------------------------------------------------
        */

        if ($request->boolean('remove_avatar')) {

            if ($user->avatar) {

                Storage::disk('public')->delete(
                    $user->avatar
                );
            }

            $user->avatar = null;

            $user->save();

            return back()->with(
                'success',
                'Profile photo removed successfully.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Validate new photo
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'avatar' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Delete old photo
        |--------------------------------------------------------------------------
        */

        if ($user->avatar) {

            Storage::disk('public')->delete(
                $user->avatar
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Store new photo
        |--------------------------------------------------------------------------
        */

        $user->avatar = $request
            ->file('avatar')
            ->store('avatars', 'public');


        $user->save();

        return back()->with(
            'success',
            'Profile photo updated successfully.'
        );
    }


    /**
     * Change account password.
     */
    public function updatePassword(Request $request)
    {
        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | Validate
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'current_password' => [
                'required',
                'current_password',
            ],

            'password' => [
                'required',
                'confirmed',
                Password::min(8),
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Prevent password reuse
        |--------------------------------------------------------------------------
        */

        if (
            Hash::check(
                $validated['password'],
                $user->password
            )
        ) {

            return back()
                ->withErrors([
                    'password' =>
                        'Your new password must be different from your current password.',
                ])
                ->withInput();
        }


        /*
        |--------------------------------------------------------------------------
        | Update password
        |--------------------------------------------------------------------------
        */

        $user->password =
            Hash::make(
                $validated['password']
            );

        $user->save();


        /*
        |--------------------------------------------------------------------------
        | Security Notification
        |--------------------------------------------------------------------------
        */

        NotificationService::send(
            $user,
            'Password Changed',
            'Your Electo account password was successfully changed.',
            'security',
            route(
                'settings.index',
                ['section' => 'security']
            ),
            'shield'
        );


        return back()->with(
            'success',
            'Your password has been changed successfully.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | TWO-FACTOR AUTHENTICATION
    |--------------------------------------------------------------------------
    */


    /**
     * Begin 2FA setup.
     */
    public function enableTwoFactor()
    {
        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | Already enabled
        |--------------------------------------------------------------------------
        */

        if (
            $user->twoFactorAuthentication &&
            $user->twoFactorAuthentication->enabled
        ) {

            return redirect()
                ->route('settings.index', [
                    'section' => 'security',
                ])
                ->with(
                    'error',
                    'Two-factor authentication is already enabled.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Generate TOTP secret
        |--------------------------------------------------------------------------
        */

        $google2fa = app(Google2FA::class);

        $secret = $google2fa->generateSecretKey();


        /*
        |--------------------------------------------------------------------------
        | Create / update 2FA record
        |--------------------------------------------------------------------------
        */

        $twoFactor =
            $user->twoFactorAuthentication()
                ->firstOrNew();

        $twoFactor->user_id =
            $user->id;


        /*
        |--------------------------------------------------------------------------
        | Encrypt secret
        |--------------------------------------------------------------------------
        */

        $twoFactor->secret =
            Crypt::encryptString(
                $secret
            );


        /*
        |--------------------------------------------------------------------------
        | Pending setup
        |--------------------------------------------------------------------------
        */

        $twoFactor->enabled = false;

        $twoFactor->confirmed_at = null;

        $twoFactor->recovery_codes = null;

        $twoFactor->save();


        /*
        |--------------------------------------------------------------------------
        | Generate QR URL
        |--------------------------------------------------------------------------
        */

        $google2fa->getQRCodeUrl(
            config('app.name', 'Electo'),
            $user->email,
            $secret
        );


        /*
        |--------------------------------------------------------------------------
        | Redirect to Security
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('settings.index', [
                'section' => 'security',
            ]);
    }


    /**
     * Confirm and activate 2FA.
     */
    public function confirmTwoFactor(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validate OTP
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'one_time_password' => [
                'required',
                'digits:6',
            ],
        ]);


        $user = auth()->user();


        /*
        |--------------------------------------------------------------------------
        | Get 2FA configuration
        |--------------------------------------------------------------------------
        */

        $twoFactor =
            $user->twoFactorAuthentication;


        if (
            !$twoFactor ||
            !$twoFactor->secret
        ) {

            return back()
                ->withErrors([
                    'one_time_password' =>
                        'Please start the 2FA setup process first.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Make sure setup is still pending
        |--------------------------------------------------------------------------
        */

        if ($twoFactor->enabled) {

            return back()->with(
                'error',
                'Two-factor authentication is already enabled.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Decrypt secret
        |--------------------------------------------------------------------------
        */

        try {

            $secret =
                Crypt::decryptString(
                    $twoFactor->secret
                );

        } catch (\Throwable $e) {

            report($e);

            return back()
                ->withErrors([
                    'one_time_password' =>
                        'The 2FA configuration could not be verified. Please restart setup.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Verify authenticator code
        |--------------------------------------------------------------------------
        */

        $google2fa =
            app(Google2FA::class);

        $valid =
            $google2fa->verifyKey(
                $secret,
                $validated['one_time_password']
            );


        if (!$valid) {

            return back()
                ->withErrors([
                    'one_time_password' =>
                        'The verification code is incorrect. Please try again.',
                ])
                ->withInput();
        }


        /*
        |--------------------------------------------------------------------------
        | Generate recovery codes
        |--------------------------------------------------------------------------
        */

        $recoveryCodes = [];

        for ($i = 0; $i < 10; $i++) {

            $recoveryCodes[] =
                Str::upper(
                    Str::random(10)
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Encrypt recovery codes
        |--------------------------------------------------------------------------
        */

        $encryptedRecoveryCodes =
            Crypt::encryptString(
                json_encode($recoveryCodes)
            );


        /*
        |--------------------------------------------------------------------------
        | Activate 2FA
        |--------------------------------------------------------------------------
        */

        $twoFactor->enabled = true;

        $twoFactor->confirmed_at = now();

        $twoFactor->recovery_codes =
            $encryptedRecoveryCodes;

        $twoFactor->save();


        /*
        |--------------------------------------------------------------------------
        | Security Notification
        |--------------------------------------------------------------------------
        */

        NotificationService::send(
            $user,
            'Two-Factor Authentication Enabled',
            'Two-factor authentication has been successfully enabled on your Electo account.',
            'security',
            route(
                'settings.index',
                ['section' => 'security']
            ),
            'shield'
        );


        /*
        |--------------------------------------------------------------------------
        | Return recovery codes
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('settings.index', [
                'section' => 'security',
            ])
            ->with([
                'success' =>
                    'Two-factor authentication has been enabled successfully.',

                'recovery_codes' =>
                    $recoveryCodes,
            ]);
    }


    /**
     * Disable 2FA.
     */
    public function disableTwoFactor(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Require current password
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'current_password' => [
                'required',
                'current_password',
            ],
        ]);


        $user =
            auth()->user();


        $twoFactor =
            $user->twoFactorAuthentication;


        if (!$twoFactor) {

            return back()->with(
                'error',
                'Two-factor authentication is not enabled.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Delete 2FA configuration
        |--------------------------------------------------------------------------
        */

        $twoFactor->delete();


        /*
        |--------------------------------------------------------------------------
        | Security Notification
        |--------------------------------------------------------------------------
        */

        NotificationService::send(
            $user,
            'Two-Factor Authentication Disabled',
            'Two-factor authentication has been disabled on your Electo account.',
            'security',
            route(
                'settings.index',
                ['section' => 'security']
            ),
            'shield'
        );


        return redirect()
            ->route('settings.index', [
                'section' => 'security',
            ])
            ->with(
                'success',
                'Two-factor authentication has been disabled.'
            );
    }


    /**
     * Generate new recovery codes.
     */
    public function regenerateRecoveryCodes(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Require current password
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'current_password' => [
                'required',
                'current_password',
            ],
        ]);


        $user =
            auth()->user();


        $twoFactor =
            $user->twoFactorAuthentication;


        if (
            !$twoFactor ||
            !$twoFactor->enabled
        ) {

            return back()->with(
                'error',
                'Two-factor authentication is not enabled.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Generate new recovery codes
        |--------------------------------------------------------------------------
        */

        $recoveryCodes = [];

        for ($i = 0; $i < 10; $i++) {

            $recoveryCodes[] =
                Str::upper(
                    Str::random(10)
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Encrypt recovery codes
        |--------------------------------------------------------------------------
        */

        $twoFactor->recovery_codes =
            Crypt::encryptString(
                json_encode($recoveryCodes)
            );

        $twoFactor->save();


        /*
        |--------------------------------------------------------------------------
        | Security Notification
        |--------------------------------------------------------------------------
        */

        NotificationService::send(
            $user,
            'Recovery Codes Regenerated',
            'New recovery codes have been generated for your Electo account. Your previous recovery codes are no longer valid.',
            'security',
            route(
                'settings.index',
                ['section' => 'security']
            ),
            'shield'
        );


        /*
        |--------------------------------------------------------------------------
        | Return codes
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('settings.index', [
                'section' => 'security',
            ])
            ->with([
                'success' =>
                    'New recovery codes have been generated.',

                'recovery_codes' =>
                    $recoveryCodes,
            ]);
    }
}