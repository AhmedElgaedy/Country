<?php

namespace App\Repositories;

use App\Models\Country;
use App\Repositories\Contracts\CountryRepositoryInterface;
use Illuminate\Support\Collection;



class CountryRepository implements CountryRepositoryInterface
{
    public function all(): Collection
    {
        return Country::all();
    }

    public function find(int $id): ?Country
    {
        return Country::find($id);
    }

    public function create(array $data): Country
    {
        return Country::create($data);
    }

    public function update(int $id, array $data): Country
    {
        $country = $this->find($id);
        $country->update($data);
        return $country;
    }

    public function delete(int $id): bool
    {
        $country = $this->find($id);
        return $country->delete();
    }
}
