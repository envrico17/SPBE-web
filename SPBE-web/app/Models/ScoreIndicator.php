<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;


class ScoreIndicator extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;
    use \Bkwld\Cloner\Cloneable;

    protected $fillable = [
        'indicator_id', 'score_id', 'score', 'score_description'
    ];

    protected $clone_exempt_attributes = ['score'];

    /**
     * Get the indicator that owns the ScoreIndicator
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function indicator(): BelongsTo
    {
        return $this->belongsTo(Indicator::class);
    }

    /**
     * Get the aspect that owns the ScoreIndicator
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToThrough
     */
    public function aspect()
    {
        return $this->BelongsToThrough(Aspect::class, Indicator::class);
    }

    /**
     * Get the domain that owns the ScoreIndicator
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToThrough
     */
    public function domain()
    {
        return $this->BelongsToThrough(Domain::class,[Aspect::class, Indicator::class]);
    }

    /**
     * Get the score that owns the ScoreIndicator
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function score(): BelongsTo
    {
        return $this->belongsTo(Score::class);
    }
}
