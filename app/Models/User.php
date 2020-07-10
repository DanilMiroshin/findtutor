<?php

namespace App\Models;

use App\Models\UserStatus;
use App\Models\UserRole;
use App\Models\Lesson;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot() {
        parent::boot();

        static::deleting(function($user) {
            Storage::deleteDirectory('imgs/uploads/' . $user->id);
            $user->notifications()->delete();
            Auth::logout();
        });
    }
    
    public function getTeacherInfo()
    {
        return $this->hasOne('App\Models\Teacher');
    }

    public function status()
    {
        return $this->hasOne('App\Models\UserStatus');
    }

    public function role()
    {
        return $this->hasOne('App\Models\UserRole');
    }

    public function getLessonsForStudent()
    {
        return $this->hasMany('App\Models\Lesson', 'student_id');
    }

    public function getLessonsForTeacher()
    {
        return $this->hasMany('App\Models\Lesson', 'teacher_id');
    }
}
