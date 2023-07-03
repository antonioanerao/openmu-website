<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\ConfigAttributeDefinition;

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

    public function update() {
        return request()->all();
    }
}
