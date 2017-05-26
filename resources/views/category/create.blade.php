@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('category.store') }}" method="post">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-sm-6">
                @foreach(config('translatable.locales') as $lng => $key)
                    <div class="form-group">
                        <label for="text">{{ $lng }} {{ __('forms.name') }}</label>
                        <input placeholder="{{ $key }}" class="form-control" type="text" id="name" name="name[{{$key}}]">
                    </div>
                @endforeach
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="slug">{{ __('forms.slug') }}</label>
                    <input placeholder="{{ __('forms.slug_description') }}" class="form-control" type="text" id="slug" name="slug">
                </div>
                <div class="form-group">
                    <label for="parent_id">{{ __('forms.parent_categories') }}</label>
                    <select class="form-control" name="parent_id[]" multiple id="parent_id">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group text-right">
                    <button class="btn btn-success">{{ __('forms.create') }}</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
@endsection
