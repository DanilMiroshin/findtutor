<?php

namespace App\Notifications;

use App\Models\Lesson;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LessonMessageSetNotification extends Notification
{
    use Queueable;
    
    public $lesson;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Lesson $lesson)
    {
        $this-> lesson = $lesson;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'teacher_id' => $this->lesson->teacher_id,
        ];                  
    }
}
