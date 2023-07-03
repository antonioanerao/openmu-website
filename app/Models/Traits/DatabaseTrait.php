<?php

namespace App\Models\Traits;

trait DatabaseTrait
{
    /**
     * Returns the table name from the Model
     *
     * @return string
     */
    public static function getTableName(): string
    {
        return (new static)->getTable();
    }
}
