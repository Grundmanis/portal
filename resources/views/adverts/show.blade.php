@extends('layouts.app')

@section('content')
    <div class="container">

        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li><a href="/">{{ $category->translation->name }}</a></li>
            <li><a href="{{ route('adverts',[$category->slug,$subcategory->slug]) }}/">{{ $subcategory->translation->name }}</a></li>
        </ol>

        <div class="row text-center">
            <div class="col-sm-12">
                <div class="">
                    <img class="slide" src="https://www.w3schools.com/w3css/img_fjords_wide.jpg" style="width:100%">
                    <img class="slide" src="https://www.w3schools.com/w3css/img_nature_wide.jpg" style="width:100%">
                    <img class="slide" src="https://www.w3schools.com/w3css/img_mountains_wide.jpg" style="width:100%">
                </div>
            </div>
            <div class="col-sm-12">
                <div class="">
                    <button class="btn btn-primary" onclick="plusDivs(-1)">❮ Prev</button>
                    <button class="btn btn-primary" onclick="plusDivs(1)">Next ❯</button>
                </div>
            </div>
            <div class="col-sm-12">
                <button class="btn btn-primary dots" onclick="currentDiv(1)">1</button>
                <button class="btn btn-primary dots" onclick="currentDiv(2)">2</button>
                <button class="btn btn-primary dots" onclick="currentDiv(3)">3</button>
            </div>
        </div>

        <p>
          {{ $advert->text }}
        </p>

        <div class="row">
            <div class="col-sm-4">
                <table class="table table-bordered">
                    <tr>
                        <td>Phone:</td>
                        <td>+371 20066404</td>
                    </tr>
                    <tr>
                        <td>Second Phone:</td>
                        <td>+371 26044610</td>
                    </tr>
                    <tr>
                        <td>WEB:</td>
                        <td><a href="#">WWW</a></td>
                    </tr>
                    <tr>
                        <td>Place:</td>
                        <td><a href="#">Latvia, Riga</a></td>
                    </tr>
                    <tr>
                        <td>Address:</td>
                        <td><a href="#">Bultu iela 4</a></td>
                    </tr>
                    <tr>
                        <td>E-mail:</td>
                        <td><a href="#">***st@webchill.lv</a></td>
                    </tr>
                </table>
            </div>
            <div class="col-sm-8">
                <form role="form" id="contact-form" class="contact-form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="Name" autocomplete="off" id="Name" placeholder="Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" autocomplete="off" id="email" placeholder="E-mail">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea class="form-control textarea" rows="8" name="Message" id="Message" placeholder="Message"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success pull-right">Send a message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

@endsection

@section('scripts')
    <script>
        var slideIndex = 1;
        showDivs(slideIndex);

        function plusDivs(n) {
            showDivs(slideIndex += n);
        }

        function currentDiv(n) {
            showDivs(slideIndex = n);
        }

        function showDivs(n) {
            var i;
            var x = document.getElementsByClassName("slide");
            var dots = document.getElementsByClassName("dots");
            if (n > x.length) {slideIndex = 1}
            if (n < 1) {slideIndex = x.length}
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" btn-danger", "");
            }
            x[slideIndex-1].style.display = "block";
            dots[slideIndex-1].className += " btn-danger";
        }
    </script>
@endsection
