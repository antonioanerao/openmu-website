<?php

namespace App\Services;

use App\Models\ItemStorage;
use Illuminate\Support\Str;

class ItemStorageService {

    /**
     * Create a vault for an account
     *
     * @param $money
     * @return ItemStorage
     */

    public function store($money): ItemStorage
    {
        return ItemStorage::create([
            'Id' => Str::uuid(),
            'Money' => $money
        ]);
    }
}
