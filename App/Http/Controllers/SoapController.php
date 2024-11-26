<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Services\SoapService;
use Illuminate\Http\Request;

class SoapController extends Controller
{
    protected $soapService;

    public function __construct(SoapService $soapService)
    {
        $this->soapService = $soapService;
    }

    public function getCountries(Request $request)
    {
        $countries = Country::all();
        return response()->json($countries);
    }

    public function logRequest(Request $request)
    {
        $this->soapService->logRequest($request);
        return response()->json(['message' => 'Request logged successfully.']);
    }
}
