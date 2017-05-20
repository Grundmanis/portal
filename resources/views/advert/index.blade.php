@extends('layouts.app')

@section('content')
<div class="container">
    @if($adverts->count())
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
                <td>
                    @if($user->can('delete',$advert))
                        <form onsubmit="return confirm('Are you sure?')" action="{{ route('advert.destroy', $advert->id) }}" method="get">
                            {{ $advert->id }}
                            <input class="btn btn-small btn-danger" type="submit" value="Delete">
                        </form>
                    @endif
                </td>
                @foreach($filters as $id => $filter)
                    <td>
                        @if (isset($advert->filters->keyBy('filter_id')[$filter->id]) && $advertFilter = $advert->filters->keyBy('filter_id')[$filter->id])
                            @if ($filter->id == \App\AdvertFilter::IMAGE_ID)
                                <img src="{{url($advertFilter->value)}}" alt="">
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
    @else
        <p>No adverts in this category</p>
    @endif
</div>
@endsection

@section('scripts')
@endsection
