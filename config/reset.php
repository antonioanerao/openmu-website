<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Reset Config
    |--------------------------------------------------------------------------
    |
    | Here you can set default values for character reset.
    |
     */

    'level_required' => env('RESET_LEVEL_REQUIRED', 0),
    'level_after_reset' => env('RESET_LEVEL_AFTER_RESET', 1),
    'level_up_points_per_reset' => env('RESET_LEVEL_UP_POINTS_PER_RESET', 100),
    'cost' => env('RESET_COST', 100),
];
