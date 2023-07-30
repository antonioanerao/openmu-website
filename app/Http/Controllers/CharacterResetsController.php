<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Services\CharacterResetsService;
use Exception;
use Illuminate\Support\Facades\DB;

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
        if(config('reset.level_required') > $character->getLevel()) {
            return back()->with('alert-warning', 'cant reset. Need lvl ' . config('reset.level_required') . '. You are ' . $character->getLevel());
        }

        if(config('reset.cost') > $character->getMoney()) {
            return back()->with('alert-warning', 'Need more money');
        }

        DB::beginTransaction();
        try {
            $character->setLevel();
            $character->incrementReset();
            $character->disincreaseMoney(config('reset.cost'));
            $character->LevelUpPoints = config('reset.level_up_points_per_reset') * $character->getReset();
            if((new CharacterResetsService())->resetCharacter($character) === false) {
                return back()->with('alert-danger', 'Something went wront. Please contact the Admin');
            }
            $character->save();
            DB::commit();
        } catch(Exception $e) {
            DB::rollBack();
            return $e;
        }

        return back()->with('alert-success', 'Your character was reseted!');
    }
}
