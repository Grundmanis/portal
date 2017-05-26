@extends('layouts.app')

@section('content')
<div class="container">
    <form enctype="multipart/form-data" action="{{ route('filter.store') }}" method="post">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="in_adverts_list">
                        <input id="in_adverts_list" type="checkbox" name="in_adverts_list"> {{ __('forms.show_in_table') }}
                    </label>
                    <small class="help-block">{{ __('forms.show_in_table_description') }}</small>
                </div>
                <div class="form-group">
                    <label for="in_filters">
                        <input id="in_filters" type="checkbox" name="in_filters"> {{ __('forms.show_in_filters') }}
                    </label>
                    <small class="help-block">{{ __('forms.show_in_filters_description') }}</small>
                </div>
                <div class="form-group">
                    <label for="in_all_categories">
                        <input id="in_all_categories" type="checkbox" name="in_all_categories"> {{ __('forms.for_all_categories') }}
                    </label>
                    <small class="help-block">{{ __('forms.for_all_categories_description') }}</small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="category_parent_id">{{ __('forms.parent_category') }}</label>
                    <select class="form-control" name="category_parent_id" id="category_parent_id">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="category_id">{{ __('forms.category') }}</label>
                    <select class="form-control" name="category_id" id="category_id">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="type">{{ __('forms.filter_type') }}</label>
                    <select class="form-control" name="type" id="type">
                        <option value="select">Select</option>
                        <option value="check">Check box</option>
                        <option value="radio">Radio box</option>
                        <option value="input">Input</option>
                        <option value="images">Images</option>
                        <option value="textarea">Textarea</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="key">{{ __('forms.key') }}</label>
                    <input placeholder="{{ __('forms.unique_key') }}" class="form-control" type="text" id="key" name="key">
                </div>
            </div>
            <div class="col-sm-12">
                @foreach(config('translatable.locales') as $lng => $key)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{ $lng }}</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="name">{{ __('forms.name') }}</label>
                                <input placeholder="name" class="form-control" type="text" id="name" name="{{$key}}[name]">
                            </div>
                            <div class="form-group">
                                <label for="value">{{ __('forms.value') }}</label>
                                <input placeholder="value" class="form-control" type="text" id="value" name="{{$key}}[value]">
                            </div>
                        </div>
                    </div>
                @endforeach
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
