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
                    <td>
                        @if (isset($advert->filters->keyBy('filter_id')[$filter->id]) && $advertFilter = $advert->filters->keyBy('filter_id')[$filter->id])
                            @if ($filter->id == \App\AdvertFilter::IMAGE_ID)
                                <img src="/{{ $advertFilter->value }}" alt="">
                            @else
                                {{ $advertFilter->value }}
                            @endif
                        @endif
                    </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
@endsection
