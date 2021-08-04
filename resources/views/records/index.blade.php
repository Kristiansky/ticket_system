@extends('adminlte::page')

@section('title', __('main.records'))

@section('content_header')
    <h1>{{ __('main.records') }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">{{__('main.filters')}}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <!-- form start -->
                    <form class="" action="{{route('records.index')}}" method="post">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-4 col-lg-1">
                                <div class="form-group">
                                    <label class="text-sm" for="client_name">{{__('main.client_name')}}</label>
                                    <input type="text" class="form-control form-control-sm" id="client_name" name="client_name" autocomplete="off" placeholder="{{__('main.client_name')}}" value="{{isset(session('records_filter')['client_name']) ? session('records_filter')['client_name'] : ''}}">
                                </div>
                            </div>
                            <div class="col-4 col-lg-1">
                                <div class="form-group">
                                    <label class="text-sm" for="web_form">{{__('main.web_form')}}</label>
                                    <select class="form-control form-control-sm" id="web_form" name="web_form">
                                        <option value="">{{ __('main.choose') }}</option>
                                        @foreach($web_forms_options as $web_forms_option)
                                            <option value="{{ $web_forms_option }}" @if(session('records_filter')['web_form'] == $web_forms_option) selected @endif>{{__('main.' . $web_forms_option)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-4 col-lg-1">
                                <div class="form-group">
                                    <label class="text-sm" for="dealer">{{__('main.dealer')}}</label>
                                    <select class="form-control form-control-sm" id="dealer" name="dealer">
                                        <option value="">{{ __('main.choose') }}</option>
                                        @foreach($dealers as $dealer)
                                            <option value="{{ $dealer->id }}" @if(session('records_filter')['dealer'] == $dealer->id) selected @endif>{{$dealer->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-4 col-lg-1">
                                <div class="form-group">
                                    <label class="text-sm" for="dealer_info">{{__('main.dealer_info_short')}}</label>
                                    <select class="form-control form-control-sm" id="dealer_info" name="dealer_info">
                                        <option value="">{{ __('main.choose') }}</option>
                                        @foreach($dealer_info_options as $dealer_info_option)
                                            <option value="{{ $dealer_info_option }}" @if(session('records_filter')['dealer_info'] == $dealer_info_option) selected @endif>{{__('main.' . $dealer_info_option)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-4 col-lg-1">
                                <div class="form-group">
                                    <label class="text-sm" for="status">{{__('main.status')}}</label>
                                    <select class="form-control form-control-sm" id="status" name="status">
                                        <option value="">{{ __('main.choose') }}</option>
                                        @foreach($status_options as $status_option)
                                            <option value="{{ $status_option }}" @if(session('records_filter')['status'] == $status_option) selected @endif>{{__('main.' . $status_option)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-4 col-lg-1">
                                <div class="form-group">
                                    <label class="text-sm" for="dealer_progress_status">{{__('main.dealer_progress_status')}}</label>
                                    <select class="form-control form-control-sm" id="dealer_progress_status" name="dealer_progress_status">
                                        <option value="">{{ __('main.choose') }}</option>
                                        @foreach($dealer_progress_status_options as $dealer_progress_status_option)
                                            <option value="{{ $dealer_progress_status_option }}" @if(session('records_filter')['dealer_progress_status'] == $dealer_progress_status_option) selected @endif>{{__('main.' . $dealer_progress_status_option)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-4 col-lg-3">
                                <div class="row">
                                    <div class="col-4 col-lg-6">
                                        <div class="form-group">
                                            <label class="text-sm" for="created_at_from">
                                                {{__('main.created_at_from')}}:
                                            </label>
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-sm" name="created_at_from" id="created_at_from" autocomplete="off" placeholder="{{__('main.created_at_from')}}" value="{{isset(session('records_filter')['created_at_from']) ? session('records_filter')['created_at_from'] : ''}}">
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 col-lg-6">
                                        <div class="form-group">
                                            <label class="text-sm" for="created_at_to">
                                                {{__('main.created_at_to')}}:
                                            </label>
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-sm" name="created_at_to" id="created_at_to" autocomplete="off" placeholder="{{__('main.created_at_to')}}" value="{{isset(session('records_filter')['created_at_to']) ? session('records_filter')['created_at_to'] : ''}}">
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-8 col-lg-2 pt-4 mt-2">
                                <button type="submit" name="filter" value="1" class="btn btn-primary btn-sm mr-2">{{__('main.filter')}}</button>
                                <button type="submit" name="reset" value="1" class="btn btn-default btn-sm mr-2">{{__('main.reset')}}</button>
                                <button type="submit" name="export" value="1" class="btn btn-warning btn-sm mr-2">{{__('main.export_xlsx')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            {{--{{__('main.showing_records', ['first_index' => $paginator->items()['from'], 'last_index' =>  $paginator->items()['to'], 'total_count' =>  $paginator->items()['total'] ])}}--}}
                            {{__('main.total_records')}}: {{ $records->total() }}
                        </div>
                        <div class="col-lg-4">
                            <div class="d-flex">
                                <div class="mx-auto">
                                    {{ $records->links() }}
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
                                <table class="table table-bordered table-sm table-striped table-hover text-sm" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th width="10%">{{__('main.client_name')}}</th>
                                        <th>{{__('main.client_email')}}</th>
                                        <th>{{__('main.web_form')}}</th>
                                        <th>{{__('main.dealer')}}</th>
                                        <th>{{__('main.dealer_info_short')}}</th>
                                        <th>{{__('main.dealer_merchant')}}</th>
                                        <th>{{__('main.status')}}</th>
                                        <th>{{__('main.dealer_progress_status')}}</th>
                                        <th width="7%">{{__('main.created_at')}}</th>
                                        <th width="7%">{{__('main.updated_at')}}</th>
                                        <th width="10%">{{__('main.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    </tfoot>
                                    <tbody>
                                    @foreach($records as $record)
                                        <tr>
                                            <td>{{$record->id}}</td>
                                            <td><a href="{{route('records.show', $record->id)}}">{{$record->client_name}}</a></td>
                                            <td>{{$record->client_email}}</td>
                                            <td>{{$record->web_form ? __('main.' . $record->web_form) : ''}}</td>
                                            <td>{{$record->dealer->name}}</td>
                                            <td>{{$record->dealer_info ? __('main.' . $record->dealer_info) : ''}}</td>
                                            <td>{{$record->dealer_merchant}}</td>
                                            <td>{!!$record->colorStatus()!!}</td>
                                            <td>{{$record->dealer_progress_status ? __('main.' . $record->dealer_progress_status) : ''}}</td>
                                            <td>{{$record->created_at}}</td>
                                            <td>{{$record->updated_at}}</td>
                                            <td>
                                                @if(auth()->user()->hasRole('administrator'))
                                                    <a href="{{route('records.show', $record->id)}}" class="btn btn-success btn-sm float-left mr-2"><i class="fa fa-eye"></i></a>
                                                    <a href="{{route('records.edit', $record->id)}}" class="btn btn-primary btn-sm float-left mr-2"><i class="fa fa-pencil-alt"></i></a>
                                                    <form method="post" action="{{route('records.destroy', $record->id)}}" class="float-left">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fa fa-trash-alt"></i></button>
                                                    </form>
                                                @elseif(auth()->user()->hasRole('manager'))
                                                    <a href="{{route('records.show', $record->id)}}" class="btn btn-success btn-sm float-left mr-2"><i class="fa fa-eye"></i></a>
                                                    <a href="{{route('records.fill', $record->id)}}" class="btn btn-primary btn-sm float-left mr-2"><i class="fa fa-edit"></i></a>
                                                @elseif(auth()->user()->hasRole('dealer'))
                                                    <a href="{{route('records.show', $record->id)}}" class="btn btn-success btn-sm float-left mr-2"><i class="fa fa-eye"></i></a>
                                                    <a href="{{route('records.fill', $record->id)}}" class="btn btn-primary btn-sm float-left mr-2"><i class="fa fa-edit"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex">
                                <div class="mx-auto">
                                    {{$records->links()}}
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

@section('plugins.Moment', true)
@section('plugins.Datetimepicker', true)
{{--@section('plugins.Sweetalert2', true)--}}

@section('js')
    <script>
		$(document).ready(function () {
			$('#created_at_from, #created_at_to').datetimepicker({
				format: 'YYYY-MM-DD',
				icons:
					{
						previous: 'fas fa-angle-left',
						next: 'fas fa-angle-right',
						up: 'fas fa-angle-up',
						down: 'fas fa-angle-down'
					}
			})
		});
    </script>
@stop

