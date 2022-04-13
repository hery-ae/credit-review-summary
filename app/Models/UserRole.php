<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Get the user that owns the user role.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the role that owns the user role.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
