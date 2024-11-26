<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Country extends Model
{
    use HasFactory;

    protected $table = 'countries';

    protected $fillable = [
        'name_en', 'name_ar', 'description_en', 'description_ar'
    ];

    public $timestamps = true;

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function scopeByLanguage($query, $language)
    {
        if ($language == 'en') {
            return $query->select('id', 'name_en as name', 'description_en as description');
        }

        return $query->select('id', 'name_ar as name', 'description_ar as description');
    }

    public function logs()
    {
        return $this->hasMany(CountryLog::class);
    }

    public function getNameAttribute()
    {
        return $this->attributes['name_en'];
    }

    public function setDescriptionEnAttribute($value)
    {
        $this->attributes['description_en'] = ucfirst($value);
    }

    public static function booted()
    {
        static::created(function ($country) {
            Log::info("Country created: {$country->name_en}");
        });

        static::updated(function ($country) {
            Log::info("Country updated: {$country->name_en}");
        });
    }
}
