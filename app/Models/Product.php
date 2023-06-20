<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;



class Product extends Model
{
    use HasUuids;

    protected $fillable = ['id', 'name', 'description', 'image', 'age_restriction', 'price'];

    protected $guarded = ['id'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class, 'product');
    }
}
