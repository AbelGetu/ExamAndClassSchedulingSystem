<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionAllocation extends Model
{
    use HasFactory;

   /**
    * Get the class_section_allocation that owns the SectionAllocation
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function class_section_allocation()
   {
       return $this->belongsTo(ClassSectionAllocation::class, 'class_section_allocation_id');
   }

   /**
    * Get the room that owns the SectionAllocation
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function room()
   {
       return $this->belongsTo(Room::class, 'room_id');
   }
}
