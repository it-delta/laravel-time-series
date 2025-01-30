<?php
namespace TimothePearce\TimeSeries\Jobs;

use TimothePearce\TimeSeries\Jobs\ComputeProjection;
use TimothePearce\TimeSeries\Contracts\RecalculationWeeksContract;

class ComputeMultipleWeekRecalculations extends ComputeProjection
{

    public function __construct(protected RecalculationWeeksContract $recalculationWeeksContract) {}

    public function handle()
    {
        $this->recalculationWeeksContract->run();
    }
}
