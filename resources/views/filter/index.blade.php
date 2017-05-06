@extends('layouts.app')

@section('content')
<div class="container">
    <form enctype="multipart/form-data" action="{{ route('filter.store') }}" method="post">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-sm-12">
                @foreach($filters as $filter)
                    <p>
                        {{$filter->category->name}}
                        {{$filter->parentCategory->name}}
                    </p>
                @endforeach
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
@endsection
