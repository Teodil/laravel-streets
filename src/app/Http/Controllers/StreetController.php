<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Street;
use App\Services\StreetService;
use Illuminate\Http\Request;
use stdClass;

class StreetController extends Controller
{

    protected StreetService $streetService;

    public function __construct(StreetService $streetService){
        $this->streetService = $streetService;
    }

    public function index(Request $request)
    {
        $query = $request->get('q');
        if(!isset($query)){
            $streetsGroupedByRegions = $this->streetService->allGroupedByRegions();
        }
        else{
            $streetsGroupedByRegions = $this->streetService->findByQueryGroupedByRegions($query);
        }

        return view('regions', compact('streetsGroupedByRegions','query'));
    }

}
