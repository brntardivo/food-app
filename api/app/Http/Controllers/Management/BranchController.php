<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\Management\StoreBranchRequest;
use App\Http\Requests\Management\UpdateBranchRequest;
use App\Models\Branch;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = Branch::all();

        return response()->json([
            'branches' => $branches,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBranchRequest $request)
    {
        $branch = new Branch;
        $branch->name = $request->name;
        $branch->trading_name = $request->trading_name;
        $branch->company_name = $request->company_name;
        $branch->document = $request->document;

        $branch->save();

        return response()->json([
            'id' => $branch->id,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch)
    {
        $branch->load(['address', 'opening_hours_settings']);

        return response()->json([
            'branch' => $branch,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBranchRequest $request, Branch $branch)
    {
        $branch->name = $request->name;
        $branch->trading_name = $request->trading_name;
        $branch->company_name = $request->company_name;
        $branch->document = $request->document;

        $branch->save();

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        $branch->delete();

        return response()->noContent();
    }
}
