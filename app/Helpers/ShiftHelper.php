<?php
namespace App\Helpers;

use Carbon\Carbon;

class ShiftHelper
{
    public static function getShift()
    {
        $time = Carbon::now()->format('H:i');

        if ($time >= '07:00' && $time <= '15:00') {
            return 'Shift 1';
        } elseif ($time >= '15:01' && $time <= '23:00') {
            return 'Shift 2';
        } else {
            return 'Shift 3';
        }
    }
}
