@extends('layouts.app')

@section('content')
<div class="container">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>id</th>
                @foreach($filters as $filter)
                    <th>{{ $filter->name }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
        @foreach($adverts as $advert)
            <tr>
                <td>{{ $advert->id }}</td>
                @foreach($filters as $filter)
                    <td>{{ $advert->filters->where('filter_id',$filter->id)->first()->value }}</td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
@endsection
