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
        'score_name', 'score_description', 'score_date', 'score_date_range'
    ];

    protected $cloneable_relations = ['score_indicators'];

    /**
     * Get all of the score_indicators for the Score
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function score_indicators(): HasMany
    {
        return $this->hasMany(ScoreIndicator::class);
    }
}
