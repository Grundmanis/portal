@extends('layouts.app')

@section('content')
<div class="container">
    <ul>
        @foreach($categories as $category)
            @include('category/list')
        @endforeach
    </ul>
</div>
@endsection

@section('scripts')
@endsection
