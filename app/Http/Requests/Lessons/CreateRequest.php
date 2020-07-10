<?php

namespace App\Http\Requests\Lessons;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    protected $redirect = "/search";
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => [
                'bail',
                'required',
                'exists:users,id',
                function ($attribute, $id, $fail) {
                    if (User::find($id)->id == Auth::id()) {
                        $fail('Вы не можете записаться к самому себе');
                    }
                },
                function ($attribute, $id, $fail) {
                    if (User::find($id)->role->role != 'teacher') {
                        $fail($attribute.' не принадлежит преподавателю');
                    }
                },
                function ($attribute, $id, $fail) {
                    if (DB::table('lessons')->where([
                            ['teacher_id', '=', $id],
                            ['student_id', '=', Auth::id()],
                        ])->exists()){
                        $fail('Вы уже записаны к этому преподавателю');
                    }
                },
            ],
        ];
    }
}
