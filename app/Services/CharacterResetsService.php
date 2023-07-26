<?php

namespace App\Services;

use App\Models\Character;
use Illuminate\Support\Facades\DB;
use Exception;

class CharacterResetsService {

    public function resetCharacter(Character $character) {
        return $this->resetFixedLevel($character);
    }

    private function resetFixedLevel(Character $character) {
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
            $character->save();

            DB::commit();
        } catch(Exception $e) {
            DB::rollBack();
            return $e;
        }

        return back()->with('alert-success', 'Your character was reseted!');
    }

    // private function resetTabledLevel(Character $character) {
    //     if($character->getReset() <= 5 ) {
    //         return "reset lvl 100";
    //     }

    //     if($character->getReset() > 5 && $character->getReset() <= 10) {
    //         return "reset lvl 200";
    //     }
    // }
}
