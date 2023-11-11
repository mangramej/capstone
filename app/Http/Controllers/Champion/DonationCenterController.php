<?php

namespace App\Http\Controllers\Champion;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class DonationCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = Location::paginate()->withQueryString();

        return view('champion.donation-center.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('champion.donation-center.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'address' => 'required',
        ]);

        Location::create($data);

        return to_route('champion.location.index');
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
    public function edit(Location $location)
    {
        return view('champion.donation-center.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Location $location)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'address' => 'required',
        ]);

        $location->name = $data['name'];
        $location->address = $data['address'];

        $location->save();

        return to_route('champion.location.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        $location->delete();

        return to_route('champion.location.index');
    }
}
