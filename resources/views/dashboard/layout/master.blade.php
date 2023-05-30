<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>@yield('title')</title>
    @yield('styles')
</head>
<body>
    
<!-- <div class="loader-wrapper" id="loads">
    <a href="/" class="brand"><img src="/images/LOGO.png" class="logo pb-2"></a>
    <div class="linePreloader"></div>
</div> -->

<!-- <div class="loader-wrapper" id="loads">
<span class="loader"><span class="loader-inner"></span></span>
</div> -->

    @yield('content')
    @yield('scripts')
    @stack('scripts')
<!-- 
<script>
$(window).on("load",function(){
    $(".loader-wrapper").delay(1000).fadeIn("slow").fadeOut("slow");
});
</script> -->
<script>
    $(window).on("load",function(){
        $(".loader-wrapper").delay(1000).fadeIn("slow").fadeOut("slow");
    });
</script>

</body>
</html>