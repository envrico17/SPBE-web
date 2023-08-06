<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Indicator extends Model
{
    use HasFactory;

    protected $fillable = [
        'aspect_id','indicator_name','score_id','score','description'
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
    * Get all of the scores for the Indicator
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
   public function scores(): HasMany
   {
       return $this->hasMany(Score::class);
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

   /**
    * Get the score that owns the Indicator
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function score(): BelongsTo
    {
        return $this->belongsTo(Score::class);
    }

   public function getFilePathUrlAttribute()
   {
        /** @var \Illuminate\Filesystem\FilesystemManager $disk */
        $disk = Storage::disk('public');
        $url = $disk->url($this->upload_path);
        return $url;
    }
}
