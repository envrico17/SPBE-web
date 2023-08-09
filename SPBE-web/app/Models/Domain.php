<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    use HasFactory;

    protected $fillable = [
        'domain_name'
    ];

    /**
     * Get the score that owns the Domain
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function score(): BelongsTo
    {
        return $this->belongsTo(Score::class);
    }

    /**
     * Get all of the aspects for the Domain
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function aspects(): HasMany
    {
        return $this->hasMany(Aspect::class);
    }

    /**
     * Get all of the indicators for the Domain
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function indicators(): HasMany
    {
        return $this->hasMany(Indicators::class);
    }
}
