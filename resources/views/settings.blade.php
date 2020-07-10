@extends('layouts.app')
@section('custom-styles')
    <link href="{{ asset('css/settings.css') }}" rel="stylesheet">
    <script src="{{ URL::asset('js/settings.js') }}"></script>
@endsection
@section('content')
        <div class='container pl-5 pt-4 pr-4' id='container'>
            <div class='settings-header'>
                <h3 class='pl-5'>@lang('messages.settings')</h3>
            </div>
            <div class='settings-body pl-5 pt-4'>
                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        {!! \Session::get('success') !!}
                    </div>
                @endif                    
                @if ($errors ->any())
                    <div class="alert alert-danger" role="alert">
                        @foreach ($errors->all() as $error)
                            {{$error.' '}}
                        @endforeach
                    </div>
                @endif
                @if ($user->role->role == 'teacher')
                    @if($user->status->isApproved == "1")
                        <div class="alert alert alert-success" role="alert">
                            @lang('messages.verified')
                        </div>
                    @else
                        <div class="alert alert-danger" role="alert">
                            @lang('messages.not_verified')
                        </div>
                    @endif
                @endif
                <div class="form-row">
                    <div class="form-row">
                        <div class="form-group mx-sm-6 mb-2 pt-2 pl-4">
                            <label class='settings-label'>@lang('validation.attributes.first_name')</label>
                        </div>
                        <div class="form-group mx-sm-6 mb-2 pt-2 ml-4 pl-4">
                            <label class='user-data pl-2'>{{ $user->first_name }}</label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group mx-sm-6 mb-2 pt-2 pl-4">
                            <label class='settings-label'>@lang('validation.attributes.last_name')</label>
                        </div>
                        <div class="form-group mx-sm-6 mb-2 pt-2 ml-4 pl-4">
                            <label class='user-data pl-2'>{{ $user->last_name }}</label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group mx-sm-6 mb-2 pt-2 pl-4">
                            <label class='settings-label'>@lang('validation.attributes.patronymic')</label>
                        </div>
                        <div class="form-group mx-sm-6 mb-2 pt-2 ml-4 pl-4">
                            <label class='user-data pl-2'>{{ $user->patronymic }}</label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group mx-sm-6 mb-2 pt-2 pl-4">
                            <label class='settings-label'>@lang('validation.attributes.age')</label>
                        </div>
                        <div class="form-group mx-sm-6 mb-2 pt-2 ml-4 pl-4">
                            <label class='user-data pl-2'>{{ $user->age }}</label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group mx-sm-6 mb-2 pt-2 pl-4">
                            <label class='settings-label'>Skype</label>
                        </div>
                        <div class="form-group mx-sm-6 mb-2 pt-2 ml-4 pl-4">
                            <label class='user-data pl-2'>{{ $user->skype }}</label>
                        </div>
                    </div>
                    <div class="col-sm-10"  onclick="showForm(this.parentElement);">
                        <div class="form-group mx-sm-3 mb-2 pt-2 ml-4 ">
                            <label class=" settings-link my-2 my-sm-0" role="link">@lang('validation.attributes.change')</label>
                        </div>
                    </div>
                    <form class='hidden-form' method="POST" action="/user/update/{{$user->id}}">
                        @csrf
                        <div class='form-row'>
                            <div class="form-row">
                                <div class="form-group mx-sm-6 mb-2 pt-2 pl-4">
                                    <label class='settings-label'>@lang('validation.attributes.first_name')</label>
                                </div>
                                <div class="form-group mx-sm-6 mb-2 pt-2 ml-4 pl-4">
                                    <input type="text" name='first_name' required class="new-user-data" value = "{{ $user->first_name }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group mx-sm-6 mb-2 pt-2 pl-4">
                                    <label class='settings-label'>@lang('validation.attributes.last_name')</label>
                                </div>
                                <div class="form-group mx-sm-6 mb-2 pt-2 ml-4 pl-4">
                                    <input type="text" name='last_name' required class="new-user-data" value = "{{ $user->last_name }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group mx-sm-6 mb-2 pt-2 pl-4">
                                    <label class='settings-label'>@lang('validation.attributes.patronymic')</label>
                                </div>
                                <div class="form-group mx-sm-6 mb-2 pt-2 ml-4 pl-4">
                                    <input type="text" name='patronymic' class="new-user-data" value = "{{ $user->patronymic }}">
                                    <small class="text-muted">
                                        @lang('validation.attributes.optional_field')
                                    </small>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group mx-sm-6 mb-2 pt-2 pl-4">
                                    <label class='settings-label'>@lang('validation.attributes.age')</label>
                                </div>
                                <div class="form-group mx-sm-6 mb-2 pt-2 ml-4 pl-4">
                                    <input type="number" min ='15' name='age' required class="new-user-data" value = "{{ $user->age }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group mx-sm-6 mb-2 pt-2 pl-4">
                                    <label class='settings-label'>Skype</label>
                                </div>
                                <div class="form-group mx-sm-6 mb-2 pt-2 ml-4 pl-4">
                                    <input type="text" name='skype' class="new-user-data" value = "{{ $user->skype }}">
                                </div>
                            </div>
                        </div>
                        <div class='form-row mx-sm-2 mb-2 pt-2'>
                            <button class="submit-button" type="submit">@lang('validation.attributes.save')</button>
                        </div>
                    </form>
                </div>
                <div class ='line'></div>
                <div class="form-row">
                    <div class="form-row">
                        <div class="form-group mx-sm-6 mb-2 pt-2 pl-4">
                            <label class='settings-label'>@lang('validation.attributes.avatar')</label>
                        </div>
                        <div class="document form-group mx-sm-6 mb-2 pt-2 ml-4 pl-4">
                            <img src="{{ url($user->path_to_avatar) }}" class="img-thumbnail" alt="avatar">
                        </div>
                    </div>
                    <div class="col-sm-10"  onclick="showForm(this.parentElement);">
                        <div class="form-group mx-sm-3 mb-2 pt-2 ml-4">
                            <label class=" settings-link my-2 my-sm-0" role="link">@lang('validation.attributes.change')</label>
                        </div>
                    </div>
                    <form class='hidden-form' method="POST" action="/user/update/{{$user->id}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group mx-sm-6 mb-2 pt-2 pl-4">
                                <label class='settings-label'>@lang('validation.attributes.avatar')</label>
                            </div>
                            <div class="form-group mx-sm-6 mb-2 pt-2 ml-4 pl-4">
                                <input type="file" class="form-control-file" name='avatar'>
                            </div>
                        </div>
                        <div class='form-row mx-sm-2 mb-2 pt-2'>
                            <button class="submit-button" type="submit">@lang('validation.attributes.save')</button>
                        </div>
                    </form>
                </div>
                <div class ='line'></div>
                <div class="form-row">
                    <div class='form-row'>
                        <div class="form-group mx-sm-3 mb-2 pt-2">
                            <label class='settings-label'>@lang('validation.attributes.email')</label>
                        </div>
                    </div>
                    <div class="form-group mx-sm-3 mb-2 pt-2 ml-4 pl-4">
                        <label class='user-data pl-3'>{{ $user->email }}</label>
                    </div>
                    <div class="form-group mx-sm-3 mb-2 pt-2 ml-4 pl-5" onclick="showForm(this.parentElement);">
                        <label class="settings-link my-2 my-sm-0" role="link">@lang('validation.attributes.change')</label>
                    </div>
                    <form class='hidden-form' method="POST" action="/user/update/{{$user->id}}">
                        @csrf
                        <div class='form-row'>
                            <div class="form-group mx-sm-3 mb-2 pt-2">
                                <label class='settings-label'>@lang('validation.attributes.email')</label>
                            </div>
                            <div class="form-group mx-sm-4 mb-2 pt-2 ml-4 pl-4">
                                <input type="email" name='email' required class="new-user-data" value = "{{ $user->email }}">
                            </div>
                        </div>
                        <div class='form-row mx-sm-2 mb-2 pt-2'>
                            <button class="submit-button" type="submit">@lang('validation.attributes.save')</button>
                        </div>
                    </form>
                </div>
                <div class ='line'></div> 
                <div class="form-row">
                    <div class="form-group mx-sm-3 mb-2 pt-2">
                        <label class='settings-label'>@lang('validation.attributes.password')</label>
                    </div>
                    <div class="form-group mx-sm-3 mb-2 pt-2 ml-4 pl-4">
                        <label class='user-data pl-3'>******</label>
                    </div>
                    <div class="form-group mx-sm-3 mb-2 pt-2 ml-4 pl-5" onclick="showForm(this.parentElement);">
                        <label class="settings-link my-2 my-sm-0" role="link">@lang('validation.attributes.change')</label>
                    </div>
                    <form class='hidden-form' method="POST" action="/user/update/{{$user->id}}">
                        @csrf
                        <div class='form-row'>
                            <div class="form-group mx-sm-3 mb-2 pt-2">
                                <label class='settings-label'>@lang('validation.attributes.old_password')</label>
                            </div>
                            <div class="form-group mx-sm-4 mb-2 pt-2 ml-4 pl-4">
                                <input type="password" name='password_old' class="new-user-data" required>
                            </div>
                        </div>
                        <div class='form-row'>
                            <div class="form-group mx-sm-3 mb-2 pt-2">
                                <label class='settings-label'>@lang('validation.attributes.new_password')</label>
                            </div>
                            <div class="form-group mx-sm-4 mb-2 pt-2 ml-4 pl-4">
                                <input type="password" name='password' class="new-user-data" required>
                            </div>
                        </div>
                        <div class='form-row'>
                            <div class="form-group mx-sm-3 mb-2 pt-2">
                                <label class='settings-label'>@lang('validation.attributes.repeat_password')</label>
                            </div>
                            <div class="form-group mx-sm-4 mb-2 pt-2 ml-4 pl-4">
                                <input type="password" name='password_confirmation' class="new-user-data" required>
                            </div>
                        </div>
                        <div class='form-row mx-sm-2 mb-2 pt-2'>
                            <button class="submit-button" type="submit">@lang('validation.attributes.save')</button>
                        </div>
                    </form>
                </div>
                <div class ='line'></div>
                @if ($user->role->role == 'teacher')
                    <h4>@lang('messages.teacher_settings')</h4>
                    <div class="form-row">
                        <div class="form-row">
                            <div class="form-group mx-sm-6 mb-2 pt-2 pl-4">
                                <label class='settings-label'>@lang('validation.attributes.subject')</label>
                            </div>
                            <div class="form-group mx-sm-6 mb-2 pt-2 ml-4 pl-4">
                                <label class='user-data pl-2'>{{ $user->getTeacherInfo->subject }}</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group mx-sm-6 mb-2 pt-2 pl-4">
                                <label class='settings-label'>@lang('validation.attributes.price')</label>
                            </div>
                            <div class="form-group mx-sm-6 mb-2 pt-2 ml-4 pl-4">
                                <label class='user-data pl-2'>{{ $user->getTeacherInfo->price }}</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group mx-sm-6 mb-2 pt-2 pl-4">
                                <label class='settings-label'>@lang('validation.attributes.document')</label>
                            </div>
                        @if (empty($user->getTeacherInfo->path_to_document))
                           <div class="form-group mx-sm-6 mb-2 pt-2 ml-4 pl-4">
                                <label class='settings-label'>@lang('messages.doc_message')</label>
                            </div>
                        @else
                            <div class="document form-group mx-sm-6 mb-2 pt-2 ml-4 pl-4" data-toggle="modal" data-target="#documentModal">
                                <img src="{{ url($user->getTeacherInfo->path_to_document) }}" class="img-thumbnail" alt="document-img">
                            </div>
                        @endif
                        </div>                       
                        <div class="col-sm-10" onclick="showForm(this.parentElement);">
                            <div class="form-group mx-sm-3 mb-2 pt-2 ml-4">
                                <label class=" settings-link my-2 my-sm-0" role="link">@lang('validation.attributes.change')</label>
                            </div>
                        </div>
                        <form class='hidden-form' method="POST" action="/teacher/update/{{ $user->id }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                            <div class='form-row'>
                                <div class="form-row">
                                    <div class="form-group mx-sm-6 mb-2 pt-2 pl-4">
                                        <label class='settings-label'>@lang('validation.attributes.subject')</label>
                                    </div>
                                    <div class="form-group mx-sm-6 mb-2 pt-2 ml-4 pl-4">
                                        <input type="text" name='subject' required class="new-user-data" value = "{{ $user->getTeacherInfo->subject }}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group mx-sm-6 mb-2 pt-2 pl-4">
                                        <label class='settings-label'>@lang('validation.attributes.price')</label>
                                    </div>
                                    <div class="form-group mx-sm-6 mb-2 pt-2 ml-4 pl-4">
                                        <input type="number" min='100' name='price' class="new-user-data" value = "{{ $user->getTeacherInfo->price }}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group mx-sm-6 mb-2 pt-2 pl-4">
                                        <label class='settings-label'>@lang('validation.attributes.document')</label>
                                    </div>
                                    <div class="form-group mx-sm-6 mb-2 pt-2 ml-4 pl-4">
                                        <input type="file" class="form-control-file" name='document'>
                                        <small class="text-muted">
                                            @lang('messages.document_desc')
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class='form-row mx-sm-2 mb-2 pt-2'>
                                <button class="submit-button" type="submit">@lang('validation.attributes.save')</button>
                            </div>
                        </form>
                    </div>
                    <div class ='line'></div>
                    @if($user->getLessonsForTeacher->isNotEmpty())
                        <h4>@lang('messages.students_block_title')</h4>
                        @if ($user->unreadNotifications->isNotEmpty())
                            <form method="POST" action="/lesson/markNotifications">
                                @csrf
                                <button class="btn btn-link">@lang('messages.mark_as_read')</button>
                            </form>
                        @endif 
                        <div id="accordion">
                            @foreach ($user->getLessonsForTeacher as $lesson)
                                <div class="card">
                                    <div class="card-header" id="headingThree">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree{{$lesson->id}}" aria-expanded="false" aria-controls="collapseThree">
                                                {{ $lesson->getStudent->first_name . ' ' . $lesson->getStudent->last_name}}
                                                @foreach($user->unreadNotifications as $notification)
                                                    @isset($notification->data['student_id'])
                                                        @if ($notification->data['student_id'] == $lesson->student_id)
                                                            <span class="badge badge-warning">!</span>
                                                        @endif
                                                    @endisset
                                                @endforeach
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseThree{{$lesson->id}}" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                        <div class="card-body">
                                            <h4>@lang('messages.contacts')</h4>                              
                                            <div class="form-row">
                                                <div class="form-group mx-sm-6 mb-2 pt-2 pl-4">
                                                    <label class='settings-label'>Skype</label>
                                                </div>
                                                <div class="form-group mx-sm-6 mb-2 pt-2 ml-4 pl-4">
                                                    <label class='user-data pl-2'>{{ $lesson->getStudent->skype }}</label>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group mx-sm-6 mb-2 pt-2 pl-4">
                                                    <label class='settings-label'>Email</label>
                                                </div>
                                                <div class="form-group mx-sm-6 mb-2 pt-2 ml-4 pl-4">
                                                    <label class='user-data pl-2'>{{ $lesson->getStudent->email }}</label>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group mx-sm-6 mb-2 pt-2 pl-4">
                                                    <label class='settings-label'>@lang('messages.message')</label>
                                                </div>
                                                <form method="POST" action="/lesson/update/{{$lesson->id}}">
                                                    @csrf
                                                    <div class="col-xs-12 mb-2 pt-2 ml-4 pl-4">
                                                        <input id='message' type="text" required class="new-user-data" placeholder="@lang('messages.message.desc')" name="message">
                                                    </div>
                                                    <div class='ml-5'>
                                                        <button class="submit-button" type="submit">@lang('messages.message.send')</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group mx-sm-6 mb-2 pt-2 pl-4">
                                                    <label class='settings-label'>@lang('messages.cancel_lesson')</label>
                                                </div>
                                                <div class="form-group mx-sm-6 mb-2 pt-2 ml-4 pl-4">
                                                    <form method="POST" action="/lesson/destroy/{{ $lesson->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">@lang('messages.cancel')</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <h4>@lang('messages.for_students')</h4>
                    @endif
                    <div class ='line'></div>
                @endif
                @if($user->getLessonsForStudent->isNotEmpty())
                    <h4>@lang('messages.teachers_block_title')</h4>
                    @if ($user->unreadNotifications->isNotEmpty())
                        <form method="POST" action="/lesson/markNotifications">
                            @csrf
                            <button class="btn btn-link">@lang('messages.mark_as_read')</button>
                        </form>
                    @endif           
                    <div id="accordion">                        
                        @foreach ($user->getLessonsForStudent as $lesson)
                            <div class="card">
                                <div class="card-header" id="headingThree">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree{{$lesson->id}}" aria-expanded="false" aria-controls="collapseThree">
                                        {{ $lesson->getTeacher->first_name . ' ' . $lesson->getTeacher->last_name}}
                                        @foreach($user->unreadNotifications as $notification)
                                            @isset($notification->data['teacher_id'])
                                                @if ($notification->data['teacher_id'] == $lesson->teacher_id)
                                                    <span class="badge badge-warning">1</span>
                                                @endif
                                            @endisset                                                
                                        @endforeach
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseThree{{$lesson->id}}" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                    <div class="card-body">
                                        <h4>@lang('messages.contacts')</h4>                              
                                        <div class="form-row">
                                            <div class="form-group mx-sm-6 mb-2 pt-2 pl-4">
                                                <label class='settings-label'>Skype</label>
                                            </div>
                                            <div class="form-group mx-sm-6 mb-2 pt-2 ml-4 pl-4">
                                                <label class='user-data pl-2'>{{ $lesson->getTeacher->skype }}</label>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group mx-sm-6 mb-2 pt-2 pl-4">
                                                <label class='settings-label'>Email</label>
                                            </div>
                                            <div class="form-group mx-sm-6 mb-2 pt-2 ml-4 pl-4">
                                                <label class='user-data pl-2'>{{ $lesson->getTeacher->email }}</label>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group mx-sm-6 mb-2 pt-2 pl-4">
                                                <label class='settings-label'>@lang('validation.attributes.subject')</label>
                                            </div>
                                            <div class="form-group mx-sm-6 mb-2 pt-2 ml-4 pl-4">
                                                <label class='user-data pl-2'>{{ $lesson->getTeacher->getTeacherInfo->subject }}</label>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group mx-sm-6 mb-2 pt-2 pl-4">
                                                <label class='settings-label'>@lang('validation.attributes.price')</label>
                                            </div>
                                            <div class="form-group mx-sm-6 mb-2 pt-2 ml-4 pl-4">
                                                <label class='user-data pl-2'>{{ $lesson->getTeacher->getTeacherInfo->price }}</label>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group mx-sm-6 mb-2 pt-2 pl-4">
                                                <label class='settings-label'>
                                                    @lang('messages.message_for_student')
                                                </label>
                                            </div>
                                            <div class="form-group mx-sm-6 mb-2 pt-2 ml-4 pl-4">
                                                <textarea class="form-control" rows="3" disabled>{{ $lesson->message }}
                                                </textarea>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group mx-sm-6 mb-2 pt-2 pl-4">
                                                <label class='settings-label'>@lang('messages.cancel_teach')</label>
                                            </div>
                                            <div class="form-group mx-sm-6 mb-2 pt-2 ml-4 pl-4">
                                                <form method="POST" action="/lesson/destroy/{{$lesson->id}}`">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">@lang('messages.cancel')</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>              
                        @endforeach                     
                    </div>  
                @else 
                    <h4>@lang('messages.for_teachers')</h4>
                @endif                  
                <div class ='line'></div>
                <div class='form-row'>
                    <div class="form-group mx-sm-3 mb-2 pt-2">
                        <label class='settings-label'>@lang('messages.delete_account')</label>
                    </div>
                </div>
                <div class='form-row pl-5'>
                    <label class='settings-label'>@lang('messages.delete_desc')</label>
                </div>
                <div class='form-row mx-sm-2 mb-2 pt-2 pb-4'>
                    <button class="submit-button" data-toggle="modal" data-target="#deleteModal">@lang('messages.delete')</button>
                </div>              
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('messages.delete_account')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @lang('messages.sure')
                </div>
                <form method='POST' action='/user/delete/{{$user->id}}'>
                    @csrf
                    @method('DELETE')
                    <div class="modal-footer">
                        <button type="submit" class="delete-button">@lang('messages.delete')</button>
                        <button type="button" class="close-button" data-dismiss="modal">@lang('messages.close')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade  bd-modal-lg" id="documentModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    @if (empty($user->getTeacherInfo->path_to_document))
                        -
                    @else
                        <img src="{{ url($user->getTeacherInfo->path_to_document) }}" class="img-fluid" alt="document-img">
                    @endif                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="close-button" data-dismiss="modal">@lang('messages.close')</button>
                </div>
            </div>
        </div>
    </div>
@endsection
