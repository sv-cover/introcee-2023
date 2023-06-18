<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TopUp extends Model
{
    protected $fillable = ['id', 'wallet', 'amount', 'final_amount', 'payment_reference', 'confirmed'];

    protected $guarded = ['id'];

    /**
     * Get the wallet that owns the topup.
     */
    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class, 'wallet');
    }
}
