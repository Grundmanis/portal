@extends('layouts.app')

@section('content')
<div class="container">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>id</th>
                <th>text</th>
            </tr>
        </thead>
        <tbody>

        @foreach($adverts as $advert)
            <tr>
                <td>{{ $advert->id }}</td>
                <td>text</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
@endsection
