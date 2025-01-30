<?php

namespace TimothePearce\TimeSeries\Services;

use TimothePearce\TimeSeries\Contracts\WeekInfoContract;
use Carbon\CarbonInterface;

class DefaultWeekInfoService implements WeekInfoContract
{
    public function get(): int
    {
        return CarbonInterface::MONDAY;
    }
}
