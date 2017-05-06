@extends('layouts.app')

@section('content')
<div class="container">
    <form enctype="multipart/form-data" action="{{ route('advert.store') }}" method="post">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="parent_id">Category</label>

                    <select class="form-control" name="category_id" id="category_id">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <label for="text">Text</label>
                <textarea class="form-control" name="text" id="text" cols="30" rows="10"></textarea>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="images">Images</label>
                    <input class="form-control" type="file" id="images" name="images" multiple>
                </div>
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
