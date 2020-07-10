@extends('layouts.app')
@section('custom-styles')
    <link href="{{ asset('css/register.css') }}" rel="stylesheet">
    <script src="{{ URL::asset('js/login.js') }}"></script>
@endsection
@section('content')
<div class="container pt-4 pb-4">
    <div class="row justify-content-center pt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Регистрация</div>
                <div class="card-body"> 
                    @if ($errors ->any())
                        <div class="alert alert-danger" role="alert">
                            @foreach ($errors->all() as $error)
                                {{$error.' '}}
                            @endforeach
                        </div>
                    @endif
                    <form id='teacher-form' method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Выберете кто вы?</label>
                            <div class="col-md-6 pt-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="role" value ='teacher' id="teacher-radio" onclick="showInput()" required>
                                    <label class="form-check-label">Я учитель</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="role" value ='student' id="user-radio" onclick="showInput()" required> 
                                    <label class="form-check-label">Я ученик</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Ваше имя</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="name" autofocus>
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Ваша фамилия</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required>

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Отчество</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('patronymic') is-invalid @enderror" name="patronymic" value="{{ old('patronymic') }}">
                                <small class="text-muted">
                                    Необязательное поле.
                                </small>
                                @error('patronymic')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">skype</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('skype') is-invalid @enderror" name="skype" value="{{ old('skype') }}">
                                <small class="text-muted">
                                    Необязательное поле.
                                </small>
                                @error('skype')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Ваш возраст</label>

                            <div class="col-md-6">
                                <input type="number" min ='15' class="form-control @error('age') is-invalid @enderror" name="age" value="{{ old('age') }}" required>
                                @error('age')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Почта</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Пароль</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Повторите пароль</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Выберите вашу фотографию</label>

                            <div class="col-md-6">
                                <input type="file" class="form-control-file pt-3" name='avatar'>
                            </div>
                        </div>
                        <div id='hidden-div'>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Предмет</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" value="{{ old('subject') }}">
                                    <small class="text-muted">
                                        Введите предметы, которые вы преподаете
                                    </small>
                                    @error('subject')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Прикрепите фотографию документа.</label>

                                <div class="col-md-6">
                                    <input type="file" class="form-control-file pt-3" name='document'>
                                    <small class="text-muted">
                                         Документ должен доказывать, что вы имеете образование преподавателя. Ваш аккаунт будет подтвержден после проверки администратором этого документа.
                                </small>
                                </div>
                                
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Цена за урок в рублях</label>

                                <div class="col-md-6">
                                    <input type="number" min='100' class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}">
                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Создать аккаунт
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
