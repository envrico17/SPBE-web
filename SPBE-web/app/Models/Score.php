<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Score extends Model
{
    use HasFactory;
    use \Bkwld\Cloner\Cloneable;

    protected $fillable = [
        'score_name', 'score_value', 'score_description', 'score_date'
    ];

    protected $cloneable_relations = ['indicators'];

    /**
     * Get all of the indicators for the Score
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function indicators(): HasMany
    {
        return $this->hasMany(Indicator::class);
    }
}
