<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bus extends Model
{
    use HasUuids;

    protected $fillable = ['id', 'bus_number'];
    protected $guarded = ['id'];

    public function participants(): HasMany
    {
        return $this->hasMany(ParticipantCamp::class, 'bus');
    }

    public function get_count(): int
    {
        return $this->participants()->count();
    }

    public function is_full(): bool
    {
        return $this->get_count() >= $this->capacity;
    }
}
