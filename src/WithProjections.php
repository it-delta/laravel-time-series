<?php

namespace Laravelcargo\LaravelCargo;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Laravelcargo\LaravelCargo\Models\Projection;

trait WithProjections
{
    /**
     * Boot the trait.
     */
    public static function bootWithProjections(): void
    {
        static::created(function (Model $model) {
            $model->parseIntervals();
        });
    }

    /**
     * Parse the intervals defined as class attribute.
     */
    private function parseIntervals(): void
    {
        collect($this->intervals)->each(fn ($interval) => $this->parseInterval($interval));
    }

    /**
     * Parse the given interval and return the projection.
     */
    private function parseInterval(string $interval): Projection
    {
        [$unit, $period] = Str::of($interval)->split('/[\s]+/');

        return $this->findOrCreateProjection($interval, $unit, $period);
    }

    /**
     * Find or create the projection.
     */
    private function findOrCreateProjection(string $interval, string $unit, string $period): Projection
    {
        return Projection::create([
            'model_name' => 'model name',
            'interval_name' => $interval,
            'content' => 'content',
            'interval_start' => Carbon::now(),
            'interval_end' => Carbon::now()->add(1, 'minute'),
        ]);

        // Find the end date (round to something ?)
        // Find the start date
        // Query the model filtered by the period name and between the dates computed

        // Format to UTC?
        // $endDate = Carbon::now()->floorUnit($unit, $period)->format('H:i:s.u');

        // Call the right unit function
        // $startDate = $endDate->minMinutes($period);

        // return Projection::between($startDate, $endDate)
        //     ->where('interval', $interval)
        //     ->findOrCreate($this->defaultProjection());
    }

    /**
     * Get the interval count.
     */
    public function getIntervalCount(): int
    {
        return count($this->intervals);
    }
}