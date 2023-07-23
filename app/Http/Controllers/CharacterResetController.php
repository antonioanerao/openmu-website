<?php

namespace App\Http\Controllers;

use App\Models\Character;

class CharacterResetController extends Controller
{
    public function __construct(public Character $character)
    {
        $this->middleware('auth');
        $this->middleware('verifyCharacterAccountOwner');
        $this->middleware('verifyCharacterOnline');
    }

    public function edit(Character $character) {

    }
}
