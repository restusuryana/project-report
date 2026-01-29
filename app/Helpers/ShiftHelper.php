<?php

namespace App\Helpers;

use Carbon\Carbon;

class ShiftHelper
{
    public static function getShift()
    {
        $hour = Carbon::now()->hour;

        if ($hour >= 7 && $hour < 15) {
            return 'Shift 1';
        }

        if ($hour >= 15 && $hour < 23) {
            return 'Shift 2';
        }

        return 'Shift 3'; // 23:00 – 06:59
    }

    public static function getTanggalSusun()
    {
        $now = Carbon::now();

        // Shift 3 (00:00 – 06:59) → hari sebelumnya
        if ($now->hour < 7) {
            return $now->subDay()->toDateString();
        }

        return $now->toDateString();
    }
}
