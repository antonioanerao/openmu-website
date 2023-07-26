<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \App\Models\ConfigCharacterClass;
use App\Models\Traits\DatabaseTrait;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Character extends Model
{
    use DatabaseTrait;
    protected $table = 'data.Character';
    protected $primaryKey = 'Id';
    protected $keyType = 'string';
    public $timestamps = false;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'Id' => 'string', 'CharacterClassId' => 'string',
        'CurrentMapId' => 'string', 'InventoryId' => 'string',
        'AccountId' => 'string', 'KeyConfiguration' => 'string'
    ];

    /**
     * KeyConfiguration is hidden by default to
     * do not throw an error when ussing Character::all()
     *
     */
    protected $hidden = ['KeyConfiguration'];

    /**
     * Return a relationship between data.Character table
     * and data.StatAttribute table
     *
     * @return HasMany
     */
    public function statAttribute() {
        return $this->hasMany(DataStatAttribute::class, 'CharacterId', 'Id')
            ->whereIn('DefinitionId', [
                ConfigAttributeDefinition::RESET_ID, ConfigAttributeDefinition::LEVEL_ID,
            ])
            ->with('attributeDefinition');
    }

    public function getBasePoints() {
        return $this->hasMany(DataStatAttribute::class, 'CharacterId', 'Id')
            ->whereIn('DefinitionId', [
                ConfigAttributeDefinition::BASE_ENERGY_ID, ConfigAttributeDefinition::BASE_STRENGHT_ID
            ])
            ->with('attributeDefinition')->get();
    }

    public function ItemStorage() {
        return $this->hasOne(ItemStorage::class, 'Id', 'InventoryId');
    }

    /**
     * Get the class name
     *
     * @return HasOne
     */
    public function characterClass(): HasOne {
        return $this->hasOne(ConfigCharacterClass::class, 'Id', 'CharacterClassId')
            ->select('Name');
    }

    /**
     * Get the reset count
     *
     * @return int
     */
    public function getReset(): int {
        return $this->statAttribute
            ->where('DefinitionId', ConfigAttributeDefinition::RESET_ID)
            ->first()['Value'];
    }

    /**
     * Increment the reset count for the logged in character.
     * Usually used after a Reset
     *
     * @param $reset
     * @return void
     */
    public function incrementReset($reset = 1): void {
        $stat = $this->statAttribute
            ->where('DefinitionId', ConfigAttributeDefinition::RESET_ID)
            ->first();

        $stat->Value = $this->getReset() + $reset;
        $stat->save();
    }

    /**
     * Get the level
     *
     * @return int
     */
    public function getLevel() {
        return $this->statAttribute
            ->where('DefinitionId', ConfigAttributeDefinition::LEVEL_ID)
            ->first()['Value'];
    }

    /**
     * Set a new level for the logged in character.
     * Usually used after a Reset
     *
     * @return void
     */
    public function setLevel($level = 1): void {
        $stat = $this->statAttribute
            ->where('DefinitionId', ConfigAttributeDefinition::LEVEL_ID)
            ->first();

        $stat->Value = $level;
        $stat->save();
    }

    /**
     * Get the amount of Money
     *
     * @return int
     */
    public function getMoney(): int {
        return $this->ItemStorage->Money;
    }

    public function disincreaseMoney(int $money) {
        $stat = $this->ItemStorage;
        $stat->Money = $stat->Money - $money;
        $stat->save();
    }
}
