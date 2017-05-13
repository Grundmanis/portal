@extends('layouts.app')

@section('content')
<div class="container">
    <ul>
        @foreach($categories as $category)
            @if ($category->parents->isEmpty())
                @include('category.list')
            @endif
        @endforeach
    </ul>
</div>
@endsection

@section('scripts')
@endsection
