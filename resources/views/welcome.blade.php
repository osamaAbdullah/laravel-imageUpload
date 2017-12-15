<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>image upload</title>

        <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
        <script src="{{asset('js/app.js')}}"></script>

    </head>
    <body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h1>Image Upload</h1>
                <hr>
                <form method="post" enctype="multipart/form-data" action="{{route('saveImage')}}">
                    <input type="hidden" name="_token" value="{{Session::token()}}">
                    <label>Image</label>
                    <input type="file" name="image" >
                    <br>
                    <button class="btn btn-primary btn-block">Save</button>
                </form>
            </div>
        </div>
    </div>
    </body>
</html>
