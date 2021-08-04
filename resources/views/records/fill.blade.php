@extends('adminlte::page')

@section('title', __('main.fill_record'))

@section('content_header')
    <h1>{{ __('main.fill_record') }} #{{$record->id}}</h1>
@stop

@section('content')
    <form action="{{route('records.update', $record)}}" method="post">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-12 col-lg-4">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="status">{{__('main.status')}} <span class="text-danger">*</span></label>
                            <select class="form-control @error('status') is-invalid @enderror " id="status" name="status" required>
                                <option value="">{{ __('main.choose') }}</option>
                                @foreach($status_options_fill as $status_option_fill)
                                    <option value="{{$status_option_fill}}" {{$status_option_fill == $record->status ? 'selected' : ''}}>{{__('main.' . $status_option_fill)}}</option>
                                @endforeach
                            </select>
                            @error('status')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="dealer_info">{{__('main.dealer_info')}}</label>
                            <select class="form-control" id="dealer_info" name="dealer_info">
                                <option value="">{{ __('main.choose') }}</option>
                                @foreach($dealer_info_options as $dealer_info_option)
                                    <option value="{{$dealer_info_option}}" {{$dealer_info_option == $record->dealer_info ? 'selected' : ''}}>{{__('main.' . $dealer_info_option)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="dealer_progress_status">{{__('main.dealer_progress_status')}}</label>
                            <select class="form-control" id="dealer_progress_status" name="dealer_progress_status">
                                <option value="">{{ __('main.choose') }}</option>
                                @foreach($dealer_progress_status_options as $dealer_progress_status_option)
                                    <option value="{{$dealer_progress_status_option}}" {{$dealer_progress_status_option == $record->dealer_progress_status ? 'selected' : ''}}>{{__('main.' . $dealer_progress_status_option)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="dealer_merchant">{{__('main.dealer_merchant')}}</label>
                            <input type="text" class="form-control " id="dealer_merchant" name="dealer_merchant" placeholder="{{__('main.dealer_merchant')}}" value="{{$record->dealer_merchant}}"/>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="dealer_comment">{{__('main.dealer_comment')}}</label>
                            <input type="text" class="form-control " id="dealer_comment" name="dealer_comment" placeholder="{{__('main.dealer_comment')}}" value="{{$record->dealer_comment}}"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <input type="submit" name="fillForm" value="{{__('main.save')}}" class="btn btn-primary">
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">{{__('main.information')}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-7">
                                <table class="table table-striped">
                                    <tr>
                                        <td>
                                            {{__('main.client_email')}}
                                        </td>
                                        <td>
                                            <strong>{{$record->client_email}}</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{__('main.client_phone')}}
                                        </td>
                                        <td>
                                            <strong>{{$record->client_phone}}</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{__('main.city')}}
                                        </td>
                                        <td>
                                            <strong>{{$record->city}}</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{__('main.company')}}
                                        </td>
                                        <td>
                                            <strong>{{$record->company}}</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{__('main.received_at')}}
                                        </td>
                                        <td>
                                            <strong>{{$record->received_at}}</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{__('main.web_form')}}
                                        </td>
                                        <td>
                                            <strong>{{$record->web_form ? __('main.' . $record->web_form) : ''}}</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{__('main.contact_validation')}}
                                        </td>
                                        <td>
                                            <strong>{{$record->contact_validation ? __('main.' . $record->contact_validation) : ''}}</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{__('main.car')}}
                                        </td>
                                        <td>
                                            <strong>{{$record->car ? __('main.' . $record->car) : ''}}</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{__('main.approved_gdpr_messages')}}
                                        </td>
                                        <td>
                                            <strong>{{$record->approved_gdpr_messages ? __('main.yes') : __('main.no')}}</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{__('main.approved_gdpr_marketing')}}
                                        </td>
                                        <td>
                                            <strong>{{$record->approved_gdpr_marketing ? __('main.yes') : __('main.no')}}</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{__('main.approved_gdpr_no')}}
                                        </td>
                                        <td>
                                            <strong>{{$record->approved_gdpr_no ? __('main.yes') : __('main.no')}}</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{__('main.created_at')}}
                                        </td>
                                        <td>
                                            <strong>{{$record->created_at}}</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{__('main.updated_at')}}
                                        </td>
                                        <td>
                                            <strong>{{$record->updated_at}}</strong>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-lg-5">
                                <p>
                                    {{__('main.content')}}: <strong>{{$record->content}}</strong>
                                </p>
                                <p>
                                    {{__('main.operator_comment')}}: <strong>{{$record->operator_comment}}</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" integrity="sha512-f0tzWhCwVFS3WeYaofoLWkTP62ObhewQ1EZn65oSYDZUg1+CyywGKkWzm8BxaJj5HGKI72PnMH9jYyIFz+GH7g==" crossorigin="anonymous" />
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw==" crossorigin="anonymous"></script>
    <script>
		$(document).ready(function () {
			$('.datetimepicker').datetimepicker({
				format: 'Y-m-d H:i',
				dayOfWeekStart: 1
			});
		});
    </script>
@stop
