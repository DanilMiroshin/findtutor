<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Teacher;

use App\Http\Requests\UpdateUserRequest;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user)
    {
        return view('settings' , compact('user'));
    }

    public function update(User $user, UpdateUserRequest $request)
    {      
        if ($request->has('password')){
            $user->update(['password' => Hash::make($request->password)]);
            return back()
                ->with('success', 'Пароль был изменён'); 
        } 

        if (request()->hasFile('avatar')) {
            Storage::delete($user->path_to_avatar);

            $file = Image::make(request()->avatar)
                    ->resize(250, 250)
                    ->encode('jpg');
            $filename = Str::random(10) . '.' . request()->avatar->extension();
            $filepath = 'imgs/uploads/' . $user->id . '/avatar/' . $filename;

            Storage::put($filepath, $file);            
            $user->update(['path_to_avatar' => $filepath]);

            return back()
                ->with('success', 'Аватар был изменён'); 
        }

        $user->update($request->all());
              
        return back()
                ->with('success', 'Данные успешно обновлены'); 
    }

    public function destroy(User $user)
    {                                 
        $user->forceDelete();
        return redirect('/'); 
    }
}
