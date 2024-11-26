<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }


    public function hasRole(string $role)
    {
        return $this->role === $role;
    }

    public function getRoleAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * Mutator for the user's password.
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * Accessor for the user's email (if needed).
     *
     * @return string
     */
    public function getEmailAttribute($value)
    {
        return strtolower($value);
    }


    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    /**
     * OAuth2 Relationships
     * Passport already provides a relationship between the User model and personal access tokens.
     */
    public function tokens()
    {
        return $this->hasMany(\Laravel\Passport\PersonalAccessToken::class);
    }

    /**
     * Soft delete the user.
     *
     * @return void
     */
    public function deleteUser()
    {
        $this->delete();
    }
}
