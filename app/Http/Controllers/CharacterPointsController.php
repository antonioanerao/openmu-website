<?php

namespace App\Http\Controllers;

use App\Http\Requests\CharacterPointsRequest;
use App\Models\Character;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CharacterPointsController extends Controller
{
    /**
     * @property Character $character
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit(Character $character) {
        // return ConfigAttributeDefinition::basePoints($character->Id);
        return view('character-points.edit', compact('character'));
    }

    public function update(Character $character, CharacterPointsRequest $request) {
        $data = $request->validated();
        $data += $request->validate([
            'leadership' => ['int', 'min:0', Rule::requiredIf(function () use ($character)  {
                return in_array($character->characterClass->Name, ['Dark Lord', 'Lord Emperor']);
            }),],
        ]);

        return $data;
    }
}
