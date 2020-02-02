<?php

namespace App\Notifications;

use App\Models\SmsCode;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use Leonis\Notifications\EasySms\Channels\EasySmsChannel;
use Leonis\Notifications\EasySms\Messages\EasySmsMessage;

class VerificationCode extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [EasySmsChannel::class];
    }
    
    public function toEasySms($notifiable)
    {
        //生成验证码并存储
        SmsCode::where('phone',$notifiable->phone)->delete();
        $data = [
            'phone'=>$notifiable->phone,
            'code'=>str_pad(rand(0,999999), 6,'0'),
            'expired_at'=>Carbon::now()->add('minute',15)->format('Y-m-d H:i:s')
        ];
        SmsCode::create($data);
        return (new EasySmsMessage)
        ->setTemplate('SMS_164278643')
        ->setData(['code' => $data['code']]);
    }
}
