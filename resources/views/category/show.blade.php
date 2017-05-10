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
                @foreach($filters as $id => $filter)
                    @if ($advert->filters->where('filter_id',$filter->id)->first())
                        <td>
                            @if ($filter->id == \App\AdvertFilter::IMAGE_ID)
                                <img src="{{ $advert->filters->where('filter_id',$filter->id)->first()->value }}" alt="">
                            @else
                                {{ $advert->filters->where('filter_id',$filter->id)->first()->value }}
                            @endif
                        </td>
                    @else
                        <td></td>
                    @endif
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
@endsection
