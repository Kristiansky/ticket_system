@extends('adminlte::page')

@section('title', __('main.record'))

@section('content_header')
    <h1>{{ __('main.record') }} #{{$record->id}}</h1>
    <h4 class="mt-3">{{ __('main.status') }} {!!$record->colorStatus()!!}</h4>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        @if(auth()->user()->hasRole('administrator'))
            <a href="{{route('records.edit', $record->id)}}" class="btn btn-primary float-left mb-2"><i class="fa fa-pencil-alt"></i> {{__('main.edit_record')}}</a>
        @elseif(auth()->user()->hasRole('manager'))
            <a href="{{route('records.fill', $record->id)}}" class="btn btn-primary float-left mb-2"><i class="fa fa-edit"></i> {{__('main.fill_record')}}</a>
        @elseif(auth()->user()->hasRole('dealer'))
            <a href="{{route('records.fill', $record->id)}}" class="btn btn-primary float-left mb-2"><i class="fa fa-edit"></i> {{__('main.fill_record')}}</a>
        @endif
    </div>
</div>
<div class="row">
    <div class="col-8">
        <div class="card">
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
    <div class="col-4">
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">{{__('main.information_from_dealer')}}</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <td>
                            {{__('main.dealer_info')}}
                        </td>
                        <td>
                            <strong>{{$record->dealer_info ? __('main.' . $record->dealer_info) : ''}}</strong>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{__('main.dealer_progress_status')}}
                        </td>
                        <td>
                            <strong>{{$record->dealer_progress_status ? __('main.' . $record->dealer_progress_status) : ''}}</strong>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{__('main.dealer_merchant')}}
                        </td>
                        <td>
                            <strong>{{$record->dealer_merchant}}</strong>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{__('main.dealer_comment')}}
                        </td>
                        <td>
                            <strong>{{$record->dealer_comment}}</strong>
                        </td>
                    </tr>
                </table>
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
