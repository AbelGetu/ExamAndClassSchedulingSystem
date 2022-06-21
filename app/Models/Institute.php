<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institute extends Model
{
    use HasFactory;

    /**
     * Get all of the colleges for the Institute
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function colleges()
    {
        return $this->hasMany(College::class, 'institute_id');
    }
}
