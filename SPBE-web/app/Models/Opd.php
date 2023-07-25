<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Opd extends Model
{
    use HasFactory;

    protected $fillable = [
        'opd_name',
        'opd_alias',
        'user_id'
   ];

   /**
    * Get the user that owns the Opd
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function user(): BelongsTo
   {
       return $this->belongsTo(User::class);
   }
}
