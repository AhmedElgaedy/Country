<?php

namespace App\Repositories;

use App\Models\CountryLog;

class CountryLogRepository
{
    public function create(array $data): CountryLog
    {
        return CountryLog::create($data);
    }

    public function all()
    {
        return CountryLog::all();
    }

    public function find(int $id): ?CountryLog
    {
        return CountryLog::find($id);
    }
}
