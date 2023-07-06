<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasUlids;
    use HasFactory;

    protected $fillable = [
        'user_id','indicator_id','doc_name',
        'upload_path'
   ];

   /**
    * Get the indicator that owns the Document
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function indicator(): BelongsTo
   {
       return $this->belongsTo(Indicator::class);
   }

   /**
    * Get the user that owns the Document
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function user(): BelongsTo
   {
       return $this->belongsTo(User::class);
   }
}
