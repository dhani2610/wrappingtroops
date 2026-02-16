@extends('landing.layouts.app')



@section('style-landing')
@endsection



@section('content-landing')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/css/lightgallery-bundle.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Blinker:wght@100;200;300;400;600;700;800;900&display=swap');

        h1 {
            padding: 0 0 30px;
        }

        a:hover {
            text-decoration: none;
        }

        .product-grid {
            font-family: "Blinker", sans-serif;
            text-align: center;
            padding: 10px 10px;
            margin: 0 auto;
            border: 2px solid #dedade;
            overflow: hidden;
            transition: all 0.3s ease-in-out;
        }

        .product-grid:hover {
            border: 2px solid #003844;
        }

        .product-grid .product-image {
            position: relative;
        }

        .product-grid .product-image a.image {
            display: block;
        }

        .product-grid .product-image img {
            width: 100%;
            height: auto;
        }

        .product-image .pic-1 {
            transition: all .5s ease;
        }

        .product-grid:hover .product-image .pic-1 {
            opacity: 0;
        }

        .product-image .pic-2 {
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
            opacity: 0;
            position: absolute;
            top: 0;
            left: 0;
            transition: all .5s ease;
        }

        .product-grid:hover .product-image .pic-2 {
            opacity: 1;
        }

        .product-grid .product-links {
            padding: 0;
            margin: 0;
            list-style: none;
            opacity: 1;
            border: 1px solid #aaa;
            position: absolute;
            top: 0;
            right: 0;
            transition: all .3s ease 0.3s;
        }

        .product-grid:hover .product-links {
            opacity: 1;
        }

        .product-grid .product-links li {
            margin: 0;
            display: block;
        }

        .product-grid .product-links li a i {
            line-height: inherit;
        }

        .product-grid .product-links li a {
            color: #aaa;
            background-color: #fff;
            font-size: 16px;
            font-weight: 600;
            line-height: 37px;
            height: 40px;
            width: 40px;
            margin: 0;
            border-bottom: 1px solid #aaa;
            display: block;
            position: relative;
            transition: all 0.3s ease 0.1s;
        }

        .product-grid .product-links li a:before,
        .product-grid .product-links li a:after {
            content: attr(data-tip);
            color: #fff;
            background: #000;
            font-size: 12px;
            line-height: 20px;
            padding: 5px 10px;
            border-radius: 5px 5px;
            white-space: nowrap;
            display: none;
            transform: translateY(-50%);
            position: absolute;
            right: 53px;
            top: 50%;
        }

        .product-grid .product-links li a:after {
            content: "";
            height: 15px;
            width: 15px;
            padding: 0;
            border-radius: 0;
            transform: translateY(-50%) rotate(45deg);
            right: 50px;
        }

        .product-grid .product-links li a:hover:before,
        .product-grid .product-links li a:hover:after {
            display: block;
        }

        .product-grid .product-links li a:hover {
            color: #fff;
            background-color: #003844;
        }

        .product-grid .product-content {
            padding: 10px 0 0;
        }

        .product-grid .rating {
            color: #ffd200;
            font-size: 14px;
            padding: 0;
            margin: 0 0 10px;
            list-style: none;
            display: inline-block;
        }

        .product-grid .rating li:last-child {
            color: #111;
            display: inline-block;
        }

        .product-grid .title {
            font-size: 17px;
            font-weight: 600;
            text-transform: capitalize;
            margin: 0 0 5px;
        }

        .product-grid .title a {
            color: #000;
            transition: all 0.3s ease 0s;
        }

        .product-grid .title a:hover {
            color: #003844;
        }

        .product-grid .price {
            color: #000;
            font-size: 20px;
            font-weight: 500;
            margin: 0 0 5px;
        }

        .product-grid .add-cart {
            color: #003844;
            font-size: 14px;
            font-weight: 700;
            text-transform: uppercase;
            padding: 11px 12px 10px;
            border: 1px solid #003844;
            display: block;
            position: relative;
            transition: all .3s ease;
            z-index: 1;
        }

        .product-grid .add-cart i {
            margin: 0 5px 0 0;
        }

        .product-grid .add-cart:hover {
            color: #fff;
        }

        .product-grid .add-cart:before {
            content: "";
            background: #003844;
            width: 0;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            transition: all 0.3s ease-in-out;
            z-index: -1;
        }

        .product-grid .add-cart:hover:before {
            width: 100%;
        }

        @media screen and (max-width: 990px) {
            .product-grid {
                margin-bottom: 30px;
            }
        }

        .slide-container {
            max-width: 1120px;
            width: 100%;
            padding: 40px 0;
        }

        .slide-content {
            margin: 0 40px;
            overflow: hidden;
            border-radius: 25px;
        }

        .card {
            border-radius: 25px;
            /* background-color: #FFF; */
        }

        .image-content,
        .card-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 10px 14px;
        }

        .image-content {
            position: relative;
            row-gap: 5px;
            padding: 25px 0;
        }

        .overlay {
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 100%;
            background-color: #4070F4;
            border-radius: 25px 25px 0 25px;
        }

        .overlay::before,
        .overlay::after {
            content: '';
            position: absolute;
            right: 0;
            bottom: -40px;
            height: 40px;
            width: 40px;
            background-color: #4070F4;
        }

        .overlay::after {
            border-radius: 0 25px 0 0;
            background-color: #FFF;
        }

        /* .card-image {
                                                                                                                                            position: relative;
                                                                                                                                            height: 150px;
                                                                                                                                            width: 150px;
                                                                                                                                            border-radius: 50%;
                                                                                                                                            background: #FFF;
                                                                                                                                            padding: 3px;
                                                                                                                                        }

                                                                                                                                        .card-image .card-img {
                                                                                                                                            height: 100%;
                                                                                                                                            width: 100%;
                                                                                                                                            object-fit: cover;
                                                                                                                                            border-radius: 50%;
                                                                                                                                            border: 4px solid #4070F4;
                                                                                                                                        } */

        .name {
            font-size: 18px;
            font-weight: 500;
            color: #333;
        }

        .description {
            font-size: 14px;
            color: #707070;
            text-align: center;
        }

        .button {
            border: none;
            font-size: 16px;
            color: #FFF;
            padding: 8px 16px;
            background-color: #4070F4;
            border-radius: 6px;
            margin: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .button:hover {
            background: #265DF2;
        }

        .swiper-navBtn {
            color: #6E93f7;
            transition: color 0.3s ease;
        }

        .swiper-navBtn:hover {
            color: #4070F4;
        }

        .swiper-navBtn::before,
        .swiper-navBtn::after {
            font-size: 35px;
        }

        .swiper-button-next {
            right: 0;
        }

        .swiper-button-prev {
            left: 0;
        }

        .swiper-pagination-bullet {
            background-color: #6E93f7;
            opacity: 1;
        }

        .swiper-pagination-bullet-active {
            background-color: #4070F4;
        }

        @media screen and (max-width: 768px) {
            .slide-content {
                margin: 0 10px;
            }

            .swiper-navBtn {
                display: none;
            }
        }


        @media (max-width: 768px) {
            .text-cat {
                font-size: 8px !important;
            }

            .sc-cat {
                display: none
            }

            .cat-prod {
                font-size: 18px !important
            }

            .img-layanan {
                max-width: 39px !important;
            }

            .text-layanan {
                font-size: 8px !important;
            }

            .stats .stats-item {
                padding: 0px !important;
                border: none !important;
                box-shadow: none !important;
            }
        }

        .swiper-button-next,
        .swiper-rtl .swiper-button-prev {
            background: white;
            padding: 29px;
            left: auto;
            border-radius: 50%;
            font-size: 10px;
            color: black;
            font-weight: bold;
        }

        .swiper-button-prev,
        .swiper-rtl .swiper-button-next {
            background: white;
            left: 10px;
            right: auto;
            padding: 29px;
            border-radius: 50%;
            font-weight: 900;
        }

        .hero .carousel-control-next-icon,
        .hero .carousel-control-prev-icon {
            background: #F7971E !important;
            font-size: 32px;
            line-height: 1;
            color: white;
            z-index: 9999999 !important
        }

        .hero .carousel-control-prev,
        .hero .carousel-control-next {
            width: 10%;
            transition: 0.3s;
            opacity: 2.5;
            z-index: 999999999999999 !important;
        }


        .hero .carousel {
            min-height: 76vh !important;
        }

        .mobile-sider {
            display: none
        }

        @media (max-width: 768px) {
            .carousel-item img {
                object-fit: contain;
                /* Menjaga agar seluruh gambar terlihat tanpa terpotong */
            }

            .hero .carousel {
                min-height: 24vh !important;
            }

        }

        /* SEMBUNYIKAN HERO DI MOBILE */
        @media (max-width: 768px) {
            #hero.desktop-version {
                display: none;
            }

            #hero,
            #hero-carousel,
            .carousel,
            .carousel-item {
                height: 47vh !important;
                min-height: 10vh !important;
                max-height: 32vh !important;
                overflow: hidden;
            }

            .carousel-item {
                background-size: contain !important;
                background-repeat: no-repeat;
                background-position: center center;
                background-color: #000;
                /* opsional untuk kontras */
            }
        }



        /* SEMBUNYIKAN HERO DI DESKTOP */
        @media (min-width: 769px) {
            #hero.mobile-version {
                display: none;
            }
        }


        .klien-logo-wrapper {
            width: 100%;
            padding: 5px;
            /* background: #fff; */
            border-radius: 6px;
            transition: transform 0.2s ease;
        }

        .klien-logo-wrapper img {
            width: 100%;
            height: auto;
            object-fit: contain;
        }


        .klien-logo-wrapper:hover {
            transform: scale(1.05);
        }

        .klien-logo-wrapper:hover img {
            filter: grayscale(0%);
        }

        .portofolio-item {
            margin: 10px;
            position: relative;
            transition: transform 0.3s ease;
            box-shadow: 2px 4px 8px rgba(0, 0, 0, 0.3);
            padding: 5px;
        }

        .portofolio-item img {
            max-width: 140% !important;
            height: auto;
            display: block;
        }

        /* Rotasi acak */
        .rotate-1 {
            transform: rotate(-10deg);
        }

        .rotate-2 {
            transform: rotate(-5deg);
        }

        .rotate-3 {
            transform: rotate(0deg);
        }

        .rotate-4 {
            transform: rotate(8deg);
        }

        .rotate-5 {
            transform: rotate(15deg);
        }

        .rotate-6 {
            transform: rotate(-15deg);
        }

        .rotate-7 {
            transform: rotate(5deg);
        }

        .rotate-8 {
            transform: rotate(-8deg);
        }

        @keyframes slide-in-left {
            0% {
                transform: translateX(-100%) translateY(-50%);
                opacity: 0;
            }

            100% {
                transform: translateX(0) translateY(-50%);
                opacity: 1;
            }
        }

        @keyframes slide-in-right {
            0% {
                transform: translateX(100%) translateY(-50%);
                opacity: 0;
            }

            100% {
                transform: translateX(0) translateY(-50%);
                opacity: 1;
            }
        }

        .img-left-animate {
            animation: slide-in-left 1s ease forwards;
            position: absolute;
            top: 50%;
            left: 30px;
            z-index: 10;
            max-width: 50%;
            opacity: 0;
        }

        .img-right-animate {
            animation: slide-in-right 1s ease forwards;
            position: absolute;
            top: 50%;
            right: 30px;
            z-index: 10;
            max-width: 46%;
            opacity: 0;
        }

        .gallery {
            padding: 0;
            margin: 0;
        }

        .gallery-row {
            margin: 0;
            display: flex;
            flex-wrap: wrap;
        }

        .gallery .gallery-item {
            padding: 0;
            margin: 0;
            flex: 0 0 20%;
            max-width: 20%;
        }

        .gallery .gallery-item a,
        .gallery .gallery-item img {
            display: block;
            width: 100%;
            height: auto;
            margin: 0;
            padding: 0;
        }

        /* ✅ Mobile: 2 per row */
        @media (max-width: 768px) {
            .gallery .gallery-item {
                flex: 0 0 50%;
                max-width: 50%;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/freeps2/a7rarpress@main/swiper-bundle.min.css">
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    @include('landing.layouts.partials.messages')

    @php
        $set = App\Models\Setting::first();
    @endphp

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section dark-background desktop-version">

            <div id="hero-carousel" class="carousel slide " data-bs-ride="carousel" data-bs-interval="3000">

                @foreach ($slider as $s)
                    <div class="carousel-item {{ $loop->iteration == 1 ? 'active' : '' }}"
                        style="
                            background-image: url('{{ asset('assets/img/slider/' . $s->image) }}');
                            background-size: cover;
                            background-position: center;
                            height: 100vh;
                            position: relative;
                            overflow: hidden;
                        ">

                        <!-- LEFT IMAGE -->
                        @if (!empty($s->right_image))
                            <img data-aos="fade-right" data-aos-delay="300" data-aos-duration="1000"
                                src="{{ asset('assets/img/slider/' . $s->left_image) }}" class="img-left img-right-animate"
                                alt="Left Image"
                                style="
                                   position: absolute;
                                    top: 50%;
                                    left: 106vh;
                                    transform: translateY(-50%);
                                    z-index: 10;
                                    max-width: 50%;
                            ">
                        @endif

                        @if (!empty($s->right_image))
                            <!-- RIGHT IMAGE -->
                            <style>
                                .slider-text {
                                    position: absolute;
                                    top: 50%;
                                    left: 50px;
                                    transform: translateY(-50%);
                                    z-index: 20;
                                    color: white;
                                    text-transform: uppercase;
                                }

                                .slider-text h1 {
                                    font-size: 3vw;
                                    font-weight: 900;
                                    margin: 0.3em 0;
                                    line-height: 1.1;
                                    letter-spacing: 1px;
                                    text-shadow:
                                        1px 1px 0 #fff,
                                        -1px 1px 0 #fff,
                                        1px -1px 0 #fff,
                                        -1px -1px 0 #fff;
                                }

                                .slider-text {
                                    line-height: 1;
                                    /* atau coba 0.9 jika masih terlalu renggang */
                                }

                                .slider-text span {
                                    display: block;
                                    margin: 0;
                                    padding: 0;
                                }
                            </style>
                            {{-- <div class="slider-text aos-init aos-animate" data-aos="fade-right" data-aos-delay="400"
                                data-aos-duration="1000"
                                style="top: 1%;left: 10%;font-family: 'Bebas Neue', sans-serif!important; line-height: 1;">
                                <span style="font-size: 99px;">PRINT OUTDOOR</span>
                                <span style="font-size: 99px; margin-left: 22%;">PRINT INDOOR</span>
                                <span style="font-size: 99px; margin-left: 10%;">CETAK OFFSET</span>
                                <span style="font-size: 99px; margin-left: 35%;">PRINT A3+</span>
                                <span style="font-size: 99px; margin-left: 43%;">MERCHANDISE</span>
                                <span style="font-size: 99px;">VINYL APPLICATOR</span>
                            </div> --}}
                            <div class="slider-text aos-init aos-animate" data-aos="fade-right"  style="top: 4%;left: 13%;font-family: 'Bebas Neue', sans-serif!important;line-height: 1;">
                                <span style="font-size: 94px;/* margin-left: 14%; */"  data-aos="fade-right" data-aos-delay="400">PRINT OUTDOOR</span>
                                <span style="font-size: 76px;margin-left: 17%;"  data-aos="fade-right" data-aos-delay="700">PRINT INDOOR</span>
                                <span style="font-size: 76px;margin-left: 10%;"  data-aos="fade-right" data-aos-delay="1000">CETAK OFFSET</span>
                                <span style="font-size: 76px;margin-left: 35%;"  data-aos="fade-right" data-aos-delay="1300">PRINT A3+</span>
                                <span style="font-size: 75px;margin-left: 43%;"  data-aos="fade-right" data-aos-delay="1600">MERCHANDISE</span>
                                <span style="font-size: 76px;"  data-aos="fade-right" data-aos-delay="1900">
                                    <a href="http://wrappingtroops.com" style="color: white" >
                                        VINYL APPLICATOR
                                    </a>
                                </span>
                            </div>
                        @endif


                    </div>
                @endforeach


                {{-- <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
                </a>

                <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
                </a> --}}

                {{-- <ol class="carousel-indicators"></ol> --}}

            </div>

        </section><!-- /Hero Section -->
        <!-- Hero Section -->
        <section id="hero" class="hero section dark-background mobile-version">

            <div id="hero-carousel" class="carousel slide " data-bs-ride="carousel" data-bs-interval="3000">

                @foreach ($slider as $s)
                    <div class="carousel-item {{ $loop->iteration == 1 ? 'active' : '' }}"
                        style="
                            background-image: url('{{ asset('assets/img/slider/' . $s->image) }}');
                            background-size: cover;
                            background-position: center;
                            height: 100vh;
                            position: relative;
                            overflow: hidden;
                        ">

                        <!-- LEFT IMAGE -->
                        @if (!empty($s->left_image))
                            <img data-aos="fade-right" src="{{ asset('assets/img/slider/' . $s->left_image) }}"
                                class="img-left img-right-animate" alt="Left Image"
                                style="
                                   position: absolute;
                                        top: 56%;
                                    left: 30vh;
                                    transform: translateY(-50%);
                                    z-index: 10;
                                    max-width: 50%;
                            ">
                        @endif

                        @if (!empty($s->right_image))
                            <!-- RIGHT IMAGE -->
                            <style>
                                .slider-text {
                                    position: absolute;
                                    top: 50%;
                                    left: 50px;
                                    transform: translateY(-50%);
                                    z-index: 20;
                                    color: white;
                                    text-transform: uppercase;
                                }

                                .slider-text h1 {
                                    font-size: 3vw;
                                    font-weight: 900;
                                    margin: 0.3em 0;
                                    line-height: 1.1;
                                    letter-spacing: 1px;
                                    text-shadow:
                                        1px 1px 0 #fff,
                                        -1px 1px 0 #fff,
                                        1px -1px 0 #fff,
                                        -1px -1px 0 #fff;
                                }

                                .slider-text {
                                    line-height: 1;
                                    /* atau coba 0.9 jika masih terlalu renggang */
                                }

                                .slider-text span {
                                    display: block;
                                    margin: 0;
                                    padding: 0;
                                }
                            </style>
                            <div class="slider-text aos-init aos-animate" data-aos="fade-right" data-aos-delay="400"
                                data-aos-duration="1000"
                                style="top: 15%;left: 10%;font-family: 'Bebas Neue', sans-serif!important; line-height: 1;">
                                <span style="font-size: 25px;" data-aos="fade-right" data-aos-delay="400">PRINT OUTDOOR</span>
                                <span style="font-size: 25px; margin-left: 22%;" data-aos="fade-right" data-aos-delay="700">PRINT INDOOR</span>
                                <span style="font-size: 25px; margin-left: 10%;" data-aos="fade-right" data-aos-delay="1000">CETAK OFFSET</span>
                                <span style="font-size: 25px; margin-left: 35%;" data-aos="fade-right" data-aos-delay="1300">PRINT A3+</span>
                                <span style="font-size: 25px; margin-left: 43%;" data-aos="fade-right" data-aos-delay="1600">MERCHANDISE</span>
                                <span style="font-size: 25px;" data-aos="fade-right" data-aos-delay="1900">
                                    <a href="http://wrappingtroops.com" style="color: white">
                                        VINYL APPLICATOR
                                    </a>
                                </span>
                            </div>
                        @endif


                    </div>
                @endforeach


                {{-- <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
                </a>

                <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
                </a> --}}

                {{-- <ol class="carousel-indicators"></ol> --}}

            </div>

        </section>
        <!-- /Hero Section -->

        <!-- About Section -->


        <!-- Klien Section -->
        <section id="portofolio" class="portofolio section" style="padding:0px!important;">

            <div class="container-fluid" id="lightgallery" style="padding-left:0px!important;padding-right:0px!important">
                <!-- DESKTOP VIEW -->
                <div class="container-fluid gallery" id="lightgallery-desktop">
                    <div class="row gallery-row">
                        @foreach ($portofolio as $pt)
                            @php
                                $imgUrl = asset('assets/img/Portofolio/' . $pt->image);
                            @endphp
                            <div class="gallery-item">
                                <a href="{{ $imgUrl }}" class="portofolio-item" data-lg-size="1600-1067">
                                    <img src="{{ $imgUrl }}" alt="portofolio logo" class="img-fluid" />
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <!-- Tambahkan setelah </section> -->
        <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/lightgallery.umd.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/plugins/zoom/lg-zoom.umd.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/plugins/thumbnail/lg-thumbnail.umd.js"></script>

        <script>
            lightGallery(document.getElementById('lightgallery'), {
                plugins: [lgZoom, lgThumbnail],
                speed: 500,
                selector: 'a'
            });
        </script>


        <!-- Services Section -->
        <section id="kategori" class="services section">

            <!-- Section Title -->
            <div class="container section-title " data-aos="fade-up">
                <center>
                    <div>
                        <span class="cat-prod">Kategori Produk</span>
                    </div>
                    <p style="color:#F7971E">Silahkan Klik untuk daftar harga </p>
                </center>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4">
                    @foreach ($category as $cat)
                        <div class="col-lg-3 col-md-2 col-3" data-aos="fade-up" data-aos-delay="100">
                            <div class="service-item position-relative" style="border: none">
                                <img src="{{ asset('assets/img/category/' . $cat['image']) }}" class="img-fluid img-cat"
                                    style="max-width: 50%" alt="">
                                @if ($cat['category'] == 'Pasang Stiker')
                                    <a href="https://wrappingtroops.com" target="_blank" class="stretched-link"
                                        style="color: black">
                                @elseif($cat['category'] == 'Advertising')
                                    <a href="http://iklanjalan.com" target="_blank" class="stretched-link"
                                        style="color: black">
                                @else
                                        <a href="{{ route('category-landing') }}?category={{ $cat['id'] }}"
                                            class="stretched-link" style="color: black">
                                @endif
                                <p class="fs-6 fs-md-5 fs-lg-4 text-cat">
                                    <strong>{{ $cat['category'] }}</strong>
                                </p>
                                </a>
                            </div>
                        </div><!-- End Service Item -->
                    @endforeach
                </div>


            </div>

        </section><!-- /Services Section -->

        <section id="stats" class="stats section" style="background: linear-gradient(to bottom, #FCE15A, #F7971E);">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <!-- Section Title -->
                <div class="container section-title " data-aos="fade-up">
                    <center>
                        <div><span class="cat-prod">Promo Bulan ini</span></div>
                    </center>
                </div><!-- End Section Title -->
                <div class="row gy-4">
                    <div id="container">

                        <div class="row">
                            {{-- <div class="col-lg-3">
                                <h5 style="color: bronze">
                                    <b>
                                        Promo Bulan ini
                                    </b>
                                </h5>

                                <p style="color: burlywood">Nikmati Promosinya</p>

                                <img src="{{ asset('assets/img/promo/' . $set->promo) }}" class="img-fluid">
                            </div> --}}
                            <div class="col-lg-12">
                                <div class="slide-container swiper">
                                    <div class="slide-content">
                                        <div class="card-wrapper swiper-wrapper">
                                            @foreach ($allProductsDisc as $p)
                                                @php

                                                    $catProd = App\Models\CategoryDocument::where(
                                                        'id',
                                                        $p->id_category,
                                                    )->first();

                                                @endphp
                                                <div class="card swiper-slide" style="">
                                                    <div class="product-grid">
                                                        <div class="product-image">
                                                            <a href="{{ route('detail-prod', $p->id) }}" class="image">
                                                                <img class="pic-1"
                                                                    src="{{ asset('assets/img/product/' . $p->image) }}">
                                                                <img class="pic-2"
                                                                    src="{{ asset('assets/img/product/' . $p->image) }}">
                                                            </a>
                                                        </div>
                                                        <div class="product-content">
                                                            <h3 class="title">
                                                                <a href="#"
                                                                    style="color: #F7941D!important">{{ $p->service }}</a>
                                                            </h3>
                                                            <div class="price">From @currency($p->price)</div>
                                                            <a href="{{ route('detail-prod', $p->id) }}"
                                                                class="add-cart">
                                                                Lihat Detail
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="swiper-button-next swiper-navBtn"></div>
                                    <div class="swiper-button-prev swiper-navBtn"></div>
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section><!-- /Stats Section -->





        <!-- Stats Section -->
        {{-- <section id="stats" class="stats section" style="background: black; padding: 40px 0;">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="row align-items-center">
                    <!-- Kiri -->
                    <div class="col-lg-6" data-aos="fade-left">
                        <h1 style="color: #F7971E; font-weight: bold; font-size: 32px;padding: 0;">
                            MESIN KAMI
                        </h1>

                        @foreach ($mesin as $m)
                            <div style="display: flex; align-items: center; margin-bottom: 10px;">
                                <div
                                    style="width: 12px; height: 12px; background-color: #F7971E; border-radius: 50%; margin-right: 15px;">
                                </div>
                                <span style="color: white; font-size: 20px;">{{ $m->title }}</span>
                            </div>
                        @endforeach
                    </div>



                    <!-- Kanan -->
                    <div class="col-lg-6 text-center">
                        <img src="{{ asset('assets/img/mesin/' . $set->mesin) }}" data-aos="fade-right"
                            class="img-fluid" alt="Mesin" style="max-height: 400px; object-fit: contain;">
                    </div>
                </div>
            </div>
        </section> --}}
        <section id="stats" class="stats section" style="background: black; padding: 40px 0;">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row d-flex">

            <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-left">
                <h1 style="color: #F7971E; font-weight: bold; font-size: 32px; padding: 0;">
                    MESIN KAMI
                </h1>

                @foreach ($mesin as $m)
                    <div style="display: flex; align-items: center; margin-bottom: 10px;">
                        <div style="width: 12px; height: 12px; background-color: #F7971E; border-radius: 50%; margin-right: 15px; flex-shrink: 0;">
                        </div>
                        <span style="color: white; font-size: 20px;">{{ $m->title }}</span>
                    </div>
                @endforeach
            </div>

            <div class="col-lg-6 text-center" style="padding: 0;"> <img src="{{ asset('assets/img/mesin/' . $set->mesin) }}"
                     data-aos="fade-right"
                     class="img-fluid"
                     alt="Mesin"
                     style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
            </div>
        </div>
    </div>
</section>



        <!-- Klien Section -->
        <section id="klien" class="klien section" style="background: silver;">

            <div class="container section-title" data-aos="fade-up" style="padding-bottom: 0;font-size: 30px;">
                <div><span class="cat-prod"> <b>Klien</b></span></div>
            </div>

            <div class="container" data-aos="fade-left">
                <div class="row gx-1 gy-1 justify-content-center text-center">
                    @foreach ($klien as $index => $k)
                        @if ($index < 24)
                            <div class="col-4 col-sm-3 col-md-2 d-flex align-items-center justify-content-center">
                                <div class="klien-logo-wrapper">
                                    <img src="{{ asset('assets/img/klien/' . $k->image) }}" alt="klien logo"
                                        class="img-fluid">
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>


        <!-- Testimonials Section -->

    </main>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loadMoreBtn = document.getElementById('load-more-btn');
            const loadLessBtn = document.getElementById('load-less-btn');
            const products = document.querySelectorAll('.product-item');
            let itemsToShow = 8; // Jumlah awal item yang ditampilkan

            loadMoreBtn.addEventListener('click', function() {
                itemsToShow += 10;
                products.forEach((product, index) => {
                    if (index < itemsToShow) {
                        product.style.display = 'block';
                    }
                });

                if (itemsToShow >= products.length) {
                    loadMoreBtn.style.display = 'none';
                    loadLessBtn.style.display = 'inline-block';
                }
            });

            loadLessBtn.addEventListener('click', function() {
                itemsToShow = 8;
                products.forEach((product, index) => {
                    if (index >= itemsToShow) {
                        product.style.display = 'none';
                    }
                });

                loadMoreBtn.style.display = 'inline-block';
                loadLessBtn.style.display = 'none';
            });
        });
    </script>
    <script src="//cdn.jsdelivr.net/gh/freeps2/a7rarpress@main/swiper-bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/gh/freeps2/a7rarpress@main/script.js"></script>

    <script>
        var swiper = new Swiper(".slide-content", {
            slidesPerView: 4,
            spaceBetween: 10,
            loop: false,
            centerSlide: 'true',
            fade: 'true',
            grabCursor: 'true',
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
                dynamicBullets: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },

            breakpoints: {
                0: {
                    slidesPerView: 1,
                },
                520: {
                    slidesPerView: 2,
                },
                950: {
                    slidesPerView: 4,
                },
            },
        });
    </script>
@endsection



@section('script-landing')
@endsection
