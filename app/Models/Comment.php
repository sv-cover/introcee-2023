<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    protected $fillable = ['author', 'text', 'participant'];
    protected $guarded = ['id'];

    protected $table = 'comments';

    public function participant(): BelongsTo
    {
        return $this->belongsTo(ParticipantCamp::class, 'participant');
    }


}
