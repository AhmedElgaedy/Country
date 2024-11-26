<?php

namespace App\Http\Controllers;

use App\Http\Requests\CountryRequest;
use App\Http\Resources\CountryResource;
use App\Services\CountryService;
use App\Repositories\Contracts\CountryRepositoryInterface;
use Illuminate\Http\Request;




class CountryController extends Controller
{
    protected $countryService;
    protected $countryRepository;

    public function __construct(CountryService $countryService, CountryRepositoryInterface $countryRepository)
    {
        $this->countryService = $countryService;
        $this->countryRepository = $countryRepository;
    }

    /**
     * Display a listing of countries.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = $this->countryRepository->all();
        return CountryResource::collection($countries);
    }

    /**
     * Store a newly created country in storage.
     *
     * @param  \App\Http\Requests\CountryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CountryRequest $request)
    {
        $country = $this->countryService->createCountry($request->validated());
        return new CountryResource($country);
    }

    /**
     * Display the specified country.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $country = $this->countryRepository->find($id);
        return new CountryResource($country);
    }

    /**
     * Update the specified country in storage.
     *
     * @param  \App\Http\Requests\CountryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CountryRequest $request, $id)
    {
        $country = $this->countryService->updateCountry($id, $request->validated());
        return new CountryResource($country);
    }

    /**
     * Remove the specified country from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->countryService->deleteCountry($id);
        return response()->json(['message' => 'Country deleted successfully.'], 200);
    }
}
