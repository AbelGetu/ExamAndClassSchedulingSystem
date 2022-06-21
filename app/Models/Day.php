<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;

    /**
     * Get all of the timetables for the Day
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function timetables()
    {
        return $this->hasMany(Timetable::class, 'day_id');
    }
}
