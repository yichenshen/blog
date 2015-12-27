<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- Bootstrap configs -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MINI</title>

    <!-- JS -->
    <!-- please note: The JavaScript files are loaded in the footer to speed up page construction -->
    <!-- See more here: http://stackoverflow.com/q/2105327/1114320 -->

    <!-- CSS -->
    <link href="<?php echo URL; ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo URL; ?>css/style.css" rel="stylesheet">
</head>
<body>
    <header class="navbar navbar-fixed-top navbar-inverse container-fluid">
        <div class="container">
        
            <!-- Logo -->
            <div class="navbar-header">
                <a href="<?php echo URL; ?>" id="logo">blog</a>
            </div>
        
            <!-- Bar to the right -->
            <nav>
                <ul class="nav navbar-nav navbar-right">
                    <?php if(isset($_SESSION['user'])): ?>
                        <li><a href="<?php echo URL; ?>posts/admin/1">Dashboard</a></li>
                        <li><a href="<?php echo URL; ?>login/logout">Log Out</a></li>
                    <?php else: ?>
                        <li><a href="<?php echo URL; ?>login">Log in</a></li>
                    <?php endif; ?>

                </ul>
            </nav>
        </div>
    </header>
