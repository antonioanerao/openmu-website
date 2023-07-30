<?php

namespace App\Models;

use App\Models\Traits\DatabaseTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class ConfigAttributeDefinition extends Model
{
    use HasUuids, DatabaseTrait;

    /**
     * Constants to get the Attribute Definition ID
     * from config.AttributeDefinition table
     */
    const RESET_ID = '89a891a7-f9f9-4ab5-af36-12056e53a5f7';
    const LEVEL_ID = '560931ad-0901-4342-b7f4-fd2e2fcc0563';
    const BASE_ENERGY_ID = '01b0ef28-f7a0-46b5-97ba-2b624a54cd75';
    const BASE_STRENGHT_ID = '123282fe-fead-448e-ad2c-baece939b4b1';
    const BASE_AGILITY_ID = '1ae9c014-e3cd-4703-bd05-1b65f5f94ceb';
    const BASE_VITALITY_ID = '6ca5c3a6-b109-45a5-87a7-fdcb107b4982';

    protected $table = 'config.AttributeDefinition';
    protected $primaryKey = 'Id';
    protected $keyType = 'string';

    /**
     * KeyConfiguration is hidden by default to
     * do not throw an error when ussing Character::all()
     *
     */
    protected $hidden = ['KeyConfiguration'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'Id' => 'string', 'GameConfigurationId' => 'string'
    ];

    public function value() {
        return $this->hasOne(DataStatAttribute::class, 'DefinitionId', 'Id');
    }

    /**
     * Return the given base status from a given Character
     *
     * @param Uuid $CharacterId The Character Id
     * @return Collection
     */
    public static function basePoints($CharacterId): Collection {
        return self::distinct()->whereIn('Designation', ['Base Strength', 'Base Agility', 'Base Vitality', 'Base Energy', 'Base Leadership'])
            ->join(DataStatAttribute::getTableName(), DataStatAttribute::getTableName().'.DefinitionId', self::getTableName().'.Id')
            ->join(Character::getTableName(), Character::getTableName().'.Id', DataStatAttribute::getTableName().'.CharacterId')
            ->where(DataStatAttribute::getTableName().'.CharacterId', $CharacterId)
            ->get();
    }

}
