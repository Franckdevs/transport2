<?php

namespace App\Helpers;

use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Support\Str;

class GlobalHelper
{

public static function generateNumeroReservation(): string
{
    do {
        $numero = 'RES-' . date('Y') . '-' . strtoupper(Str::random(6));
    } while (Reservation::where('numero_reservation', $numero)->exists());

    return $numero;
}


    public static function formatCreatedAt($date = null)
    {
        if (!$date) {
            $date = now();
        }

        if (is_string($date)) {
            $date = Carbon::parse($date);
        }

        return $date->format('d/m/Y à H:i');
    }

     /**
     * Limiter une chaîne de caractères avec un nombre de caractères défini
     *
     * @param string|null $text
     * @param int $limit
     * @param string $end
     * @return string
     */
    public static function limitText($text = null, int $limit = 15, string $end = '...')
    {
        if (empty($text)) {
            return '';
        }

        return Str::limit($text, $limit, $end);
    }

}
