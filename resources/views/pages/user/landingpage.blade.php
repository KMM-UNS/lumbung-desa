<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Lumbung Desa</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />

	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="{{ asset('assets') }}/plugins/bootstrap3/css/bootstrap.min.css" rel="stylesheet" />
	<link href="{{ asset('assets') }}/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="{{ asset('assets') }}/plugins/animate/animate.min.css" rel="stylesheet" />
	<link href="{{ asset('assets') }}/css/one-page-parallax/style.min.css" rel="stylesheet" />
	<link href="{{ asset('assets') }}/css/one-page-parallax/style-responsive.min.css" rel="stylesheet" />
	<link href="{{ asset('assets') }}/css/one-page-parallax/theme/default.css" id="theme" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="{{ asset('assets') }}/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body data-spy="scroll" data-target="#header-navbar" data-offset="51">
    <!-- begin #page-container -->
    <div id="page-container" class="fade">
        <!-- begin #header -->
        <div id="header" class="header navbar navbar-transparent navbar-fixed-top">
            <!-- begin container -->
            <div class="container">
                <!-- begin navbar-header -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-navbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="#" class="navbar-brand">
                        <span class="brand-logo"></span>
                        <span class="brand-text">
                            <span class="text-theme">Lumbung</span> Desa
                        </span>
                    </a>
                </div>
                <!-- end navbar-header -->
                <!-- begin navbar-collapse -->
                <div class="collapse navbar-collapse" id="header-navbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#home" data-click="scroll-to-target">HOME</a></li>
                        <li><a href="#layanan" data-click="scroll-to-target">LAYANAN</a></li>
                        <li><a href="#about" data-click="scroll-to-target">TENTANG</a></li>
                        {{-- <li><a href="#pricing" data-click="scroll-to-target">PRODUK</a></li> --}}
                        <li><a href="/login">LOGIN</a></li>
                    </ul>
                </div>
                <!-- end navbar-collapse -->
            </div>
            <!-- end container -->
        </div>
        <!-- end #header -->

        <!-- begin #home -->
        <div id="home" class="content has-bg home">
            <!-- begin content-bg -->
            <div class="content-bg">
                <img src="{{ asset('assets') }}/img/bg/bg-home.jpg" alt="Home" />
            </div>
            <!-- end content-bg -->
            <!-- begin container -->
            <div class="container home-content">
                <h1>LUMBUNG DESA</h1>
                <h3>Memenuhi Kebutuhan Pangan Desamu</h3>
                <p>Lumbung Desa Sebelas Maret</p>
                {{-- <a href="#" class="btn btn-outline">Gabung </a><br /> --}}
            </div>
            <!-- end container -->
        </div>
        <!-- end #home -->
{{--
        <!-- begin #about -->
        <div id="about" class="content" data-scrollview="true">
            <!-- begin container -->
            <div class="container" data-animation="true" data-animation-type="fadeInDown">
                <h2 class="content-title">Tentang</h2>
                <p class="content-desc">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur eros dolor,<br />
                    sed bibendum turpis luctus eget
                </p>
                <!-- begin row -->
                <div class="row">
                    <!-- begin col-4 -->
                    <div class="col-md-4 col-sm-6">
                        <!-- begin about -->
                        <div class="about">
                            <h3>Our Story</h3>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Vestibulum posuere augue eget ante porttitor fringilla.
                                Aliquam laoreet, sem eu dapibus congue, velit justo ullamcorper urna,
                                non rutrum dolor risus non sapien. Vivamus vel tincidunt quam.
                                Donec ultrices nisl ipsum, sed elementum ex dictum nec.
                            </p>
                            <p>
                                In non libero at orci rutrum viverra at ac felis.
                                Curabitur a efficitur libero, eu finibus quam.
                                Pellentesque pretium ante vitae est molestie, ut faucibus tortor commodo.
                                Donec gravida, eros ac pretium cursus, est erat dapibus quam,
                                sit amet dapibus nisl magna sit amet orci.
                            </p>
                        </div>
                        <!-- end about -->
                    </div>
                    <!-- end col-4 -->
                    <!-- begin col-4 -->
                    <div class="col-md-4 col-sm-6">
                        <h3>Our Philosophy</h3>
                        <!-- begin about-author -->
                        <div class="about-author">
                            <div class="quote bg-silver">
                                <i class="fa fa-quote-left"></i>
                                <h3>We work harder,<br /><span>to let our user keep simple</span></h3>
                                <i class="fa fa-quote-right"></i>
                            </div>
                            <div class="author">
                                <div class="image">
                                    <img src="{{ asset('assets') }}/img/user/user-1.jpg" alt="Sean Ngu" />
                                </div>
                                <div class="info">
                                    Sean Ngu
                                    <small>Front End Developer</small>
                                </div>
                            </div>
                        </div>
                        <!-- end about-author -->
                    </div>
                    <!-- end col-4 -->
                    <!-- begin col-4 -->
                    <div class="col-md-4 col-sm-12">
                        <h3>Our Experience</h3>
                        <!-- begin skills -->
                        <div class="skills">
                            <div class="skills-name">Front End</div>
                            <div class="progress progress-striped">
                                <div class="progress-bar progress-bar-success" style="width: 95%">
                                    <span class="progress-number">95%</span>
                                </div>
                            </div>
                            <div class="skills-name">Programming</div>
                            <div class="progress progress-striped">
                                <div class="progress-bar progress-bar-success" style="width: 90%">
                                    <span class="progress-number">90%</span>
                                </div>
                            </div>
                            <div class="skills-name">Database Design</div>
                            <div class="progress progress-striped">
                                <div class="progress-bar progress-bar-success" style="width: 85%">
                                    <span class="progress-number">85%</span>
                                </div>
                            </div>
                            <div class="skills-name">Wordpress</div>
                            <div class="progress progress-striped">
                                <div class="progress-bar progress-bar-success" style="width: 80%">
                                    <span class="progress-number">80%</span>
                                </div>
                            </div>
                        </div>
                        <!-- end skills -->
                    </div>
                    <!-- end col-4 -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end #about -->

        <!-- begin #quote -->
        <div id="quote" class="content bg-black-darker has-bg" data-scrollview="true">
            <!-- begin content-bg -->
            <div class="content-bg">
                <img src="{{ asset('assets') }}/img/bg/bg-quote.jpg" alt="Quote" />
            </div>
            <!-- end content-bg -->
            <!-- begin container -->
            <div class="container" data-animation="true" data-animation-type="fadeInLeft">
                <!-- begin row -->
                <div class="row">
                    <!-- begin col-12 -->
                    <div class="col-md-12 quote">
                        <i class="fa fa-quote-left"></i> Passion leads to design, design leads to performance, <br />
                        performance leads to <span class="text-theme">success</span>!
                        <i class="fa fa-quote-right"></i>
                        <small>Sean Themes, Developer Teams in Malaysia</small>
                    </div>
                    <!-- end col-12 -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end #quote -->  --}}

        <!-- beign #layanan -->
        <div id="layanan" class="content" data-scrollview="true">
            <!-- begin container -->
            <div class="container">
                <h2 class="content-title">Layanan</h2>
                <p class="content-desc">
                    Lumbung Desa Sebelas Maret melayani :
                </p>
                <!-- begin row -->
                <div class="row">
                    <!-- begin col-4 -->
                    <div class="col-md-4 col-sm-4">
                        <div class="service">
                            <div class="icon bg-theme" data-animation="true" data-animation-type="bounceIn"><i class="fa fa-cog"></i></div>
                            <div class="info">
                                <h4 class="title">Pendataan Pra Panen</h4>
                                <p class="desc">Melakukan pendataan untuk modal lumbung desa.</p>
                            </div>
                        </div>
                    </div>
                    <!-- end col-4 -->
                    <!-- begin col-4 -->
                    <div class="col-md-4 col-sm-4">
                        <div class="service">
                            <div class="icon bg-theme" data-animation="true" data-animation-type="bounceIn"><i class="fa fa-shopping-cart"></i></div>
                            <div class="info">
                                <h4 class="title">Pembelian Hasil Panen</h4>
                                <p class="desc">Membeli hasil panen dari para petani yang terdaftar menjadi anggota lumbung.</p>
                            </div>
                        </div>
                    </div>
                    <!-- end col-4 -->
                    <!-- begin col-4 -->
                    <div class="col-md-4 col-sm-4">
                        <div class="service">
                            <div class="icon bg-theme" data-animation="true" data-animation-type="bounceIn"><i class="fa fa-shopping-cart"></i></div>
                            <div class="info">
                                <h4 class="title">Pembelian Pupuk</h4>
                                <p class="desc">Membeli produk pupuk dari suplier.</p>
                            </div>
                        </div>
                    </div>
                    <!-- end col-4 -->
                </div>
                <!-- end row -->
                <!-- begin row -->
                <div class="row">
                    <!-- begin col-4 -->
                    <div class="col-md-4 col-sm-4">
                        <div class="service">
                            <div class="icon bg-theme" data-animation="true" data-animation-type="bounceIn"><i class="fa fa-cog"></i></div>
                            <div class="info">
                                <h4 class="title">Pengelolaan Hasil Panen</h4>
                                <p class="desc">Melakukan pengolahan dari hasil panen yang dijualkan ke lumbung desa.</p>
                            </div>
                        </div>
                    </div>
                    <!-- end col-4 -->
                    <!-- begin col-4 -->
                    <div class="col-md-4 col-sm-4">
                        <div class="service">
                            <div class="icon bg-theme" data-animation="true" data-animation-type="bounceIn"><i class="fa fa-shopping-cart"></i></div>
                            <div class="info">
                                <h4 class="title">Penjualan Produk Hasil Pertanian</h4>
                                <p class="desc">Menjual produk hasil panen maupun produk pengolahan dari hasil panen.</p>
                            </div>
                        </div>
                    </div>
                    <!-- end col-4 -->
                    <!-- begin col-4 -->
                    <div class="col-md-4 col-sm-4">
                        <div class="service">
                            <div class="icon bg-theme" data-animation="true" data-animation-type="bounceIn"><i class="fa fa-shopping-cart"></i></div>
                            <div class="info">
                                <h4 class="title">Penjualan Pupuk</h4>
                                <p class="desc">Menjual berbagai jenis pupuk yang dibutuhkan para petani.</p>
                            </div>
                        </div>
                    </div>
                    <!-- end col-4 -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end #layanan -->

        {{-- <!-- beign #action-box -->
        <div id="action-box" class="content has-bg" data-scrollview="true">
            <!-- begin content-bg -->
            <div class="content-bg">
                <img src="{{ asset('assets') }}/img/bg/bg-action.jpg" alt="Action" />
            </div>
            <!-- end content-bg -->
            <!-- begin container -->
            <div class="container" data-animation="true" data-animation-type="fadeInRight">
                <!-- begin row -->
                <div class="row action-box">
                    <!-- begin col-9 -->
                    <div class="col-md-9 col-sm-9">
                        <div class="icon-large text-theme">
                            <i class="fa fa-binoculars"></i>
                        </div>
                        <h3>CHECK OUT OUR ADMIN THEME!</h3>
                        <p>
                           Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus faucibus magna eu lacinia eleifend.
                        </p>
                    </div>
                    <!-- end col-9 -->
                    <!-- begin col-3 -->
                    <div class="col-md-3 col-sm-3">
                        <a href="#" class="btn btn-outline btn-block">Live Preview</a>
                    </div>
                    <!-- end col-3 -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end #action-box -->

        <!-- begin #pricing -->
        <div id="pricing" class="content" data-scrollview="true">
            <!-- begin container -->
            <div class="container">
                <h2 class="content-title">Produk</h2>
                <p class="content-desc">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum consectetur eros dolor,<br />
                    sed bibendum turpis luctus eget
                </p>
                <!-- begin pricing-table -->
                <ul class="pricing-table col-4">
                    <li data-animation="true" data-animation-type="fadeInUp">
                    </li>
                    <li data-animation="true" data-animation-type="fadeInUp">
                        <div class="pricing-container">
                            <h3>Produk</h3>
                            <ul class="features">
                                <li>Padi A</li>
                                <li>Padi B</li>
                                <li>Beras A</li>
                                <li>Beras B</li>
                                <li>Jagung A</li>
                                <li>Jagung B</li>
                            </ul>
                        </div>
                    </li>
                    <li data-animation="true" data-animation-type="fadeInUp">
                        <div class="pricing-container">
                            <h3>Pupuk</h3>
                            <ul class="features">
                                <li>SP-36</li>
                                <li>KCl</li>
                                <li>NPK Phonska</li>
                                <li>Dolomite</li>
                                <li>ZK (Zwavelzure Kali)</li>
                                <li>Pupuk Kandang</li>
                            </ul>
                        </div>
                    </li>
                    <li data-animation="true" data-animation-type="fadeInUp">
                    </li>
                </ul>
            </div>
            <!-- end container -->
        </div>
        <!-- end #pricing --> --}}

        <!-- begin #contact -->
        <div id="contact" class="content bg-silver-lighter" data-scrollview="true">
            <!-- begin container -->
            <div class="container">
                <h2 id="about" class="content-title">Tentang</h2>
                <p class="content-desc">
                    Lumbung Desa merupakan program ketahanan pangan dalam bentuk gerakan pembentukan usaha produktif yang berbasis kepada potensi lokal pedesaan, seperti: sawah, kebun, ternak maupun home industry. Upaya ini diwujudkan melalui proses peningkatan produksi.
                </p>
                <!-- begin row -->
                <div class="row">
                    <!-- begin col-6 -->
                    <div class="col-md-6" data-animation="true" data-animation-type="fadeInLeft">
                        <h3>Lumbung Desa.</h3>
                        <p>
                            <strong>Alamat</strong><br />
                            Perumnas Palur, Jl. Jeruk 2 No.26<br />
                            Jawa Tengah 57731<br />
                        </p>
                        <p>
                            <span class="phone">+62 813 4343 5656</span><br />
                            <a href="lumbungdesa@email.com">lumbungdesa@email.com</a>
                        </p>
                    </div>
                    <!-- end col-6 -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end #contact -->

        <!-- begin #footer -->
        <div id="footer" class="footer">
            <div class="container">
                <div class="footer-brand">
                    <div class="footer-brand-logo"></div>
                    Lumbung Desa
                </div>
                <p>
                    &copy; Copyright Lumbung Desa 2022 <br />
                    {{-- An admin & front end theme with serious impact. Created by <a href="#">SeanTheme</a> --}}
                </p>
                {{-- <p class="social-list">
                    <a href="#"><i class="fa fa-facebook fa-fw"></i></a>
                    <a href="#"><i class="fa fa-instagram fa-fw"></i></a>
                    <a href="#"><i class="fa fa-twitter fa-fw"></i></a>
                    <a href="#"><i class="fa fa-google-plus fa-fw"></i></a>
                    <a href="#"><i class="fa fa-dribbble fa-fw"></i></a>
                </p> --}}
            </div>
        </div>
        <!-- end #footer -->

        <!-- begin theme-panel -->
        <div class="theme-panel">
            <a href="javascript:;" data-click="theme-panel-expand" class="theme-collapse-btn"><i class="fa fa-cog"></i></a>
            <div class="theme-panel-content">
                <ul class="theme-list clearfix">
                    <li><a href="javascript:;" class="bg-purple" data-theme="purple" data-theme-file="{{ asset('assets') }}/css/one-page-parallax/theme/purple.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Purple">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-blue" data-theme="blue" data-theme-file="{{ asset('assets') }}/css/one-page-parallax/theme/blue.css" data-theme-file="" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Blue">&nbsp;</a></li>
                    <li class="active"><a href="javascript:;" class="bg-green" data-theme-file="{{ asset('assets') }}/css/one-page-parallax/theme/default.css" data-theme-file="" data-theme="default" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Default">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-orange" data-theme="orange" data-theme-file="{{ asset('assets') }}/css/one-page-parallax/theme/orange.css" data-theme-file="" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Orange">&nbsp;</a></li>
                    <li><a href="javascript:;" class="bg-red" data-theme="red" data-theme-file="{{ asset('assets') }}/css/one-page-parallax/theme/red.css" data-theme-file="" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Red">&nbsp;</a></li>
                </ul>
            </div>
        </div>
        <!-- end theme-panel -->
    </div>
    <!-- end #page-container -->

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="{{ asset('assets') }}/plugins/jquery/jquery-3.2.1.min.js"></script>
	<script src="{{ asset('assets') }}/plugins/bootstrap3/js/bootstrap.min.js"></script>
	<!--[if lt IE 9]>
		<script src="assets/crossbrowserjs/html5shiv.js"></script>
		<script src="assets/crossbrowserjs/respond.min.js"></script>
		<script src="assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="{{ asset('assets') }}/plugins/js-cookie/js.cookie.js"></script>
	<script src="{{ asset('assets') }}/plugins/scrollMonitor/scrollMonitor.js"></script>
	<script src="{{ asset('assets') }}/js/one-page-parallax/apps.min.js"></script>
	<!-- ================== END BASE JS ================== -->

	<script>
	    $(document).ready(function() {
	        App.init();
	    });
	</script>
</body>
</html>
