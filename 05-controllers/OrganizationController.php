<?php

namespace App\Http\Controllers;

use App\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Organization::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Create a new org model
        $organization = new Organization;

        // Assign request data to the model
        $organization->user_id = Auth::id();
        $organization->name = $request->name;
        $organization->street = $request->street;
        $organization->city = $request->city;
        $organization->state = $request->state;
        $organization->zip = $request->zip;
        $organization->country = $request->country;
        $organization->phone = $request->phone;
        $organization->fax = $request->fax;
        $organization->email = $request->email;
        $organization->website = $request->website;
        $organization->type_id = $request->type_id;
        $organization->notes = $request->notes;

        // Save the model to the database
        $organization->save();

        // Return a 201 Created response
        return response($organization, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function show(Organization $organization)
    {
        // Return the organization
        return $organization;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function edit(Organization $organization)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Organization $organization)
    {
        // Assign request data to the model
        $organization->user_id = Auth::id();
        $organization->name = $request->name;
        $organization->street = $request->street;
        $organization->city = $request->city;
        $organization->state = $request->state;
        $organization->zip = $request->zip;
        $organization->country = $request->country;
        $organization->phone = $request->phone;
        $organization->fax = $request->fax;
        $organization->email = $request->email;
        $organization->website = $request->website;
        $organization->type_id = $request->type_id;
        $organization->notes = $request->notes;

        // Save the model to the database
        $organization->save();

        // Return the updated organization
        return $organization;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organization $organization)
    {
        // Delete the org
        $organization->delete();

        // Return the deleted organization
        return $organization;
    }
}
