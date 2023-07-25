<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
    use HasFactory;

    protected $fillable = [
        'aspect_id','indicator_name','score','description'
   ];

   /**
    * Get all of the documents for the Indicator
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
   public function documents(): HasMany
   {
       return $this->hasMany(Document::class);
   }

   /**
    * Get the aspect that owns the Indicator
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function aspect(): BelongsTo
   {
       return $this->belongsTo(Aspect::class);
   }
}
