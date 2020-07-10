<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $guarded = ['id'];

    public function getTeacher()
    {
        return $this->hasOne('App\Models\User', 'id', 'teacher_id');
    }

    public function getStudent()
    {
        return $this->hasOne('App\Models\User', 'id', 'student_id');
    }

    /**
     * Returns decrypted $message for student from db, if empty retruns nothing
     * @param  [string] encrypted $message 
     * @return [string] dencrypted $message 
     */
    public function getMessageAttribute($message)
    {
        return empty($message) ? '' : decrypt($message);
    }
}
