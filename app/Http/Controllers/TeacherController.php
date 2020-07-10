<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Teacher;

use App\Http\Requests\UpdateTeacherRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(User $user, UpdateTeacherRequest $request)
    {
        $teacher = Teacher::where(['user_id' => $user->id])->firstOrFail();

        if (request()->hasFile('document')) {
            $filepath = 'imgs/uploads/' . $user->id . '/document';
            $filename = Str::random(20) . '.' . request()->document->extension();

            Storage::delete($teacher->path_to_document);
            request()->document->storeAs($filepath, $filename); 
            $teacher->update(['path_to_document' => $filepath . '/' . $filename]); 
        }

        $teacher->update([
            'subject'  => $request->subject, 
            'price'    => $request->price
        ]);

        return back()
                ->with('success', 'Данные успешно обновлены'); 
    }
}
