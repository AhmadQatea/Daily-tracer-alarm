<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{env('APP_NAME','Daily sleep tracker')}}</title>

    
    <link rel="preconnect" href="https://fonts.bunny.net"> 
     <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" /> 
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body class="font-sans  ">
    <nav class="navbar navbar-expand-lg navbar-light  py-3">
        <div class="container-fluid d-flex justify-content-between">
            <div class="d-flex justify-content-start"> <!-- تعديل هنا -->
            <a class=" brand" href="/">Daily sleep tracker</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>  
            </div>
          
          <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup"> <!-- تعديل هنا -->
            @yield('lisbar')
          </div>
        </div>
      </nav>
    <div class="container">
        @yield('content')
    </div>
    @yield('buttons')
    @yield('infos')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.3/howler.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script> <!-- تأكد من تضمين ملف JavaScript هنا -->

</body>
</html>