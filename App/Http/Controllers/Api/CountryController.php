<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Resources\CountryResource;
use App\Repositories\Contracts\CountryRepositoryInterface;
use App\Services\CountryService;
use App\Services\SoapService;
use Illuminate\Http\Request;



class CountryController extends Controller
{
    protected $countryService;
    protected $countryRepository;
    protected $soapService;



    public function __construct(CountryService $countryService, CountryRepositoryInterface $countryRepository, SoapService $soapService)
    {
        $this->countryService = $countryService;
        $this->countryRepository = $countryRepository;
        $this->soapService = $soapService;
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

    public function getCountries()
    {
        $response = $this->soapService->call('getCountries', []);
        return response()->json($response);
    }

}

