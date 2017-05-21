@extends('layouts.app')

@section('content')
    <div class="container">

        <img src="{{ url($advert->getImage()) }}" alt="">

        <p>
            {{ $advert->getText() }}
        </p>

        <table class="table table-bordered">
            @foreach($advert->filters as $filter)
                @if (!$filter->filter->in_all_categories)
                    <tr>
                        <td width="1" style="white-space: nowrap">{{ $filter->filter->name }}</td>
                        <td>{{ $filter->value }}</td>
                    </tr>
                @endif
            @endforeach
        </table>

        <div class="row">
            <div class="col-sm-4">
                <table class="table table-bordered">
                    <tr>
                        <td>Phone:</td>
                        <td>+371 20066404</td>
                    </tr>
                    <tr>
                        <td>Second Phone:</td>
                        <td>+371 26044610</td>
                    </tr>
                    <tr>
                        <td>WEB:</td>
                        <td><a href="#">WWW</a></td>
                    </tr>
                    <tr>
                        <td>Place:</td>
                        <td><a href="#">Latvia, Riga</a></td>
                    </tr>
                    <tr>
                        <td>Address:</td>
                        <td><a href="#">Bultu iela 4</a></td>
                    </tr>
                    <tr>
                        <td>E-mail:</td>
                        <td><a href="#">***st@webchill.lv</a></td>
                    </tr>
                </table>
            </div>
            <div class="col-sm-8">
                <form role="form" id="contact-form" class="contact-form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="Name" autocomplete="off" id="Name" placeholder="Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" autocomplete="off" id="email" placeholder="E-mail">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea class="form-control textarea" rows="8" name="Message" id="Message" placeholder="Message"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success pull-right">Send a message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

@endsection

@section('scripts')
@endsection
