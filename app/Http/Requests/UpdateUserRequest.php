<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\MatchOldPassword;

class UpdateUserRequest extends FormRequest
{
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
            'first_name'    => ['string', 'max:255'],
            'last_name'     => ['string', 'max:255'],
            'patronymic'    => ['nullable', 'string', 'max:255'],
            'age'           => ['numeric', 'max:120' ,'min:15'],
            'skype'         => ['nullable', 'string', 'max:255'],
            'email'         => ['string', 'email', 'max:255', 'unique:users'],
            'password'      => ['string', 'min:8', 'confirmed'],
            'password_old'  => ['string', new MatchOldPassword],
            'avatar'        => ['image', 'mimes:jpeg,bmp,png,jpg', 'max:2048'],
        ];
    }
}
