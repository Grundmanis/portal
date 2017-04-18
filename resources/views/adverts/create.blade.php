@extends('layouts.app')

@section('content')
    <div class="container">

        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li class="active">Add new advert</li>
        </ol>

        <NewAdvert
            category_list="{{ json_encode($categories) }}"
        ></NewAdvert>

    </div>

@endsection

@section('scripts')
@endsection
