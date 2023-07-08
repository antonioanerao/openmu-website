<?php

namespace App\Http\Controllers;

use App\Models\Character;

class CharacterResetsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verifyCharacterAccountOwner');
    }

    public function update(Character $character) {
        return $character;
    }
}
