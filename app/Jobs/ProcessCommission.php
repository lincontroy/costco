<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessCommission implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;

    /**
     * Create a new job instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Update user's commission balance (assuming you have a commission field in users table)
        $user = $this->order->user;
        
        // Add commission to user's balance
        $user->increment('commission_balance', $this->order->commission);
        
        // Mark order commission as processed
        $this->order->markCommissionProcessed();
        
        // Optional: Send notification to user
        // $user->notify(new CommissionProcessedNotification($this->order));
    }
}