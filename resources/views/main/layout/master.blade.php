<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>Alumni - BISU</title>
    @stack('styles')
    <!-- <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" href="/css/reset-pm.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/login.css">
    <link rel="stylesheet" href="/css/navbar.css">
    <link rel="stylesheet" href="/css/signin.css">
    <link rel="stylesheet" href="/css/home.css">
    <link rel="stylesheet" href="/css/footer.css">
    <link rel="stylesheet" href="/css/news-announcements.css">
    <link rel="stylesheet" href="/css/alumni-id.css">
    <link rel="stylesheet" href="/css/alumni-member.css">
    <link rel="stylesheet" href="/css/account.css">
    <link rel="stylesheet" href="/css/reissuance.css">
    <link rel="stylesheet" href="/css/about.css">
    <link rel="stylesheet" href="/css/preloader.css">
    <link rel="stylesheet" href="/css/success.css">
    <link rel="stylesheet" href="/css/record.css">

    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">



</head>
<body>


    @yield('content')

    <div class="loader-wrapper" id="loads">
    <span class="loader"><span class="loader-inner"></span></span>
    </div>

    <!-- <script src="/bootstrap/js/bootstrap.min.js"></script> -->
    <script src="/js/home-side-bar.js"></script>
    <script src="/js/navbar.js"></script>
    <script src="/js/jquery.js"></script>
    <script src="/js/addphoto.js"></script>
    <script src="/js/user-toggle.js"></script>
    @stack('scripts')
    <script>
        $(window).on("load",function(){
            $(".loader-wrapper").delay(1000).fadeIn("slow").fadeOut("slow");
        });
    </script>
</body>
</html>