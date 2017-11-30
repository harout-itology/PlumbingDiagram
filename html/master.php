<?php
/**
 * Created by PhpStorm.
 * User: harout
 * Date: 11/30/17
 * Time: 10:24 AM
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <title>Diagram</title>
    <!-- SEO meta and images -->
    <meta name="copyright"   content="Copyright 2017 by MegaProgramming, All Rights Reserved, V 1.0.0" >
    <meta name="author"      content="MegaProgramming" >
    <meta name="Keywords"    content="MegaProgramming" >
    <meta name="description" content="MegaProgramming">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta property="og:image"   content="/img/favicon.png">
    <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/img/favicon.png" type="image/png">
    <link rel="apple-touch-icon" href="/img/apple-touch-icon.png">
    <!-- Styles -->
    <link href="../css/app.css" rel="stylesheet">
    <link href="../css/custom.css" rel="stylesheet">
    <?= $header ?>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Branding Image -->
                <a class="navbar-brand" href="/">
                    Diagram
                </a>
            </div>
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li class="" ><a href="/html/diagram.php">Home</a></li>
                    <li class="" ><a href="/html/shape.php">Shapes List</a></li>
                    <li class="" ><a href="/html/port.php">Ports List</a></li>
                </ul>
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                            Local User <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="#"  >
                                    Profile
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?= $body ?>
</div>
<footer class="footer navbar navbar-default ">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                Copyright © by 2017 <a target="_blank" href="//megaprogramming.com">MegaProgramming</a>, All Rights Reserved
            </div>
        </div>
    </div>
</footer>
<!-- Scripts -->
<script src="/js/app.js"></script>
<?= $footer ?>
</body>
</html>
