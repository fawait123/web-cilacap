<?php

namespace App\Http\Controllers;

use App\Http\Services\PaslonService;
use App\Http\Services\PollstationService;
use App\Http\Services\RegionalService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class VoteController extends Controller
{
    public function __construct(
        public RegionalService $regionalService,
        public PollstationService $pollstationService,
        public PaslonService $paslonService
    ) {}

    public function subdistrict(Request $request)
    {
        return Inertia::render($this->path(path: $request->view), [
            'regionals' => fn() => $this->getData($request->view),
            'paslon' => fn() => $this->paslonService->data(),
            'filter' => fn() => $request->filter,
            'request' => fn() => $request->all()
        ]);
    }

    public function getData(string $path)
    {
        return $path == "tps" || $path == "input-vote" ? $this->pollstationService->data() : $this->regionalService->data();
    }

    private function path(string $path)
    {
        switch ($path) {
            case 'subdistrict':
                return 'Vote/Vote';
            case 'village':
                return 'Vote/Subdistrict';
            case 'tps':
                return 'Vote/Village';
            case 'input-vote':
                return 'Vote/InputVote';
            default:
                return 'Vote/Vote';
        }
    }
}
