<?php

namespace App\Http\Controllers;

use App\Http\Requests\CharacterPointsRequest;
use App\Models\Character;
use App\Services\CharacterPointsService;
use Illuminate\Validation\Rule;

class CharacterPointsController extends Controller
{
    /**
     * @property Character $character
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verifyCharacterAccountOwner');
    }

    public function edit(Character $character) {
        return view('character-points.edit', compact('character'));
    }

    public function update(Character $character, CharacterPointsRequest $request) {
        $pointsToAdd = $request->validated();

        /**
         * Merge the validation request for leadership into the $pointsToAdd array,
         * in the position 3
         */
        $pointsToAdd = array_merge(array_slice($pointsToAdd, 0, 3), $request->validate([
            'leadership' => ['int', 'min:0', Rule::requiredIf(function () use ($character)  {
                return in_array($character->characterClass->Name, ['Dark Lord', 'Lord Emperor']);
            }),],
        ]), array_slice($pointsToAdd, 3));

        return (new CharacterPointsService())->update($character, $pointsToAdd);
    }
}
