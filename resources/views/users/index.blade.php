@extends('adminlte::page')

@section('title', __('main.users'))

@section('content_header')
    <h1>{{ __('main.users') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            {{--{{__('main.showing_records', ['first_index' => $paginator->items()['from'], 'last_index' =>  $paginator->items()['to'], 'total_count' =>  $paginator->items()['total'] ])}}--}}
                            {{__('main.total_records')}}: {{ $users->total() }}
                        </div>
                        <div class="col-lg-4">
                            <div class="d-flex">
                                <div class="mx-auto">
                                    {{ $users->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            @if(session('message'))
                                <div class="alert alert-warning">{{session('message')}}</div>
                            @endif
                            <hr/>
                            <!-- DataTales Example -->
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Име</th>
                                        <th>Email</th>
                                        <th>Създадено</th>
                                        <th>Редактирано</th>
                                        <th>Роля</th>
                                        <th>Действия</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Име</th>
                                        <th>Email</th>
                                        <th>Създадено</th>
                                        <th>Редактирано</th>
                                        <th>Роля</th>
                                        <th>Действия</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{$user->id}}</td>
                                            <td><a href="{{route('users.show', $user)}}">{{$user->name}}</a></td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->created_at->diffForHumans()}}</td>
                                            <td>{{$user->updated_at->diffForHumans()}}</td>
                                            <td>@foreach($user->roles as $role) {{$role->name}} @endforeach</td>
                                            <td>
                                                {{--<a href="{{route('admin.calls.edit', $call->id)}}" class="btn btn-primary btn-sm float-left mr-2"><i class="fa fa-pencil-alt"></i></a>--}}
                                                <form method="post" action="{{route('users.destroy', $user->id)}}" class="float-left">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Сигурни ли сте че искате да изтриете потребителя?')"><i class="fa fa-trash-alt"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex">
                                <div class="mx-auto">
                                    {{$users->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

