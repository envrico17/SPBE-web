<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Indicator extends Model
{
    use \Znck\Eloquent\Traits\BelongsToThrough;
    use HasFactory;

    protected $fillable = [
        'aspect_id','indicator_name','description'
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
    * Get all of the score_indicators for the Indicator
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
   public function score_indicators(): HasMany
   {
       return $this->hasMany(ScoreIndicator::class);
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
     * Get the domain that owns the Indicator
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToThrough
     */
    public function domain()
    {
        return $this->belongsToThrough(Domain::class, Aspect::class);
    }

   public function getFilePathUrlAttribute()
   {
        /** @var \Illuminate\Filesystem\FilesystemManager $disk */
        $disk = Storage::disk('public');
        $url = $disk->url($this->upload_path);
        return $url;
    }
}
