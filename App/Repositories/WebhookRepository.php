<?php

namespace App\Repositories;

use App\Models\Webhook;

class WebhookRepository
{
    public function create(array $data): Webhook
    {
        return Webhook::create($data);
    }

    public function find(int $id): ?Webhook
    {
        return Webhook::find($id);
    }

    public function all()
    {
        return Webhook::all();
    }
}
