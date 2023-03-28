<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\Management\StoreBranchAddressRequest;
use App\Http\Requests\Management\UpdateBranchAddressRequest;
use App\Models\Branch;
use App\Models\BranchAddress;

class BranchAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Branch $branch)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBranchAddressRequest $request, Branch $branch)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(BranchAddress $branchAddress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBranchAddressRequest $request, BranchAddress $branchAddress)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BranchAddress $branchAddress)
    {
        //
    }
}
