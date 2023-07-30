<?php

namespace App\Services;

use App\Models\Character;
use App\Models\ConfigAttributeDefinition;
use App\Models\DataStatAttribute;
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
            foreach((new ConfigAttributeDefinition())->basePoints($character->Id) as $key => $p) {
                $status = DataStatAttribute::where('CharacterId', $p->CharacterId)
                    ->where('DefinitionId', $p->DefinitionId)
                    ->first();
                $status->Value = array_values($this->defaultStatusPoints($character))[$key];
                $status->save();

            }
            $character->save();

            DB::commit();
        } catch(Exception $e) {
            DB::rollBack();
            return $e;
        }

        return back()->with('alert-success', 'Your character was reseted!');
    }

    /**
     * Returns the default status points for a given character
     * basese on class name
     */
    private function defaultStatusPoints(Character $character) {
        switch($character->characterClass->Name) {
            case 'Dark Knight':
            case 'Blade Knight':
            case 'Blade Master':
            case 'Dragon Knight':
                return config('character.default.status.dk');
            case 'Fairy Elf':
            case 'Muse Elf':
            case 'High Elf':
            case 'Noble Elf':
                return config('character.default.status.elf');
            case 'Dark Wizard':
            case 'Soul Master':
            case 'Grand Master':
            case 'Soul Wizard':
                return config('character.default.status.dw');
            case 'Magic Gladiator':
            case 'Duel Master':
            case 'Magic Knight':
                return config('character.default.status.mg');
            case 'Dark Lord':
            case 'Lord Emperor':
            case 'Empire Lord':
                return config('character.default.status.dl');
            case 'Summoner':
            case 'Bloody Summoner':
            case 'Dimension Master':
            case 'Dimension Summoner':
                return config('character.default.status.sum');
            case 'Rage Fighter':
            case 'Fist Master':
            case 'Fist Blazer':
                return config('character.default.status.rf');
        }
    }
}
