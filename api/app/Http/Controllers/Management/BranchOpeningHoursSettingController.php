<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\Management\StoreBranchOpeningHoursSettingRequest;
use App\Http\Requests\Management\UpdateBranchOpeningHoursSettingRequest;
use App\Models\Branch;
use App\Models\BranchOpeningHoursSetting;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class BranchOpeningHoursSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Branch $branch)
    {
        $branch->load(['opening_hours_settings']);

        return response()->json([
            'opening_hours_settings' => $branch->opening_hours_settings,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBranchOpeningHoursSettingRequest $request, Branch $branch)
    {
        if (! $this->checkTimeCollisions($request->all(), null)) {
            throw ValidationException::withMessages([
                'weekday' => ['The times informed for this day collide with others already registered.'],
            ]);
        }

        $opening_hour_setting = new BranchOpeningHoursSetting;
        $opening_hour_setting->weekday = $request->weekday;
        $opening_hour_setting->opens_at = $request->opens_at;
        $opening_hour_setting->closes_at = $request->closes_at;

        $branch->opening_hours_settings()->save($opening_hour_setting);

        return response()->json([
            'id' => $opening_hour_setting->id,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(BranchOpeningHoursSetting $branchOpeningHoursSetting)
    {
        return response()->json([
            'opening_hours_setting' => $branchOpeningHoursSetting,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBranchOpeningHoursSettingRequest $request, Branch $branch, BranchOpeningHoursSetting $openingHour)
    {
        if (! $this->checkTimeCollisions($request->all(), $openingHour->id)) {
            throw ValidationException::withMessages([
                'weekday' => ['The times informed for this day collide with others already registered.'],
            ]);
        }

        $openingHour->weekday = $request->weekday;
        $openingHour->opens_at = $request->opens_at;
        $openingHour->closes_at = $request->closes_at;

        $openingHour->save();

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch, BranchOpeningHoursSetting $openingHour)
    {
        $openingHour->delete();

        return response()->noContent();
    }

    private function checkTimeCollisions($payload, $opening_hour_setting_id): bool
    {
        $valid = true;
        $same_days = BranchOpeningHoursSetting::where('weekday', $payload['weekday'])
            ->when($opening_hour_setting_id !== null , function($query) use ($opening_hour_setting_id) {
                $query->where('id', '!=', $opening_hour_setting_id);
            })
            ->get();

        $opens_at = Carbon::parse($payload['opens_at']);
        $closes_at = Carbon::parse($payload['closes_at']);

        foreach ($same_days as $same_day) {
            //apos hr abertura
            if ($opens_at->greaterThan($same_day->opens_at)) {
                //antes de hr fechamento
                if ($opens_at->lessThanOrEqualTo($same_day->closes_at)) {
                    $valid = false;
                    break;
                }
            } elseif ($opens_at->equalTo($same_day->opens_at)) {
                $valid = false;
                break;
            } else { // se nao é depois nen ao mesmo tempo, só pode ser antes
                //precisa ser antes da abertura
                if ($closes_at->greaterThanOrEqualTo($same_day->opens_at)) {
                    $valid = false;
                    break;
                }
            }
        }

        return $valid;
    }
}
