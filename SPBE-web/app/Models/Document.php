<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasUuids;
    use HasFactory;

    protected $fillable = [
        'user_id',
        'indicator_id',
        'doc_name',
        'upload_path'
   ];

   /**
    * Get the user that owns the Document
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function user(): BelongsTo
   {
       return $this->belongsTo(User::class);
   }

   /**
    * Get the indicator that owns the Document
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function indicator(): BelongsTo
   {
       return $this->belongsTo(Indicator::class);
   }

}
