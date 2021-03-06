@extends('layouts.app')

@section('styles')
        <!-- 1. Link to jQuery (1.8 or later), -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> <!-- 33 KB -->

<!-- fotorama.css & fotorama.js. -->
<link  href="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet"> <!-- 3 KB -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script> <!-- 16 KB -->

@endsection

@section('content')
    <div class="container">

        @if ($advert->images)
            <div class="row">
                <div class="col-sm-12">
                    <div class="fotorama">
                        @foreach($advert->images as $image)
                            @if (!$image->thumb)
                                <img src="{{ \Illuminate\Support\Facades\Storage::url($image->url) }}">
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <p>
            {{ $advert->text }}
        </p>

        <table class="table table-bordered">
            @foreach($advert->filters as $filter)
                <tr>
                    <td width="1" style="white-space: nowrap">{{ ucfirst($filter->filter->name) }}</td>
                    <td>{{ $filter->value }}</td>
                </tr>
            @endforeach
        </table>

        <div class="row">
            <div class="col-sm-12">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(Session::has('error_message'))
                    <div class="alert alert-danger">{!! session('error_message') !!}</div>
                @endif
                @if(Session::has('success_message'))
                    <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('success_message') !!}</em></div>
                @else
                    <form role="form" method="post" action="{{ route('advert.message', $advert->id) }}" id="contact-form" class="contact-form">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="{{ old('name') }}" name="name" id="name" placeholder="{{ __('forms.name') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" class="form-control" value="{{ old('email') }}" name="email" id="email" placeholder="{{ __('forms.email') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" rows="8" name="message" id="message" placeholder="{{ __('forms.message') }}">{{ old('message') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success pull-right">{{ __('forms.send_message') }}</button>
                                </div>
                            </div>
                    </form>
                @endif
            </div>
        </div>

    </div>

@endsection

@section('scripts')

@endsection
