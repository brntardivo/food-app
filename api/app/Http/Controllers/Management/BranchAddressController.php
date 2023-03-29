<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\Management\UpdateBranchAddressRequest;
use App\Models\Branch;

class BranchAddressController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Branch $branch)
    {
        $branch->load(['address']);

        return response()->json([
            'address' => $branch->address,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBranchAddressRequest $request, Branch $branch)
    {
        $branch->load(['address']);

        $branch->address->address = $request->address;
        $branch->address->complement = $request->complement;
        $branch->address->zip_code = $request->zip_code;
        $branch->address->district = $request->district;
        $branch->address->city = $request->city;
        $branch->address->state = $request->state;

        $branch->address->save();

        return response()->noContent();
    }
}
