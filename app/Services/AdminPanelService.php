<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AdminPanelService {

    /**
     * Returns a list of connected characters and
     * server status
     */
    public function getServerStatus() {
        if(config('app.adminpanel_user') && config('app.adminpanel_api') && config('app.adminpanel_password')) {
            return Http::
                withHeaders([
                    'Authorization' => [
                        'Basic ' .
                        base64_encode(
                            config('app.adminpanel_user') . ':' . config('app.adminpanel_password')
                        )
                    ]
                ])
                ->get(config('app.adminpanel_api'))->json() ?:
                response()->json(['error' => ['message' => 'Unauthorized']], 401);
        }

        return response()->json([
            'error' => [
                'message' => 'Could not fetch ADMIN PANEL API data'
            ]
        ], 400);
    }
}
