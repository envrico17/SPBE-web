<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Document extends Model
{
    use HasUuids;
    use HasFactory;

    protected $fillable = [
        'opd_id',
        'indicator_id',
        'doc_name',
        'upload_path'
   ];

   /**
    * Get the opd that owns the Document
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function opd(): BelongsTo
   {
       return $this->belongsTo(Opd::class);
   }

   /**
    * Get the score_detail that owns the Document
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function score_detail(): BelongsTo
   {
       return $this->belongsTo(ScoreDetail::class);
   }

   public function getFilePathUrlAttribute()
   {
        /** @var \Illuminate\Filesystem\FilesystemManager $disk */
        $disk = Storage::disk('public');
        $url = $disk->url($this->upload_path);
        return $url;
    }

}
