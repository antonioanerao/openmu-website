<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DataStatAttribute extends Model
{
    protected $table = 'data.StatAttribute';
    protected $primaryKey = 'Id';
    protected $keyType = 'string';

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'Id' => 'string', 'DefinitionId' => 'string', 'CharacterId' => 'string',

    ];

    /**
     * Return a relationship between data.StatAttribute table
     * and config.AttributeDefinition table
     *
     * @return HasMany
     */
    public function attributeDefinition(): HasMany {
        return $this->hasMany(ConfigAttributeDefinition::class, 'Id', 'DefinitionId');
    }
}
