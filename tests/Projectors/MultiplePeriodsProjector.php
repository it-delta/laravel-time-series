<?php

namespace TimothePearce\Quasar\Tests\Projectors;

use Illuminate\Database\Eloquent\Model;
use TimothePearce\Quasar\Contracts\ProjectionContract;
use TimothePearce\Quasar\Models\Projection;

class MultiplePeriodsProjector extends Projection implements ProjectionContract
{
    /**
     * Lists the time intervals used to compute the projections.
     */
    public static array $periods = [
        '5 minutes',
        '1 hour',
        '6 hours',
        '1 day',
        '1 week',
        '1 month',
        '3 months',
        '1 year',
    ];

    /**
     * The default projection content.
     */
    public static function defaultContent(): array
    {
        return [
            'number of logs' => 0,
        ];
    }

    /**
     * Compute the projection's content.
     */
    public static function handle(array $content, Model $model): array
    {
        return [
            'number of logs' => $content['number of logs'] + 1,
        ];
    }
}