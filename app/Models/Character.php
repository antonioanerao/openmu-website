<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
            ->with('attributeDefinition');
    }

    /**
     * Get the reset count
     *
     * @return int
     */
    public function getReset(): int {
        return $this->statAttribute
            ->where('DefinitionId', ConfigAttributeDefinition::getDefinition(ConfigAttributeDefinition::RESET_DEFINITION))
            ->first()['Value'];
    }

    /**
     * Get the level
     *
     * @return int
     */
    public function getLevel() {
        return $this->statAttribute
            ->where('DefinitionId', ConfigAttributeDefinition::getDefinition(ConfigAttributeDefinition::LEVEL_DEFINITION))
            ->first()['Value'];
    }
}
