<?php
/*
 * HEADER
 */
if (!isset($_SESSION)) {
    session_start();
} ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>The Wall
    </title>
    <!-- Meta tags -->
    <meta charset="utf-8">
    <!-- Bootstrap mobile responsiveness -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"
          integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <!-- Site icon -->
    <link rel="icon" href="../img/site-logo.png" type="image/icon type"/>
</head>
<body id="home" data-spy="scroll" data-target=".navbar" data-offset="200">
<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top" role="navigation">
    <div class="container">
        <!-- Site Identity on NavBar -->
        <a class="navbar-brand order-1 mr-0" href="#" target="_blank">
            <img src="../img/site-logo.png" width="30" height="30" class="d-inline-block align-top" alt="The wall logo">
            The Wall
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon">
          </span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="navbar-nav mr-auto">
                <!-- Home Button -->
                <li class="nav-item active">
                    <a class="nav-link" href="/">Home
                        <span class="sr-only">(current)
                </span>
                    </a>
                </li>
                <!-- Instrument Dropdown Menu-->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        On the Wall
                    </a>
                    <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item text-light " href="/instruments?guitars=viewall">Guitars
                        </a>
                        <a class="dropdown-item text-light " href="/instruments?basses=viewall">Basses
                        </a>
                        <a class="dropdown-item disabled" href="#">Ukuleles
                        </a>
                        <div class="dropdown-divider text-light ">
                        </div>
                        <a class="dropdown-item text-light " href="/instruments?drums=viewall">Drums
                        </a>
                        <div class="dropdown-divider text-light ">
                        </div>
                        <a class="dropdown-item disabled" href="#">Pedals
                        </a>
                        <a class="dropdown-item disabled" href="#">Amps
                        </a>
                        <a class="dropdown-item disabled" href="#">Accessories
                        </a>
                    </div>
                </li>
                <!-- Search Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Search
                    </a>
                    <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item">
                            <form class="form-inline my-2 my-lg-0" action="../search" method="GET">
                                <input class="form-control mr-sm-2 mb-2" name="value" id="value" type="search"
                                       placeholder="Search" aria-label="Search">
                                <div class="align-self-end ml-auto">
                                    <button class="btn btn-outline-danger my-2 my-sm-0" type="submit">Search
                                    </button>
                                </div>
                            </form>
                        </a>
                    </div>
                </li>
                <!-- About, Contact Us and Disabled Job menu item -->
                <li class="nav-item">
                    <a class="nav-link" href="#about">About
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#footer">Contact Us
                    </a>
                </li>
                <?php
                if (isset($_COOKIE['user']) || isset($_COOKIE['admin'])) {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="logout">Logout
                        </a>
                    </li>
                    <?php
                    if (isset($_COOKIE['admin'])) {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin">Admin
                            </a>
                        </li>
                        <?php
                    }
                } else {
                    ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Login
                        </a>
                        <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                            <form action="../processLogin" method="POST" class="form-inline my-2 my-lg-0">
                                <div class="form-group dropdown-item">
                                    <label class="form-control-label text-light" for="email">Email:
                                    </label>
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                                <div class="form-group dropdown-item">
                                    <label class="form-control-label text-light" for="password">Password:
                                    </label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                                <button id="login" type="submit"
                                        class="btn btn-outline-danger btn-md align-self-end ml-auto mr-4">Login
                                </button>
                            </form>
                        </div>
                    </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Jobs at The Wall
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- /navbar -->
