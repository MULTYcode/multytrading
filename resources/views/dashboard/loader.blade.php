<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .preloader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url('/images/loading.gif') 50% 50% no-repeat rgb(249, 249, 249);
            opacity: .8;
        }
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#preloaders").fadeOut("slow");
        });
    </script>

</head>

<body>
    <div class="preloader" id="preloaders"></div>
</body>

</html>