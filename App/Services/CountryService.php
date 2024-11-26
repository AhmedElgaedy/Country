<?php

namespace App\Services;

use App\Repositories\CountryRepository;
use App\Repositories\CountryLogRepository;
use Illuminate\Support\Facades\DB;
use App\Models\Country;

class CountryService
{
    protected $countryRepository;
    protected $countryLogRepository;

    public function __construct(CountryRepository $countryRepository, CountryLogRepository $countryLogRepository)
    {
        $this->countryRepository = $countryRepository;
        $this->countryLogRepository = $countryLogRepository;
    }

    public function createCountry(array $data): Country
    {
        DB::beginTransaction();
        try {
            // Create country
            $country = $this->countryRepository->create($data);

            // Log the creation
            $this->countryLogRepository->create([
                'country_id' => $country->id,
                'action' => 'create',
                'old_data' => null,
                'new_data' => $country->toJson(),
            ]);

            DB::commit();

            return $country;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateCountry(int $id, array $data): Country
    {
        DB::beginTransaction();
        try {
            $country = $this->countryRepository->find($id);
            $oldData = $country->toJson();

            // Update country
            $country = $this->countryRepository->update($id, $data);

            // Log the update
            $this->countryLogRepository->create([
                'country_id' => $country->id,
                'action' => 'update',
                'old_data' => $oldData,
                'new_data' => $country->toJson(),
            ]);

            DB::commit();

            return $country;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function deleteCountry(int $id): bool
    {
        DB::beginTransaction();
        try {
            $country = $this->countryRepository->find($id);

            // Log the deletion
            $this->countryLogRepository->create([
                'country_id' => $country->id,
                'action' => 'delete',
                'old_data' => $country->toJson(),
                'new_data' => null,
            ]);

            // Delete country
            $deleted = $this->countryRepository->delete($id);

            DB::commit();

            return $deleted;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
