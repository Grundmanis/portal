@extends('layouts.app')

@section('content')
<div class="container">
    <ul>
        @foreach($categories as $category)
            <li>
                <a href="{{ $route . $category->slug }}">{{ $category->name }}</a>
            </li>
        @endforeach
    </ul>
</div>
@endsection

@section('scripts')
@endsection
