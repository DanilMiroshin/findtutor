@extends('layouts.app')
@section('custom-styles')
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <script src="{{ URL::asset('js/show-modal-image.js') }}"></script>
@endsection
@section('content')
    <div class="table-responsive p-4">
        <h1 class='display-4'>@lang('views.admin.title')</h1>
        <table class="table table-bordered table-striped table-hover datatable datatable-User">
            <thead>
                <tr class="thead-dark">
                    <th scope="col">id</th>
                    <th scope="col">@lang('validation.attributes.first_name')</th>
                    <th scope="col">@lang('validation.attributes.last_name')</th>
                    <th scope="col">@lang('validation.attributes.patronymic')</th>
                    <th scope="col">@lang('validation.attributes.role')</th>
                    <th scope="col">@lang('validation.attributes.subject')</th>
                    <th scope="col">@lang('validation.attributes.ban')</th>
                    <th scope="col">@lang('validation.attributes.app')</th>
                    <th scope="col">@lang('validation.attributes.avatar')</th>
                    <th scope="col">@lang('validation.attributes.document')</th>
                    <th scope="col">@lang('validation.attributes.act')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->last_name }}</td>
                        <td>{{ $user->patronymic }}</td>
                        <td>{{ $user->role->role }}</td>
                        @if (empty($user->getTeacherInfo))
                           <td>-</td>
                        @else
                            <td>{{ $user->getTeacherInfo->subject }}</td>
                        @endif                       
                        <td>{{ $user->status->isBanned == 0 ? '-' : '+'  }}</td>
                        <td>{{ $user->status->isApproved == 0 ? '-' : '+' }}</td>
                        <td>
                            <img src="{{ $user->path_to_avatar }}" class="img-thumbnail" alt="user-img">
                        </td>
                        @if (empty($user->getTeacherInfo->path_to_document))
                           <td>-</td>
                        @else
                            <td class='document-td' data-toggle="modal" data-target="#documentModal" data-image-src ='{{ $user->getTeacherInfo->path_to_document }}'>
                                <img src="{{ $user->getTeacherInfo->path_to_document }}" class="img-thumbnail" alt="document-img" style="height: 10%;">
                            </td>
                        @endif
                        <td>
                            <form method='POST' action='admin/approved/{{ $user->id }}'>
                                @csrf
                                @method('PATCH')
                                    <button type="submit" class="btn btn-link">@lang('views.admin.actions.confirm')</button>
                            </form>                      
                            <form method='POST' action='admin/block/{{ $user->id }}'>
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-link">@lang('views.admin.actions.block')</button>
                            </form>                
                            <form method='POST' action='admin/unApproved/{{ $user->id }}'>
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-link">@lang('views.admin.actions.un_conf')</button>
                           </form>                        
                            <form method='POST' action='admin/unBlock/{{ $user->id }}'>
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-link">@lang('views.admin.actions.un_block')</button>
                           </form>
                        </td>                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="modal fade  bd-modal-lg" id="documentModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <img id="document-image" class="img-fluid"/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="close-button" data-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
@endsection

