<?php

namespace App\Http\Controllers;

use App\Http\Services\PaslonService;
use App\Http\Services\RegionalService;
use App\Models\Pollstation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __construct(
        public PaslonService $paslonService,
        public RegionalService $regionalService
    ) {}

    public function index()
    {
        return Inertia::render('Dashboard/Dashboard', [
            'paslon' => fn() => $this->paslonService->data(),
            'data' => fn() => $this->getData(),
        ]);
    }

    public function mapView()
    {
        return Inertia::render('Map/MapView', [
            'mapData' => fn() => $this->regionalService->subDistrict()
        ]);
    }

    public function getData()
    {
        return [
            'total_tps' => Pollstation::count(),
            'total' =>  DB::table('votes')
                ->distinct('pollstationID')
                ->count('pollstationID')
        ];
    }
}
