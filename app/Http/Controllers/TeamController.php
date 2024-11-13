<?php

namespace App\Http\Controllers;

use App\Http\Services\RegionalService;
use App\Http\Services\TeamService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class TeamController extends Controller
{
    public function __construct(
        public TeamService $teamService,
        public RegionalService $regionalService

    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Team/Team', [
            'teams' => fn() => $this->teamService->data(),
            'subdistricts' => fn() => $this->regionalService->dataSubDistrictOnly()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required',
            'access*' => 'required|numeric'
        ]);

        User::create([
            'name' => $request->username,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'access' => json_encode($request->access)
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $id . ',id',
            'access*' => 'required|numeric'
        ]);

        $user = User::find($id);

        $user->update([
            'name' => $request->username,
            'username' => $request->username,
            'password' => $request->filled('password') ?  Hash::make($request->password) : $user->password,
            'role' => $request->role,
            'access' => json_encode($request->access)
        ]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        $user->delete();

        return redirect()->back();
    }
}
