<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\User;
use App\Notifications\LessonMessageSetNotification;
use App\Notifications\LessonCreateNotification;
use App\Http\Requests\Lessons\CreateRequest;
use App\Http\Requests\Lessons\UpdateRequest;
use Illuminate\Support\Facades\Auth;
use Notification;
use Carbon\Carbon;

class LessonsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Create a new lesson and make notifcation for teacher
     * @param  CreateRequest $request
     * @return redirect with success message
     */
    public function create(CreateRequest $request)
    {
        $lesson = Lesson::create([
                'teacher_id' => $request->id,
                'student_id' => Auth::id()
            ]);

        User::findOrFail($lesson->teacher_id)->notify(new LessonCreateNotification($lesson));

        return redirect('search')
                    ->with('success', 'Вы успешно записались к преподавателю');  
    }
    /**
     * Set message from teacher to student and make notifcation for student 
     * @param Lesson $lesson, 
     * @param UpdateRequest $request
     * @return redirect back 
     */
    public function update(Lesson $lesson, UpdateRequest $request)
    {
        $lesson->update(['message' => encrypt($request->message)]);

        User::findOrFail($lesson->student_id)->notify(new LessonMessageSetNotification($lesson));

        return back()
                ->with('success', 'Сообщение отправлено');   
    }
    /**
     * Delete lesson
     * @param  Lesson $lesson
     * @return redirect back 
     */
    public function destroy(Lesson $lesson)
    {
        $lesson->forceDelete();
        return back()
                ->with('success', 'Занятие отменено');
    }

    /**
     * Mark motification as read
     * @param  User $user
     * @return redirect back 
     */
    public function markNotifications()
    {
        Auth::user()->unreadNotifications()->update(['read_at' => Carbon::now()]);
        return back()
                ->with('success', 'Помечено как прочитанное');
    }
}
