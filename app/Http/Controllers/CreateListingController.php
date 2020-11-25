<?php

namespace App\Http\Controllers;
use App\Models\Property_rent;
use Illuminate\Http\Request;

class CreateListingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('agent_dashboard/create_listing/rent-form');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'property_type' => 'required',
            'property_status' => 'required',
            'property_label' => 'required',
            'monthly_rate' => 'required',
            'yearly_rate' => 'required',
            'rent_duration' => 'required',
            'currency'
        ]);

        Property_rent::create($request->all());

        return redirect()->route('Property_rent.index')
            ->with('success', 'Project created successfully.');
    }
}
