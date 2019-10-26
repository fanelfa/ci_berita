<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Berita</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="<?php echo $this->asset; ?>images/icons/favicon.png" />
    <!--===============================================================================================-->
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo $this->asset; ?>vendor/bootstrap/css/bootstrap.min.css"> -->
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo $this->asset; ?>fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->asset; ?>fonts/fontawesome-5.0.8/css/fontawesome-all.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo $this->asset; ?>fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo $this->asset; ?>vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo $this->asset; ?>vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo $this->asset; ?>vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo $this->asset; ?>css/util.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo $this->asset; ?>css/main.css">
    <!--===============================================================================================-->
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
</head>

<body class="animsition">

    <!-- Header -->
    <header>
        <!-- Header desktop -->
        <div class="container-menu-desktop">

            <!-- Header Mobile -->
            <div class="wrap-header-mobile">
                <!-- Logo moblie -->
                <!-- <div class="logo-mobile">
                    <a href="index.html"><img src="<?php echo $this->asset; ?>images/icons/logo-01.png" alt="IMG-LOGO"></a>
                </div> -->

                <!-- Button show menu -->
                <div class="btn-show-menu-mobile hamburger hamburger--squeeze m-r--8">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </div>
            </div>

            <!-- Menu Mobile -->
            <div class="menu-mobile">

                <ul class="main-menu-m">
                    <li>
                        <a href="index.html">Kategori</a>
                        <ul class="sub-menu-m">
                            <li><a href="index.html">Homepage v1</a></li>
                            <li><a href="home-02.html">Homepage v2</a></li>
                            <li><a href="home-03.html">Homepage v3</a></li>
                        </ul>

                        <span class="arrow-main-menu-m">
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </span>
                    </li>
                </ul>
            </div>

            <!--  -->
            <!-- <div class="wrap-logo container"> -->
            <!-- Logo desktop -->
            <!-- <div class="logo">
                    <a href="index.html"><img src="<?php echo $this->asset; ?>images/icons/logo-01.png" alt="LOGO"></a>
                </div>
            </div> -->

            <!--  -->
            <div class="wrap-main-nav">
                <div class="main-nav">
                    <!-- Menu desktop -->
                    <nav class="menu-desktop">
                        <a class="logo-stick" href="index.html">
                            <img src="<?php echo $this->asset; ?>images/icons/logo-01.png" alt="LOGO">
                        </a>

                        <ul class="main-menu">
                            <li class="main-menu-active">
                                <a href="index.html">Kategori</a>
                                <ul class="sub-menu">
                                    <li><a href="index.html">Homepage v1</a></li>
                                    <li><a href="home-02.html">Homepage v2</a></li>
                                    <li><a href="home-03.html">Homepage v3</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Admin</a>
                                <ul class="sub-menu">
                                    <li><a href="admin/create">Tambah Berita</a></li>
                                    <li><a href="home-02.html">Homepage v2</a></li>
                                    <li><a href="home-03.html">Homepage v3</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>