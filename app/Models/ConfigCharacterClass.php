<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfigCharacterClass extends Model
{
    protected $table = 'config.CharacterClass';
    protected $primaryKey = 'Id';
    protected $keyType = 'string';

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'Id' => 'string', 'NextGenerationClassId' => 'string', 'HomeMapId' => 'string',
        'GameConfigurationId' => 'string', 'ComboDefinitionId' => 'string'
    ];
}
