<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Purchase extends Model
{
    use HasUuids;

    protected $fillable = ['id', 'product', 'wallet', 'undone', 'unit_price', 'quantity', 'total'];

    protected $guarded = ['id'];

    /**
     * Get the wallet that owns the purchase.
     */
    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class, 'wallet');
    }
}
