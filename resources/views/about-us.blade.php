<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $page->title }}</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col">
            <img class="img-fluid" src="{{ asset('uploads/page_images') }}/{{ $page->page_image }}" alt="Page_Image">

            <div class="card">
                <h1 class="card-title">{{ $page->title }}</h1>
                <div class="card-body">
                    <div class="">
                        {!! $page->short_description !!}
                    </div>
                    <div class="">
                        {!! $page->long_description !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
