<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'package_name',
        'price',
        'product_value',
        'commission',
        'status',
        'commission_processed_at'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'product_value' => 'decimal:2',
        'commission' => 'decimal:2',
        'commission_processed_at' => 'datetime'
    ];

    /**
     * Get the user that owns the order
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if commission has been processed
     */
    public function isCommissionProcessed(): bool
    {
        return !is_null($this->commission_processed_at);
    }



    /**
     * Mark commission as processed
     */
    public function markCommissionProcessed(): void
    {
        $this->update([
            'commission_processed_at' => now(),
            'status' => 'completed'
        ]);
    }
}