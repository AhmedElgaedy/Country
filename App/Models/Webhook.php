<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\WebhookClient\WebhookClient;

class Webhook extends Model
{
    use HasFactory;

    protected $table = 'webhooks';

    protected $fillable = [
        'url', 'callback_type', 'status'
    ];

    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';

    public function calls()
    {
        return $this->hasMany(WebhookCall::class);
    }

    public function trigger(array $data)
    {
        $client = new WebhookClient();

       try {
            $response = $client->sendTo($this->url, $data);

            WebhookCall::create([
                'webhook_id' => $this->id,
                'status' => $response->getStatusCode(),
                'response' => $response->getBody()->getContents(),
                'data' => $data,
            ]);

            return $response;
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to trigger webhook: ' . $e->getMessage()]);
        }
    }

    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }
}
