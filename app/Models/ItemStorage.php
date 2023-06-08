<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemStorage extends Model
{
    protected $table = 'data.ItemStorage';
    protected $primaryKey = 'Id';
    public $timestamps = false;

    protected $fillable = [
        'Id', 'Money'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'Id' => 'string'
    ];
}
