    @extends('layouts.app')
    @section('custom-styles')
        <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    @endsection
    @section('content')
    <div class="container pt-4">
        <div class="row justify-content-center">
            <div class="col-md-8 pt-4">
                <div class="card">
                    <div class="card-header">Подтвердите вашу почту</div>

                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                Проверьте вашу почту
                            </div>
                        @endif

                        Проверьте вашу почту
                        Если вы не получили сообщение,
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Нажмите сюда, чтобы запросить новое сообщение</button>.
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
