<?php

namespace App\Http\Controllers;

use App\Http\Services\PaslonService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __construct(
        public PaslonService $paslonService
    ) {}

    public function index()
    {
        return Inertia::render('Dashboard/Dashboard', [
            'paslon' => $this->paslonService->data()
        ]);
    }
}
