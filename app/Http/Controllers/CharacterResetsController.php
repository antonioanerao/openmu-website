<?php

namespace App\Http\Controllers;

use App\Http\Requests\CharacterResetsRequest;
use App\Models\Character;

class CharacterResetsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verifyCharacterAccountOwner');
        $this->middleware('verifyCharacterOnline');
    }

    public function update(Character $character, CharacterResetsRequest $request) {
        return $character;
    }
}
