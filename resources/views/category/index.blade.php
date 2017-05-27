@extends('layouts.app')

@section('content')
<div class="container">
    @include('category/filters')
    <ul>
        @foreach($categories as $category)
            @include('category/list')
        @endforeach
    </ul>
</div>
@endsection

@section('scripts')
@endsection
