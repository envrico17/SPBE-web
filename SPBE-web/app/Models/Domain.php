<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Domain extends Model
{
    use HasFactory;

    protected $fillable = [
        'domain_name'
    ];

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
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function indicators(): HasManyThrough
    {
        return $this->hasManyThrough(Indicators::class, Aspect::class);
    }
}
