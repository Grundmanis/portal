@extends('layouts.app')

@section('content')
<div class="container">

    <categories
        categories="{{$categories}}"
        adverts_route="{{route('adverts')}}"
    >
    </categories>

</div>
@endsection

@section('scripts')
@endsection
