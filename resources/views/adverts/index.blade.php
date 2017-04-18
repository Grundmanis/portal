@extends('layouts.app')

@section('content')
    <div class="container">

        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li><a href="/">{{ $category->translation->name }}</a></li>
            <li class="active">{{ $subcategory->translation->name }}</li>
        </ol>


        <adverts
                category_list="{{ json_encode($category) }}"
                subcategory_list="{{ json_encode($subcategory) }}"
                advert_list="{{ json_encode($adverts) }}"
        ></adverts>

    </div>

@endsection
