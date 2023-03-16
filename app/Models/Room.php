<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    /**
     * Get the building that owns the Room
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function building()
    {
        return $this->belongsTo(Building::class, 'building_id');
    }

    /**
     * Get all of the section_allocations for the Room
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function section_allocations()
    {
        return $this->hasMany(SectionAllocation::class, 'room_id');
    }
}
