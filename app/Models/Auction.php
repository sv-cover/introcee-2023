<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Auction extends Model
{
    use HasUuids;
    protected $fillable = ['id', 'product', 'price', 'wallet'];
    protected $guarded = ['id'];

    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class, 'wallet');
    }
}
