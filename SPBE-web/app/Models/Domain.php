<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
