<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
   
    
</script>
</head>


<body style="background-image: url('app_backgrounds/image.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
  
<div class="container">
          
          <div class="row py-5">
            
                <div class="col-md-12 text-bold text-center">
                    <labrl>
                      <h1>  Welcome in LaraApp</h1>
                    </labrl>
                </div>

          </div>
</div>
<div class="container">
    @yield('content')
</div>
</body>