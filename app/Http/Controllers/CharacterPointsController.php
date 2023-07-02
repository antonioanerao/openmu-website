<?php

namespace App\Http\Controllers;

use App\Models\Character;

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
        return view('character-points.edit', compact('character'));
    }

    public function update() {
        return request()->all();
    }
}
