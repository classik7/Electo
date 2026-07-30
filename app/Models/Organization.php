<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'name',
        'slug',
        'logo',
        'email',
        'phone',
        'website',
        'country',
        'state',
        'city',
        'address',
        'description',
        'verification_status',
        'subscription_plan',
        'status',
    ];

    /**
     * Owner of the organization.
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}