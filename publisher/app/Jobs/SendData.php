<?php

namespace App\Jobs;

use App\Models\Message;
use App\Models\Subscriber;
use App\Services\AllServices\Notify;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $subscriber;
    protected $message;

    public function __construct(Subscriber $subscriber, Message $message)
    {
        $this->subscriber = $subscriber;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Notify $notify)
    {
        $notify->sendData($this->subscriber, $this->message);
    }
}
