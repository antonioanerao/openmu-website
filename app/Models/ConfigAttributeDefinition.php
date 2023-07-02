<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfigAttributeDefinition extends Model
{
    /**
     * Constants to get the Attribute Definition ID
     * from config.AttributeDefinition table
     */
    const RESET_ID = '89a891a7-f9f9-4ab5-af36-12056e53a5f7';
    const LEVEL_ID = '560931ad-0901-4342-b7f4-fd2e2fcc0563';
    const BASE_ENERGY_ID = '01b0ef28-f7a0-46b5-97ba-2b624a54cd75';

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
}
