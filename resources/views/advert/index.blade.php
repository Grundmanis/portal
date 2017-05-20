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
                                <a href="">
                                    <img src="{{url($advertFilter->value)}}" alt="">
                                </a>
                            @elseif ($filter->id == \App\AdvertFilter::TEXT_ID)
                                <a href="">
                                    {{ \Illuminate\Support\Str::limit($advertFilter->value, 20) }}
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
    @else
        <p>No adverts in this category</p>
    @endif
</div>
@endsection

@section('scripts')
@endsection
