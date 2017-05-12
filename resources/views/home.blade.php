@extends('layouts.app')

@section('content')
<div class="container">
    <ul>
        @foreach($categories as $category)
            @if (count($category->child) && !count($category->parent))
                <li>
                    <a href="{{ route('category.index',['category' => $category->slug]) }}">{{ $category->name }}</a>
                    @if (count($category->child))
                        <ul>
                            @foreach($category->child as $child)
                                <li>
                                    <a href="{{ route('category.index',$category->slug . '/' . $child->slug) }}">{{ $child->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endif
        @endforeach
    </ul>
</div>
@endsection

@section('scripts')
@endsection
