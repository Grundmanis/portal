@extends('layouts.app')

@section('content')
<div class="container">

    <categories
        category_list="{{$categories}}"
    >
    </categories>

</div>
@endsection

@section('scripts')
@endsection
