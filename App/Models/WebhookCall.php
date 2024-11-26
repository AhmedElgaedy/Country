<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebhookCall extends Model
{
    use HasFactory;

    protected $table = 'webhook_calls';

    protected $fillable = [
        'webhook_id', 'status', 'response', 'data'
    ];

    protected $casts = [
        'data' => 'array',
    ];

    public function webhook()
    {
        return $this->belongsTo(Webhook::class);
    }
}
