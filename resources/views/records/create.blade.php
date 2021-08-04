@extends('adminlte::page')

@section('title', __('main.create'))

@section('content_header')
    <h1>{{ __('main.create') }}</h1>
@stop

@section('content')
    <form action="{{route('records.store')}}" method="post">
        <div class="row">
            <div class="col-12 col-lg-8">
                @csrf
                @method('POST')
                <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="dealer_id">{{__('main.dealer')}} <span class="text-danger">*</span></label>
                            <select class="form-control selectpicker @error('dealer_id') is-invalid @enderror " data-live-search="true" data-size="0" id="dealer_id" name="dealer_id" title="{{ __('main.choose') }}" required>
                                <option value="">{{ __('main.choose') }}</option>
                                @foreach($dealers as $dealer)
                                    <option value="{{$dealer->id}}">{{ $dealer->name }} [{{ $dealer->email }}]</option>
                                @endforeach
                            </select>
                            @error('dealer_id')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="client_name">{{__('main.client_name')}}</label>
                            <input type="text" class="form-control " id="client_name" name="client_name" placeholder="{{__('main.client_name')}}"/>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="client_phone">{{__('main.client_phone')}}</label>
                            <input type="text" class="form-control " id="client_phone" name="client_phone" placeholder="{{__('main.client_phone')}}"/>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="client_email">{{__('main.client_email')}}</label>
                            <input type="text" class="form-control " id="client_email" name="client_email" placeholder="{{__('main.client_email')}}"/>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="city">{{__('main.city')}}</label>
                            <input type="text" class="form-control " id="city" name="city" placeholder="{{__('main.city')}}"/>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="company">{{__('main.company')}}</label>
                            <input type="text" class="form-control " id="company" name="company" placeholder="{{__('main.company')}}"/>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="received_at">{{__('main.received_at')}}</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control datetimepicker" id="received_at" name="received_at" placeholder="{{__('main.received_at')}}" autocomplete="off">
                                        <div class="input-group-append">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="web_form">{{__('main.web_form')}}</label>
                                    <select class="form-control" id="web_form" name="web_form">
                                        <option value="">{{ __('main.choose') }}</option>
                                        @foreach($web_forms_options as $web_forms_option)
                                            <option value="{{$web_forms_option}}">{{__('main.' . $web_forms_option)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="contact_validation">{{__('main.contact_validation')}}</label>
                                    <select class="form-control" id="contact_validation" name="contact_validation">
                                        <option value="">{{ __('main.choose') }}</option>
                                        @foreach($contact_validation_options as $contact_validation_option)
                                            <option value="{{$contact_validation_option}}">{{__('main.' . $contact_validation_option)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="car">{{__('main.car')}}</label>
                                    <select class="form-control" id="car" name="car">
                                        <option value="">{{ __('main.choose') }}</option>
                                        @foreach($cars_options as $cars_option)
                                            <option value="{{$cars_option}}">{{__('main.' . $cars_option)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="content">{{__('main.content')}}</label>
                            <textarea class="form-control " id="content" name="content" rows="5" ></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="approved_gdpr_messages" id="approved_gdpr_messages" value="1">
                                <label for="approved_gdpr_messages" class="custom-control-label">{{__('main.approved_gdpr_messages')}}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="approved_gdpr_marketing" id="approved_gdpr_marketing" value="1">
                                <label for="approved_gdpr_marketing" class="custom-control-label">{{__('main.approved_gdpr_marketing')}}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="approved_gdpr_no" id="approved_gdpr_no" value="1">
                                <label for="approved_gdpr_no" class="custom-control-label">{{__('main.approved_gdpr_no')}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="operator_comment">{{__('main.operator_comment')}}</label>
                            <textarea class="form-control " id="operator_comment" name="operator_comment" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <input type="submit" value="{{__('main.save')}}" class="btn btn-primary">
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="dealer_info" class="text-secondary">{{__('main.dealer_info')}}</label>
                            <select class="form-control" id="dealer_info" name="dealer_info" disabled>
                                <option value="">{{ __('main.choose') }}</option>
                                @foreach($dealer_info_options as $dealer_info_option)
                                    <option value="{{$dealer_info_option}}">{{__('main.' . $dealer_info_option)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="dealer_progress_status" class="text-secondary">{{__('main.dealer_progress_status')}}</label>
                            <select class="form-control" id="dealer_progress_status" name="dealer_progress_status" disabled>
                                <option value="">{{ __('main.choose') }}</option>
                                @foreach($dealer_progress_status_options as $dealer_progress_status_option)
                                    <option value="{{$dealer_progress_status_option}}">{{__('main.' . $dealer_progress_status_option)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="dealer_merchant" class="text-secondary">{{__('main.dealer_merchant')}}</label>
                            <input type="text" class="form-control " id="dealer_merchant" name="dealer_merchant" placeholder="{{__('main.dealer_merchant')}}" disabled/>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="dealer_comment" class="text-secondary">{{__('main.dealer_comment')}}</label>
                            <input type="text" class="form-control " id="dealer_comment" name="dealer_comment" placeholder="{{__('main.dealer_comment')}}" disabled/>
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
