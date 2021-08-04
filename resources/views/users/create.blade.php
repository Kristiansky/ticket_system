@extends('adminlte::page')

@section('title', __('main.create_user'))

@section('content_header')
    <h1>{{ __('main.create_user') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12 col-xl-6">
            <form action="{{route('users.store')}}" method="post">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="name">Име <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Име" required>
                    @error('name')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email <span class="text-danger">*</span></label>
                    <input type="text" class="form-control  @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email" required>
                    @error('email')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Парола <span class="text-danger">*</span></label>
                    <input type="password" class="form-control  @error('password') is-invalid @enderror" id="password" name="password" required>
                    @error('password')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Потвърди паролата <span class="text-danger">*</span></label>
                    <input type="password" class="form-control  @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" required>
                    @error('password_confirmation')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Запази</button>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
@stop

{{--@section('plugins.Moment', true)--}}
{{--@section('plugins.Datetimepicker', true)--}}
{{--@section('plugins.Sweetalert2', true)--}}

@section('js')
    <script>
		$(document).ready(function () {
		});
    </script>
@stop
