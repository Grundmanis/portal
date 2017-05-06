@extends('layouts.app')

@section('content')
<div class="container">
    <form enctype="multipart/form-data" action="{{ route('filter.store') }}" method="post">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="all_categories">
                        <input id="all_categories" type="checkbox" name="all_categories"> For all categories
                    </label>
                    <small class="help-block">Then no need to select categories below</small>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="category_parent_id">Category parent</label>
                    <select class="form-control" name="category_parent_id" id="category_parent_id">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select class="form-control" name="category_id" id="category_id">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="in_filters">
                        <input id="in_filters" type="checkbox" name="in_filters"> Showing in filters
                    </label>
                    <small class="help-block">On advert list page show these filters or not</small>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="type">Filter type</label>
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
            <div class="col-sm-12">
                @foreach(config('translatable.locales') as $lng => $key)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{ $lng }}</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input placeholder="name" class="form-control" type="text" id="name" name="name[{{$key}}]">
                            </div>
                            <div class="form-group">
                                <label for="value">Value</label>
                                <input placeholder="value" class="form-control" type="text" id="value" name="value[{{$key}}]">
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="form-group text-right">
                    <button class="btn btn-success">Create</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
@endsection
