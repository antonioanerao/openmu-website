<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \App\Models\ConfigCharacterClass;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Character extends Model
{
    protected $table = 'data.Character';
    protected $primaryKey = 'Id';
    protected $keyType = 'string';

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'Id' => 'string', 'CharacterClassId' => 'string',
        'CurrentMapId' => 'string', 'InventoryId' => 'string',
        'AccountId' => 'string',
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
            ->whereIn('DefinitionId', [ConfigAttributeDefinition::RESET_ID, ConfigAttributeDefinition::LEVEL_ID])
            ->with('attributeDefinition');
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
     * Get the level
     *
     * @return int
     */
    public function getLevel() {
        return $this->statAttribute
            ->where('DefinitionId', ConfigAttributeDefinition::LEVEL_ID)
            ->first()['Value'];
    }
}
