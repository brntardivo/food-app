<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\Management\StoreBranchOpeningHoursSettingRequest;
use App\Http\Requests\Management\UpdateBranchOpeningHoursSettingRequest;
use App\Models\Branch;
use App\Models\BranchOpeningHoursSetting;

class BranchOpeningHoursSettingController extends Controller
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
    public function store(StoreBranchOpeningHoursSettingRequest $request, Branch $branch)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(BranchOpeningHoursSetting $branchOpeningHoursSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBranchOpeningHoursSettingRequest $request, BranchOpeningHoursSetting $branchOpeningHoursSetting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BranchOpeningHoursSetting $branchOpeningHoursSetting)
    {
        //
    }
}
