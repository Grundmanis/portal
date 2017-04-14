@extends('layouts.app')

@section('content')
<div class="container">


    <!--div class="sub-categories">
        <div class="row">
            <div class="col-sm-9">

                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Work
                        </h3>
                    </div>
                    <div class="panel-body">
                        <ul class="subcategory-list">
                            <li>
                                <a href="#">Vacancies</a> (378)
                            </li>
                            <li>
                                <a href="#">Searching a job</a> (417)
                            </li>
                            <li>
                                <a href="#">Courses, education</a> (755)
                            </li>
                            <li>
                                <a href="#">Business contacts</a> (332)
                            </li>
                            <li>
                                <a href="#">Legal services</a> (112)
                            </li>
                            <li>
                                <a href="#">Financial services</a> (723)
                            </li>
                            <li>
                                <a href="#">Translations of texts</a> (351)
                            </li>
                            <li>
                                <a href="#">Internet services</a> (566)
                            </li>
                            <li>
                                <a href="#">Other</a> (58)
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="col-sm-3">
                <ul class="category-list">
                    <li>
                        <a class="btn btn-success active" href="#">Work</a>
                    </li>
                    <li>
                        <a class="btn btn-info" href="#">Transport</a>
                    </li>
                    <li>
                        <a class="btn btn-primary" href="#">Property</a>
                    </li>
                    <li>
                        <a class="btn btn-danger" href="#">Building</a>
                    </li>
                    <li>
                        <a class="btn btn-warning" href="#">Electrical Engineering</a>
                    </li>
                    <li>
                        <a class="btn btn-success" href="#">Clothes</a>
                    </li>
                    <li>
                        <a class="btn btn-info" href="#">For home</a>
                    </li>
                    <li>
                        <a class="btn btn-primary" href="#">For kids</a>
                    </li>
                    <li>
                        <a class="btn btn-danger" href="#">Animals</a>
                    </li>
                    <li>
                        <a class="btn btn-warning" href="#">Agriculture</a>
                    </li>
                    <li>
                        <a class="btn btn-success" href="#">Leisure, hobbies</a>
                    </li>
                </ul>
            </div>
        </div>
    </div-->

    <div class="button-group text-center">
        @foreach($categories as $category)
            @if (!$category->parent_id)
            <button onclick="location.href= '{{ route('adverts') }}'" class="btn btn-{{ $category->color ? $category->color : 'danger' }} category-title">
                {{ $category->translation->keyBy('lng')['en']->name }}
            </button>
            @endif
        @endforeach
    </div>

</div>
@endsection

@section('scripts')

@endsection
