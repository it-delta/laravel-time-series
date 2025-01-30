<?php

namespace TimothePearce\TimeSeries\Services;

use TimothePearce\TimeSeries\Contracts\WeekInfoContract;

/**
 * WeekService, alternate mehtod If we need use WeekInfoContract safe way wihtout __construct
 */
class WeekService
{
    public function __construct(protected WeekInfoContract $weekInfoContract) {}

    public function get():int{
        return $this->weekInfoContract->get();
    }
}
