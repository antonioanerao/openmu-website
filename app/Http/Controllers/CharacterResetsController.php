<?php

namespace App\Http\Controllers;

use App\Http\Requests\CharacterResetsRequest;
use App\Models\Character;
use App\Services\AdminPanelService;
use App\Services\CharacterResetsService;

class CharacterResetsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verifyCharacterAccountOwner');
        $this->middleware('verifyServerStatus');
        $this->middleware('verifyCharacterOnline');
    }

    public function update(Character $character) {
        return (new CharacterResetsService())->resetCharacter($character);
    }
}
