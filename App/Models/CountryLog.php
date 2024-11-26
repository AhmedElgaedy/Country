<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryLog extends Model
{
    use HasFactory;

    protected $table = 'country_logs';

    protected $fillable = [
        'country_id', 'action', 'old_data', 'new_data'
    ];

    protected $casts = [
        'old_data' => 'array',
        'new_data' => 'array',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public static function logChange(Country $country, string $action, array $oldData, array $newData)
    {
        self::create([
            'country_id' => $country->id,
            'action' => $action,
            'old_data' => $oldData,
            'new_data' => $newData,
        ]);
    }
}
