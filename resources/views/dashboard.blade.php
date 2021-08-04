@extends('adminlte::page')

@section('title', __('main.dashboard'))

@section('content_header')
    <h1>{{__('main.dashboard')}}</h1>
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('main.dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('main.logged_in') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
@endsection

@section('js')
{{--    <script> console.log('Hi!'); </script>--}}
@stop
