<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TwoFactorAuthentication extends Model
{
    protected $fillable = [
        'user_id',
        'secret',
        'enabled',
        'confirmed_at',
        'recovery_codes',
    ];

    protected $casts = [
        'enabled' => 'boolean',
        'confirmed_at' => 'datetime',
    ];

    /**
     * The user who owns this 2FA configuration.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}