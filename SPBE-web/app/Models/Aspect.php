<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Aspect extends Model
{
    use HasFactory;

    protected $fillable = [
        'domain_id','aspect_name'
   ];

   /**
    * Get all of the indicators for the Aspect
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
   public function indicators(): HasMany
   {
       return $this->hasMany(Indicator::class);
   }

   /**
    * Get the domain that owns the Aspect
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function domain(): BelongsTo
   {
       return $this->belongsTo(Domain::class);
   }
}
