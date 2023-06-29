<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfigAttributeDefinition extends Model
{
    const RESET_DEFINITION = 'Resets';
    const LEVEL_DEFINITION = 'Level';

    protected $table = 'config.AttributeDefinition';
    protected $primaryKey = 'Id';
    protected $keyType = 'string';

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'Id' => 'string', 'GameConfigurationId' => 'string'
    ];

    /**
     * Returns the ID from a given attribute definition
     *
     * @param $definition string It could be Level or Reset
     * @return string
     */
    public static function getDefinition($definition): string {
        return self::where('Designation', $definition)->first()->Id;
    }
}
