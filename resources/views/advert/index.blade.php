@extends('layouts.app')

@section('content')
<div class="container">
    @if($adverts->count())
    <table class="table table-bordered">
        <thead>
            <tr>
                @foreach($filters as $filter)
                    <th>{{ $filter->name }}</th>
                @endforeach
                @if(Auth::user() && Auth::user()->isAdmin())
                    <th>
                        Delete
                    </th>
                @endif
            </tr>
        </thead>
        <tbody>
        @foreach($adverts as $advert)
            <tr>
                @foreach($filters as $id => $filter)
                    <td>
                        @if (isset($advert->filters->keyBy('filter_id')[$filter->id]) && $advertFilter = $advert->filters->keyBy('filter_id')[$filter->id])
                            @if ($filter->id == \App\AdvertFilter::IMAGE_ID)
                                <a href="{{ route('advert.show', $advert->id) }}">
                                    <img width="100" src="{{$advert->getFirstImage()}}" alt="">
                                </a>
                            @elseif ($filter->id == \App\AdvertFilter::TEXT_ID)
                                <a href="{{ route('advert.show', $advert->id) }}">
                                    {{ \Illuminate\Support\Str::limit($advert->getText(), 20) }}
                                </a>
                            @else
                                {{ $advertFilter->value }}
                            @endif
                        @endif
                    </td>
                @endforeach
                @if(Auth::user() && Auth::user()->isAdmin())
                    <td>
                        <form onsubmit="return confirm('Are you sure?')" action="{{ route('advert.destroy', $advert->id) }}" method="get">
                            <input class="btn btn-small btn-danger" type="submit" value="x">
                        </form>
                    </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $adverts->links() }}
    @else
        <p>No adverts in this category</p>
    @endif
</div>
@endsection

@section('scripts')
@endsection
