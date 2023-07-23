<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;

class AdminPanelService {

    /**
     * Returns a list of connected characters and
     * server status
     *
     * @param $timeout How long until returns a timeout status
     * return array
     */
    public function getServerStatus($timeout = 2): array {
        try{
            if(config('app.adminpanel_user') && config('app.adminpanel_api') && config('app.adminpanel_password')) {
                return Http::timeout($timeout)
                    ->withHeaders([
                        'Authorization' => [
                            'Basic ' .
                            base64_encode(
                                config('app.adminpanel_user') . ':' . config('app.adminpanel_password')
                            )
                        ]
                    ])
                    ->get(config('app.adminpanel_api'))->json() ?:
                    $this->offline();

            }

        }catch(Exception) {
            return $this->offline();
        }

        return [
            'error' => [
                'message' => 'Could not fetch ADMIN PANEL API data'
            ]
        ];
    }

    /**
     * Returns an array with offline information
     *
     * @return array
     */
    private function offline(): array {
        return [
            'state' => 'Offline',
            'players' => 0,
            'playerList' => []
        ];
    }
}
