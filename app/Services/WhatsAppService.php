<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    protected $token;

    public function __construct()
    {
        $this->token = config('services.fonnte.token');
    }

    /**
     * Send WhatsApp message via Fonnte
     */
    public function sendMessage($to, $message)
    {
        if (!$this->token) {
            Log::error('Fonnte Token not found in configuration.');
            return false;
        }

        $noHp = preg_replace('/[^0-9]/', '', $to);
        if (strpos($noHp, '0') === 0) {
            $noHp = '62' . substr($noHp, 1);
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => $this->token,
            ])->post('https://api.fonnte.com/send', [
                'target' => $noHp,
                'message' => $message,
                'countryCode' => '62',
            ]);

            if ($response->successful()) {
                return true;
            }

            Log::error('Fonnte API Error: ' . $response->body());
            return false;
        } catch (\Exception $e) {
            Log::error('WhatsApp Service Exception: ' . $e->getMessage());
            return false;
        }
    }
}
