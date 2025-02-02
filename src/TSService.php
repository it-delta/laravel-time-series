<?php

namespace TimothePearce\TimeSeries;

use Carbon\CarbonInterface;

class TSService
{
    /**
     * Get the first working day of week
     *
     * @return int
     */
    public static function getFirstWorkingDayOfWeek(): int {
        if (function_exists('getFirstWorkingDayOfWeek'))
            return getFirstWorkingDayOfWeek();
        else
            return config('time-series.beginning_of_the_week');
    }

}
