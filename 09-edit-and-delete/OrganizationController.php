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
        $organizations = Auth::user()->organizations;

        return view('organizations.browse', compact('organizations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('organizations/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required',
            'type_id' => 'required|integer',
            'email' => 'nullable|email',
            'website' => 'nullable|url'
        ]);

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
        // Authorize the request
        $this->authorize('view', $organization);

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
        return view('organizations/edit', compact('organization'));
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
        // Authorize the request
        $this->authorize('update', $organization);

        // Validate the request
        $request->validate([
            'name' => 'required',
            'type_id' => 'required|integer',
            'email' => 'nullable|email',
            'website' => 'nullable|url'
        ]);

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
        // Authorize the request
        $this->authorize('delete', $organization);

        // Delete the org
        $organization->delete();

        // Return the deleted organization
        return $organization;
    }
}
