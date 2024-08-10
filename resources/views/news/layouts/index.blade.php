<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Media Online</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- theme meta -->
    <meta name="theme-name" content="newsbit" />

    <!--Favicon-->
    <link rel="shortcut icon" href="/media-online/images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/media-online/images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="/media-online/images/apple-touch-icon.png">

    <!-- THEME CSS
	================================================== -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="/media-online/plugins/bootstrap/css/bootstrap.min.css">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="/media-online/plugins/font-awesome/css/font-awesome.min.css">
    <!-- Slick Carousel -->
    <link rel="stylesheet" href="/media-online/plugins/slick-carousel/slick.css">
    <link rel="stylesheet" href="/media-online/plugins/slick-carousel/slick-theme.css">
    <!-- manin stylesheet -->
    <link rel="stylesheet" href="/media-online/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
    <style>
        .ad-image {
            width: 728px;
            height: 90px;
            object-fit: cover;
            /* Menjaga rasio gambar dan mengisi area tanpa distorsi */
        }
    </style>
</head>

<body>

    <header class="header-navigation d-none d-lg-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xs-12 col-sm-3 col-md-3">
                    <!-- Logo -->
                    <div class="logo">
                        <a href="index.html">
                            <img src="/media-online/images/logos/logo.png" alt=""> <!-- Replace Logo Here -->
                        </a>
                    </div>
                    <!-- End Logo -->
                </div>
                <div class="col-xs-12 col-sm-9 col-md-9">
                    <div class="top-ad-banner">
                        @php
                        $tampilIklan = $iklan->where('is_tampil', true);
                        @endphp

                        @if ($tampilIklan->isNotEmpty())
                        @if($tampilIklan->count() > 1)
                        <!-- Slick Slider -->
                        <div class="slider">
                            @foreach($tampilIklan as $item)
                            <div class="slider-item">
                                <a href="{{ $item->link }}" target="_blank">
                                    <img src="{{ asset('storage/' . $item->image) }}" class="img-fluid ad-image"
                                        alt="banner-ads">
                                </a>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <!-- Single Ad -->
                        <a href="{{ $tampilIklan->first()->link }}" target="_blank">
                            <img src="{{ asset('storage/' . $tampilIklan->first()->image) }}" class="img-fluid ad-image"
                                alt="banner-ads">
                        </a>
                        @endif
                        @else
                        <p>Tidak ada iklan yang ditampilkan (Jika ingin membuat iklan silahkan hubungi admin).</p>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </header>

    <div class="main-navbar clearfix bg-dark ">
        @include('news.layouts.partials.navbar')
    </div>

    <div class="py-30"></div>

    @yield('content')

    <div class="py-40"></div>

    <footer class="footer footer-main ">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-sm-12 col-lg-12 text-center">
                    <a href="index.html"><img src="/media-online/images/logos/footer-logo.png" alt=""
                            class="img-fluid"></a>
                    <p class="mt-4">"Nikmati berita dan artikel berkualitas dengan desain yang mengutamakan kenyamanan
                        dan keindahan. Kami mengoptimalkan setiap halaman untuk memastikan pengalaman membaca yang
                        menyenangkan dan efektif."</p>

                    {{-- <ul class="list-inline footer-social">
                        <li class="li list-inline-item"><a href="https://www.facebook.com/themefisher"><i
                                    class="fa fa-facebook"></i></a></li>
                        <li class="li list-inline-item"><a href="https://twitter.com/themefisher"><i
                                    class="fa fa-twitter"></i></a></li>
                        <li class="li list-inline-item"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li class="li list-inline-item"><a href="#"><i class="fa fa-pinterest"></i></a></li>
                        <li class="li list-inline-item"><a href="#"><i class="fa fa-rss"></i></a></li>
                        <li class="li list-inline-item"><a href="#"><i class="fa fa-youtube"></i></a></li>
                    </ul> --}}

                    <div class="copyright-text text-center">
                        <p class="mb-0">© All Copyright Reserved to - <a href="https://themefisher.com/"
                                target="_blank">Themefisher</a></p>
                    </div>
                </div>

                <div class="scroll-to-top">
                    <button class="btn btn-primary" title="Back to Top">
                        <i class="fa fa-angle-up"></i>
                    </button>
                </div>
            </div>
        </div>
    </footer>


    <!-- THEME JAVASCRIPT FILES
================================================== -->
    <!-- initialize jQuery Library -->
    <script src="/media-online/plugins/jquery/jquery.js"></script>
    <!-- Bootstrap jQuery -->
    <script src="/media-online/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- Slick Slider -->
    <script src="/media-online/plugins/slick-carousel/slick.min.js"></script>
    <!-- Google Map -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCC72vZw-6tGqFyRhhg5CkF2fqfILn2Tsw"></script>
    <script src="/media-online/plugins/google-map/gmap.js"></script>
    <!-- main js -->
    <script src="/media-online/js/custom.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script>
        <script>
    $(document).ready(function(){
        $('.slider').slick({
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 3000,
            dots: true,
            arrows: true
        });
    });
    </script>
    </script>
</body>

</html>
