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
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($adverts as $advert)
            <tr>
                <td>{{ $advert->id }} @if($user->can('delete', $advert)) <a href="#">delete</a> @endif</td>
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
                <td>
                    @can('delete', $advert)
                        <a href="#">x advert</a>
                    @endcan
                    @can('delete-advert', $advert)
                        <a href="#">|| x advert</a>
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
@endsection
