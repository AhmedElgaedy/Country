<?php


namespace App\Repositories\Contracts;

use App\Models\Country;
use Illuminate\Support\Collection;

interface CountryRepositoryInterface
{
    public function all(): Collection;
    public function find(int $id): ?Country;
    public function create(array $data): Country;
    public function update(int $id, array $data): Country;
    public function delete(int $id): bool;
}
