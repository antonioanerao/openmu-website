<?php

namespace App\Services;

use App\Models\Character;
use App\Models\ConfigAttributeDefinition;
use App\Models\DataStatAttribute;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

/**
 * CharacterPointsService is a service to handle the update logic
 * when adding LevelUpPoints to a given character
 */

class CharacterPointsService {

    /**
     * Verify if a given character has the amount of points
     * it's trying to add
     *
     * @param Character $character The given character object
     * @param $characterPointsRequest The validated data from the request
     *
     * @return RedirectResponse|JsonResponse
     *
     */
    public function update(Character $character, $characterPointsRequest): RedirectResponse|JsonResponse {
        if(array_sum($characterPointsRequest) > $character->LevelUpPoints) {
            return back()->with('alert-danger', 'You just have '.$character->LevelUpPoints.' points to add')->withInput();
        }

        if(array_sum($characterPointsRequest) === 0) {
            return back()->with('alert-warning', 'Nothing to change')->withInput();
        }

        $statusName = [];
        $arrayPoints = [];

        foreach($characterPointsRequest as $key => $d){
            array_push($statusName, 'Base ' . ucfirst($key));
            array_push($arrayPoints, $d);
        }

        $count = 0;
        DB::beginTransaction();

        try {
            foreach(ConfigAttributeDefinition::basePoints($character->Id)->whereIn('Designation', $statusName) as $s) {
                $status = DataStatAttribute::where('CharacterId', $character->Id)->where('DefinitionId', $s->DefinitionId)->first();
                $status->Value += $arrayPoints[$count];
                $status->save();
                $count += 1;
            }

            $character->LevelUpPoints -= array_sum($characterPointsRequest);
            $character->save();
            DB::commit();
        } catch(Exception $e) {
            DB::rollBack();
            return response()->json(
                [
                    'error' => [
                        'code' => $e->getCode(),
                        'message' => $e->getMessage(),
                        'status' => 500
                    ]
                ], 500);
        }

        return back()->with('alert-success', 'You have added your points');
    }
}
