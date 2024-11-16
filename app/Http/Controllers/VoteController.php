<?php

namespace App\Http\Controllers;

use App\Events\FileUploadEvent;
use App\Http\Services\PaslonService;
use App\Http\Services\PollstationService;
use App\Http\Services\RegionalService;
use App\Jobs\HandleUploadDocument;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Spatie\SimpleExcel\SimpleExcelWriter;

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
            'request' => fn() => $request->all(),
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

    public function store(Request $request)
    {
        $request->validate(
            [
                '*.paslonData.*.value' => 'required'
            ],
            [
                '*.paslonData.*.value.required' => 'Silahkan isi perolehan suara terlebih dahulu'
            ]
        );
        DB::beginTransaction();
        try {
            foreach ($request->all() as $pollstation): (new HandleUploadDocument($pollstation))->handle();
                // dispatch(new HandleUploadDocument($pollstation['document']));
                // (new HandleUploadDocument($pollstation['document']))->handle();
                foreach ($pollstation['paslonData'] as $paslon):
                    Vote::updateOrCreate(
                        [
                            'provinceID' => $pollstation['provinceID'],
                            'districtID' => $pollstation['districtID'],
                            'subdistrictID' => $pollstation['subdistrictID'],
                            'villageID' => $pollstation['villageID'],
                            'pollstationID' => $pollstation['pollstationID'],
                            'paslonID' => $paslon['paslonID'],
                        ],
                        [
                            'provinceID' => $pollstation['provinceID'],
                            'districtID' => $pollstation['districtID'],
                            'subdistrictID' => $pollstation['subdistrictID'],
                            'villageID' => $pollstation['villageID'],
                            'pollstationID' => $pollstation['pollstationID'],
                            'paslonID' => $paslon['paslonID'],
                            'vote' => $paslon['value'],
                        ]
                    );
                endforeach;
            endforeach;

            DB::commit();
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('message', $th->getMessage());
        }
    }

    public function exportExcel()
    {
        $rows = $this->regionalService->excelData();
        $rows = $rows->map(function ($item) {
            return [
                $item->name,
                $item->total_tps,
                $item->total,
                $item->total_tps - $item->total,
                $item->vote
            ];
        })->toArray();

        return SimpleExcelWriter::streamDownload(date('Y-m-d H:i:s') . 'rekap hasil perolehan suara.xlsx')
            ->addHeader(['Kecamatan', 'Total TPS', 'Total TPS Masuk', 'Total TPS Belum Masuk', 'Total Suara'])
            ->addRows($rows)
            ->toBrowser();
    }
}
