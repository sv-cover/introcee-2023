<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Wallet extends Model
{
    use HasUuids;

    protected $fillable = ['id', 'first_name', 'last_name', 'email', 'balance'];

    protected $guarded = ['id'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wallets';

    public function topUps(): HasMany
    {
        return $this->hasMany(TopUp::class, 'wallet');
    }

    public function auctions(): HasMany
    {
        return $this->hasMany(Auction::class, 'wallet');
    }

    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class, 'wallet');
    }
}
