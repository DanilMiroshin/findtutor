<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\UserStatus;
use App\Models\UserRole;
use App\Models\Teacher;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name'    => ['required', 'string', 'max:255'],
            'last_name'     => ['required', 'string', 'max:255'],
            'patronymic'    => ['nullable', 'string', 'max:255'],
            'skype'         => ['nullable', 'string', 'max:255'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'age'           => ['required', 'numeric', 'max:255'],
            'subject'       => ['nullable', 'string', 'max:255'],
            'price'         => ['nullable', 'numeric'],
            'password'      => ['required', 'string', 'min:8', 'confirmed'],
            'role'          => ['required'],
            'avatar'        => ['image', 'mimes:jpeg,bmp,png,jpg', 'max:2048'],
            'document'      => ['mimes:jpeg,bmp,png,jpg', 'max:2048']
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'first_name'    => $data['first_name'],
            'last_name'     => $data['last_name'],
            'patronymic'    => $data['patronymic'],
            'age'           => $data['age'],
            'skype'         => $data['skype'],
            'email'         => $data['email'],
            'password'      => Hash::make($data['password']),
        ]);

        if ($data['role'] == 'teacher'){
            $teacher = Teacher::create([
                'user_id'   => $user->id,
                'subject'   => $data['subject'],
                'price'     => $data['price'],
            ]);
        }
        if (request()->hasFile('avatar')) {
            $filename = Str::random(10) . '.' . request()->avatar->extension();
            $filepath = 'imgs/uploads/' . $user->id . '/avatar' . $filename;            
            $file = Image::make(request()->avatar)
                        ->resize(250, 250)
                        ->encode('jpg');

            Storage::put($filepath, $file);                                
            $user->update(['path_to_avatar' => $filepath]);
        } else {
            $filepath = 'imgs/uploads/' . $user->id . '/avatar/user.png';
            Storage::copy('imgs/icons/user.png', $filepath);
            $user->update(['path_to_avatar' => $filepath]);
        }

        if (request()->hasFile('document')) {
            $filepath = 'imgs/uploads/' . $user->id . '/document';
            $filename = Str::random(20) . '.' . request()->document->extension();

            request()->document->storeAs($filepath, $filename);                  
            $teacher->update(['path_to_document' => $filepath . '/' . $filename]);
        }

        UserStatus::create([
            'user_id' => $user->id,
            'isBanned' => 0,
            'isApproved' => 0,
        ]);

        UserRole::create([
            'user_id' => $user->id,
            'isAdmin' => 0,
            'role' => $data['role'],
        ]);

        return $user;
    }
}
