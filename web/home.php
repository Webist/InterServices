<?php
/* Example callback to the Controller *
// Notice, the $route variable is available.
// Instantiate the object
$test = new App\Controller\Test();
// Select the handler
$pageData = $test->pageDataHandler($route['indexKey']);
// Get the value
$title = $pageData->title();
var_dump($title);
/**/

?><!DOCTYPE html>
<!--[if IE 9]>
<html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en"> <!--<![endif]-->
<head>
    <title>Software Development Specialists - Ansoft.nl</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">

    <!-- Web Fonts -->
    <link rel="stylesheet" type="text/css"
          href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=cyrillic,latin">
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto:100,300,500,700&amp;subset=latin,cyrillic">

    <!-- CSS Global Compulsory -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/css/blocks.css">
    <link rel="stylesheet" href="assets/css/one.style.css">

    <!-- CSS Footer -->
    <link rel="stylesheet" href="assets/css/footers/footer-v7.css">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="assets/plugins/animate.css">
    <link rel="stylesheet" href="assets/plugins/line-icons/line-icons.css">
    <link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/plugins/pace-flash.css">
    <link rel="stylesheet" href="assets/plugins/owl-carousel2/assets/owl.carousel.css">
    <link rel="stylesheet" href="assets/plugins/cube-portfolio/cubeportfolio/css/cubeportfolio.min.css">
    <link rel="stylesheet" href="assets/plugins/cube-portfolio/cubeportfolio/custom/custom-cubeportfolio.css">

    <!-- CSS Theme -->
    <link rel="stylesheet" href="assets/css/architecture.style.css">

    <!-- CSS Customization -->
    <link rel="stylesheet" href="assets/css/custom.css">
</head>

<body id="body" data-spy="scroll" data-target=".one-page-header" class="demo-lightbox-gallery">
<!--=== Header ===-->
<nav class="one-page-header one-page-header-style-2 navbar navbar-default navbar-fixed-top architecture-nav one-page-nav-scrolling one-page-nav__fixed"
     role="navigation">
    <div class="container">
        <div class="page-scroll">
            <a class="logo-link navbar-brand logo-left" href="#intro"
               title="Self-organizing Software Development Partners">
                <img class="default-logo" src="assets/img/ansoft-logo-light.png" alt="AnSoft Logo light">
                <img class="shrink-logo" src="assets/img/ansoft-logo-dark.png" alt="AnSoft Logo dark">
            </a>
        </div>

        <div class="menu-container page-scroll">
            <button type="button" class="navbar-toggle pull-right" data-toggle="collapse"
                    data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="container no-padding-left ">
            <div class="row collapse navbar-collapse navbar-ex1-collapse">
                <div class="col-md-5 no-side-padding">
                    <div class="left">
                        <div class="menu-container">
                            <ul class="nav navbar-nav">
                                <li class="page-scroll home">
                                    <a href="#body">Home</a>
                                </li>
                                <li class="page-scroll">
                                    <a href="#about">Expertise</a>
                                </li>
                                <li class="page-scroll">
                                    <a href="#services">Werkwijze</a>
                                </li>

                                <li class="page-scroll">
                                    <a href="#markets">Development</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-2 no-side-padding">
                    <div class="center-block logo page-scroll">
                        <a class="logo-link navbar-brand logo-centered" href="#intro">
                            <img class="default-logo" src="assets/img/ansoft-logo-light.png" alt="AnSoft Logo light"
                                 title="Self-organizing Software Development Partners">
                            <img class="shrink-logo" src="assets/img/ansoft-logo-dark.png" alt="AnSoft Logo dark"
                                 title="Self-organizing Software Development Partners">
                        </a>
                    </div>
                </div>

                <div class="col-md-5 no-side-padding">
                    <div class="right">
                        <div class="menu-container">
                            <ul class="nav navbar-nav">
                                <li class="page-scroll">
                                    <a href="#mission">Missie</a>
                                </li>
                                <li class="page-scroll">
                                    <a href="#courses">AnSoft Academy</a>
                                </li>

                                <li class="page-scroll">
                                    <a href="#team">Partners</a>
                                </li>

                                <?php /*
									<li class="page-scroll home">
										<a href="#gallery">Processes</a>
									</li>
                                    */ ?>
                                <li class="page-scroll">
                                    <a href="#contact">Contact</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container -->
</nav>
<!--=== End Header ===-->

<!-- Promo block BEGIN -->
<section class="promo-section" id="intro">
    <!-- Fullscreen Static Image BEGIN -->
    <div class="fullscreen-static-image fullheight">
        <!-- Promo Content BEGIN -->
        <div class="container valign__middle">
            <div class="row">
                <div class="col-sm-12 text-center-xs g-heading-v7 text-center">
                    <h1 class="h2 g-mb-30"><em class="block-name">Software Development Specialists</em> AnSoft
                        <div class="block-name-ext">.nl</div>
                    </h1>
                </div>
            </div>
        </div>
        <!-- Promo Content END -->
    </div>
    <!-- Fullscreen Static Image END -->
</section>
<!-- Promo block END -->

<!--About Section-->
<section id="about">
    <div class="container content-lg">
        <div class="g-heading-v7 text-center">
            <h2 class="h2 g-mb-30"><em class="block-name">Kennis en Kunde </em>Onze Expertise </h2>
        </div>

        <!-- all for your comfort blocks -->
        <div class="row equal-height-columns">
            <div class="col-md-3 arch-service arch-service-1">
                <div class="arch-service-in img-hover-1 equal-height-column">
                    <span aria-hidden="true" class="icon-graph icon"></span>
                    <h3>Grip op de code-kwalitiet</h3>
                    <p>Continue aandacht voor technische uitmuntendheid en een goed ontwerp.

                        Senior Developers, Software Experts, Wij zijn specialisten en schrijven hoge-kwalitiet code.</p>
                    <button class="arch-service-btn" data-toggle="modal" data-target="#myModal">Lees Meer</button>
                </div>
            </div>

            <div class="col-md-3 arch-service arch-service-2">
                <div class="arch-service-in img-hover-2 equal-height-column">
                    <span aria-hidden="true" class="icon-users icon"></span>
                    <h3>Team Building</h3>
                    <p>Best architecturen, vereisten en ontwerpen komen uit zelforganiserende teams.
                        Projecten worden gebouwd rond gemotiveerde mensen, die moeten worden vertrouwd
                        We zijn leiders. Met team excellentie als doel coach de teamleden, bouwen gezond team cultuur en
                        realize commitment.</p>
                    <button class="arch-service-btn" data-toggle="modal" data-target="#myModal">Lees Meer</button>
                </div>
            </div>

            <div class="col-md-3 arch-service arch-service-3">
                <div class="arch-service-in img-hover-3 equal-height-column">
                    <span aria-hidden="true" class="icon-target icon"></span>
                    <h3>UX</h3>
                    <p>Eenvoud; maximaliseren van hoeveelheid "dat werk is niet nodig" is een kunst. Klanttevredenheid
                        door vroege en continue aflevering van waardevolle software.
                        Close, dagelijkse samenwerking tussen mensen uit het bedrijfsleven en ontwikkelaars.
                        We bestuderen gebruikers ervaring (User Experience). Study Competitors and know the Market. We
                        define the Return on Assets </p>
                    <button class="arch-service-btn" data-toggle="modal" data-target="#myModal">Lees Meer</button>
                </div>
            </div>

            <div class="col-md-3 arch-service arch-service-4">
                <div class="arch-service-in img-hover-4 equal-height-column">
                    <span aria-hidden="true" class="icon-bar-chart icon"></span>
                    <h3>Evaluatie</h3>
                    <p>
                        Regelmatig reflecteren over hoe om effectiever te worden, en dienovereenkomstig aangepast.
                        Werkende software is de belangrijkste maatregel van de vooruitgang.
                        Analyse Componenten. re-Define and Plan re-architecture/re-design components to remove the
                        Techinal Debt.</p>
                    <button class="arch-service-btn" data-toggle="modal" data-target="#myModal">Lees Meer</button>
                </div>
            </div>
        </div>

        <!-- modal popup window -->
        <div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel" aria-hidden="true">
            <button aria-hidden="true" data-dismiss="modal" class="close" type="button"><i class="fa fa-times"></i>
            </button>
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="modal-top margin-bottom-40">
                            <!--img src="assets/img-temp/wp1.jpg" alt=""-->
                        </div>

                        <div class="modal-bot g-heading-v7">
                            <h3 class="g-color-white">Omom sociis natoque penatibus</h3>
                            <p class="margin-bottom-30">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean
                                commodo ligula eget dolor. Aenean massa. Omom sociis natoque penatibus.Lorem ipsum dolor
                                sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.
                                Omom sociis natoque penatibus.</p>

                            <p class="margin-bottom-30">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean
                                commodo ligula eget dolor. Aenean massa. Omom sociis natoque penatibus.Lorem ipsum dolor
                                sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p>

                            <p class="margin-bottom-30"><img src="assets/img-temp/wp5.jpg" alt=""></p>

                            <p class="margin-bottom-30">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean
                                commodo ligula eget dolor. Aenean massa. Omom sociis natoque penatibus.Lorem ipsum dolor
                                sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p>

                            <p class="margin-bottom-30">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean
                                commodo ligula eget dolor. Aenean massa. Omom sociis natoque penatibus.Lorem ipsum dolor
                                sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End of About Section-->

<!--Services Section-->
<section id="services" class="bg-color-com">
    <div class="container-fluid bg-color-com service-section">
        <div class="container content-lg">

            <div class="row  g-heading-v7 text-center">
                <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
                    <h2 class="h2 g-color-white g-mb-30"><em class="block-name">Methodiek </em> Ons werkwijze </h2>

                </div>
            </div>

            <!-- Owl Carousel v4 we create amazing things-->
            <div class="owl-carousel-v4 owl-theme">
                <div class="owl-slider-v4">

                    <div class="item">
                        <img src="assets/img-temp/Self-Organizing-Partners.png" alt="">

                        <p class="owl-p g-color-white-darker">
                            Met self-organizing <strike>team</strike> partners onze team is dynamisch.
                            Afhankelijk van het project of project-fase zijn er een of meer mensen bij aanwezig en
                            betrokken.

                        </p>

                    </div>

                    <div class="item">
                        <img src="assets/img-temp/regulative-cyclus.jpg" alt="">

                        <p class="owl-p g-color-white-darker">
                            Regulatieve cyclus (Probleemstelling, Diagnose, Plan(ontwerp), Implementatie, Evaluatie)
                            issues in applicatie infrastructuur,
                        </p>

                    </div>

                    <div class="item">
                        <img src="assets/img-temp/owl-1.png" alt="">

                        <p class="owl-p g-color-white-darker">
                            Advies rondom applicatie binnen de projecten,
                            Recommodatie nieuw code of hergebruik,
                        </p>

                    </div>

                    <div class="item">
                        <img src="assets/img-temp/owl-1.png" alt="">

                        <p class="owl-p g-color-white-darker">
                            Technische behoefte requirements opstellen,
                            Coordinatie gewenste verbeteringen,
                        </p>

                    </div>

                    <div class="item">
                        <img src="assets/img-temp/owl-1.png" alt="">

                        <p class="owl-p g-color-white-darker">
                            Functioneel en Technisch Ontwerp,
                            Participatie data architectuur design, performance monitoring,
                            product evaluatie, Integratie methodologie
                        </p>

                    </div>

                    <div class="item">
                        <img src="assets/img-temp/owl-1.png" alt="">

                        <p class="owl-p g-color-white-darker">
                            Quality Assurance,
                            RFC (Request for Change) opstellen,
                        </p>

                    </div>


                </div>
            </div>
            <!-- End Owl Carousel v4 -->
        </div>
    </div>
</section>
<!--End of Services Section-->
<?php /**/ ?>
<!--markets Section-->
<section id="markets">
    <div class="container-fluid no-side-padding content-md">
        <div class="container g-heading-v7 text-center">
            <h2 class="h2 g-mb-30"><em class="block-name">Development </em>Realisatie </h2>
        </div>

        <!-- markets cube-portfolio/ what we did -->
        <div id="grid-container">
            <div class="cbp-item">
                <!-- data-title attribute will be used to populate lightbox caption -->
                <div class="cbp-caption">
                    <a class="cbp-lightbox" title="Maatwerk Webapplicatie Development"
                       data-title="<h3><em>Web Applicaties </em> Specifieke Weboplossingen</h3>"
                       href="assets/img-temp/projects/img1.jpg">
                        <img src="assets/img-temp/projects/img1.jpg" alt="">
                        <div class="popup-title">
                            <h3><em>Web Applicaties </em> Specifieke Weboplossingen</h3>
                        </div>
                    </a>
                </div>
            </div>

            <div class="cbp-item">
                <div class="cbp-caption">
                    <a class="cbp-lightbox" title="PHP Software Development"
                       data-title="<h3><em>PHP Software </em>Management Systeem </h3>"
                       href="assets/img-temp/projects/img5.jpg">
                        <img src="assets/img-temp/projects/img5.jpg" alt="">
                        <div class="popup-title">
                            <h3><em>PHP Software </em>Management Systeem </h3>
                        </div>
                    </a>
                </div>
            </div>

            <div class="cbp-item">
                <div class="cbp-caption">
                    <a class="cbp-lightbox" title="SOAP / REST API Development"
                       data-title="<h3><em>Web Services </em>SOAP / REST API development </h3>"
                       href="assets/img-temp/projects/img2.jpg">
                        <img src="assets/img-temp/projects/img2.jpg" alt="">
                        <div class="popup-title">
                            <h3><em>Web Services </em> SOAP / REST API</h3>
                        </div>
                    </a>
                </div>
            </div>

            <div class="cbp-item">
                <div class="cbp-caption">
                    <a class="cbp-lightbox" title="Web Portal Development"
                       data-title="<h3><em>Intranet </em>Web Portal </h3>" href="assets/img-temp/projects/img3.jpg">
                        <img src="assets/img-temp/projects/img3.jpg" alt="">
                        <div class="popup-title">
                            <h3><em>Intranet </em>Web Portal </h3>
                        </div>
                    </a>
                </div>
            </div>

            <div class="cbp-item">
                <div class="cbp-caption">
                    <a class="cbp-lightbox" title="Online Business Platform Development"
                       data-title="<h3><em>E-commerce </em> Online Business Platform </h3>"
                       href="assets/img-temp/projects/img4.jpg">
                        <img src="assets/img-temp/projects/img4.jpg" alt="">
                        <div class="popup-title">
                            <h3><em>E-Commerce </em>Online Business Platform </h3>
                        </div>
                    </a>
                </div>
            </div>

            <div class="cbp-item">
                <div class="cbp-caption">
                    <a class="cbp-lightbox" title="Marketing Platform Integratie Development"
                       data-title="<h3><em>API Integratie </em>Marketing Platform Integratie </h3>"
                       href="assets/img-temp/projects/img1.jpg">
                        <img src="assets/img-temp/projects/img1.jpg" alt="">
                        <div class="popup-title">
                            <h3><em>API Integratie </em>Marketing Platform Integratie </h3>
                        </div>
                    </a>
                </div>
            </div>


            <div class="cbp-item">
                <div class="cbp-caption">
                    <a class="cbp-lightbox" title="Social Media Integratie Development"
                       data-title="<h3><em>API Integratie </em>Social Media Integratie </h3>"
                       href="assets/img-temp/projects/img1.jpg">
                        <img src="assets/img-temp/projects/img1.jpg" alt="">
                        <div class="popup-title">
                            <h3><em>API Integratie </em>Social Media Integratie </h3>
                        </div>
                    </a>
                </div>
            </div>

            <div class="cbp-item">
                <div class="cbp-caption">
                    <a class="cbp-lightbox" title="Booking System Integratie Development"
                       data-title="<h3><em>API Integratie </em>Booking System Integratie </h3>"
                       href="assets/img-temp/projects/img1.jpg">
                        <img src="assets/img-temp/projects/img1.jpg" alt="">
                        <div class="popup-title">
                            <h3><em>API Integratie </em>Booking System Integratie </h3>
                        </div>
                    </a>
                </div>
            </div>

            <div class="cbp-item">
                <div class="cbp-caption">
                    <a class="cbp-lightbox" title="Machine Learning Integratie Development"
                       data-title="<h3><em>Machine Learning Integratie </em>Machine Learning Integratie </h3>"
                       href="assets/img-temp/projects/img1.jpg">
                        <img src="assets/img-temp/projects/img1.jpg" alt="">
                        <div class="popup-title">
                            <h3><em>API Integratie </em>Machine Learning Integratie </h3>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>
<!--End of markets Section-->


<!--mission Section-->
<section id="mission">
    <div class="container-fluid bg-color-com service-section">
        <div class="container content-md">

            <div class="row  g-heading-v7 text-center">
                <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
                    <h2 class="h2 g-color-white g-mb-30"><em class="block-name">Ons Missie </em>Mission Statement</h2>
                </div>
            </div>


            <!-- blocks -->
            <div class="row equal-height-columns">
                <div class="col-md-3 arch-service arch-service-1">
                    <div class="arch-service-in img-hover-1 equal-height-column">
                        <span aria-hidden="true" class="icon-graph icon"></span>
                        <h3>Vakmanschap</h3>
                        <p>Materie goed begrijpen ... meesterschap </p>
                        <button class="arch-service-btn" data-toggle="modal" data-target="#myModal">Lees Meer</button>
                    </div>
                </div>

                <div class="col-md-3 arch-service arch-service-2">
                    <div class="arch-service-in img-hover-1 equal-height-column">
                        <span aria-hidden="true" class="icon-graph icon"></span>
                        <h3>Mentoring</h3>
                        <p>We zijn creatieve mensen ... zelfvertrouwen </p>
                        <button class="arch-service-btn" data-toggle="modal" data-target="#myModal">Lees Meer</button>
                    </div>
                </div>

                <div class="col-md-3 arch-service arch-service-3">
                    <div class="arch-service-in img-hover-1 equal-height-column">
                        <span aria-hidden="true" class="icon-graph icon"></span>
                        <h3>Team Building</h3>
                        <p>Ieder mens is anders ... cultuur opbouwen ... happy team-work</p>

                        <p> ...</p>
                        <button class="arch-service-btn" data-toggle="modal" data-target="#myModal">Lees Meer</button>
                    </div>
                </div>
                <div class="col-md-3 arch-service arch-service-3">
                    <div class="arch-service-in img-hover-1 equal-height-column">
                        <span aria-hidden="true" class="icon-graph icon"></span>
                        <h3>Samenwerking</h3>
                        <p>Samenwerken met mensen met vergelijkbaar gemeenschappelijke doe.
                            Niet alleen samenwerking met de klanten, maar ook productieve partners.</p>

                        <p> ...</p>
                        <button class="arch-service-btn" data-toggle="modal" data-target="#myModal">Lees Meer</button>
                    </div>
                </div>
            </div>


        </div>
    </div>
</section>
<!--End of mission Section-->

<?php /*
	<!--Gallery Section-->
	<section id="gallery">
		<div class="gallery-section">
			<div class="container content-md g-heading-v7 text-center">
				<h2 class="h2 g-mb-30"><em class="block-name">Work process</em> How we work</h2>

				<!-- Tab v2 -->
				<div class="tab-v2">
					<div class="tab-content">
						<div class="tab-pane fade in active g-mb-100" id="discuss-1">
							<!-- Owl Carousel v4 tab content-->
							<div class="owl-carousel-v4 owl-theme">
								<div class="owl-slider-v4-gallery">
									<div class="item">
										<img src="assets/img-temp/wp1.jpg" alt="">
										<h3>Projects of resdential buildings</h3>
										<p class="g-color-black-lighter">Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Etiam sit amet orci eget eros.</p>
									</div>

									<div class="item">
										<img src="assets/img-temp/wp2.jpg" alt="">
										<h3>Projects of resdential buildings</h3>
										<p class="g-color-black-lighter">Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Etiam sit amet orci eget eros.</p>
									</div>

									<div class="item">
										<img src="assets/img-temp/wp3.jpg" alt="">
										<h3>Projects of resdential buildings</h3>
										<p class="g-color-black-lighter">Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Etiam sit amet orci eget eros.</p>
									</div>
								</div>
							</div>
							<!-- End Owl Carousel v4 -->
						</div>

						<div class="tab-pane fade in static-tab" id="concept-1">
							<img src="assets/img-temp/wp4.jpg" alt="">
							<h3>Projects of resdential buildings</h3>
							<p class="g-color-black-lighter">Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Etiam sit amet orci eget eros.</p>
							<!-- End Owl Carousel v4 -->
						</div>

						<div class="tab-pane fade in static-tab" id="modeling-1">
							<img src="assets/img-temp/wp5.jpg" alt="">
							<h3>Projects of resdential buildings</h3>
							<p class="g-color-black-lighter">Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Etiam sit amet orci eget eros.</p>
							<!-- End Owl Carousel v4 -->
						</div>

						<div class="tab-pane fade in static-tab" id="clients-1">
							<img src="assets/img-temp/wp6.jpg" alt="">
							<h3>Projects of resdential buildings</h3>
							<p class="g-color-black-lighter">Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Etiam sit amet orci eget eros.</p>
							<!-- End Owl Carousel v4 -->
						</div>

						<ul class="nav nav-tabs">
							<li class="active"><a class="tab-1" href="#discuss-1" data-toggle="tab">
								<strong>Discuss</strong>
								<span class="g-color-white-darker">Lorem ipsum dolor sit amet.</span>
							</a>
							</li>
							<li><a class="tab-2" href="#concept-1" data-toggle="tab">
								<strong>Creative concept</strong>
								<span class="g-color-white-darker">Lorem ipsum dolor sit amet.</span>
							</a>
							</li>
							<li><a class="tab-3" href="#modeling-1" data-toggle="tab">
								<strong>3D modeling</strong>
								<span class="g-color-white-darker">Lorem ipsum dolor sit amet.</span>
							</a>
							</li>
							<li><a class="tab-4" href="#clients-1" data-toggle="tab">
								<strong>Happy clients</strong>
								<span class="g-color-white-darker">Lorem ipsum dolor sit amet.</span>
							</a>
							</li>
						</ul>
					</div>
				</div>
				<!-- End Tab v2 -->
			</div>

			<div class="container-fluid bg-color-com content-md no-side-padding">
				<div class="container">
					<div class="row g-mb-50 g-heading-v7 text-center">
						<div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
							<h2 class="h2 g-color-white g-mb-30"><em class="block-name">Our technologies</em> How we create</h2>
							<p class="g-color-white-darker">Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum.</p>
						</div>
					</div>
				</div>

				<!-- Owl Carousel v4 gallery-->
				<div class="owl-carousel-v4 owl-theme">
					<div class="owl-slider-v4-gallery-2">
						<div class="item">
							<img src="assets/img-temp/ot1.jpg" alt="">
							<h3><a href="#">Projects of resdential buildings</a></h3>
							<p class="g-color-white-darker">Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt.</p>
						</div>

						<div class="item">
							<img src="assets/img-temp/ot2.jpg" alt="">
							<h3><a href="#">Projects of resdential buildings</a></h3>
							<p class="g-color-white-darker">Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt.</p>
						</div>

						<div class="item">
							<img src="assets/img-temp/ot3.jpg" alt="">
							<h3><a href="#">Projects of resdential buildings</a></h3>
							<p class="g-color-white-darker">Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt.</p>
						</div>

						<div class="item">
							<img src="assets/img-temp/ot4.jpg" alt="">
							<h3><a href="#">Projects of resdential buildings</a></h3>
							<p class="g-color-white-darker">Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt.</p>
						</div>

						<div class="item">
							<img src="assets/img-temp/ot5.jpg" alt="">
							<h3><a href="#">Projects of resdential buildings</a></h3>
							<p class="g-color-white-darker">Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt.</p>
						</div>

						<div class="item">
							<img src="assets/img-temp/ot6.jpg" alt="">
							<h3><a href="#">Projects of resdential buildings</a></h3>
							<p class="g-color-white-darker">Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt.</p>
						</div>

						<div class="item">
							<img src="assets/img-temp/ot1.jpg" alt="">
							<h3><a href="#">Projects of resdential buildings</a></h3>
							<p class="g-color-white-darker">Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt.</p>
						</div>

						<div class="item">
							<img src="assets/img-temp/ot2.jpg" alt="">
							<h3><a href="#">Projects of resdential buildings</a></h3>
							<p class="g-color-white-darker">Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt.</p>
						</div>

						<div class="item">
							<img src="assets/img-temp/ot3.jpg" alt="">
							<h3><a href="#">Projects of resdential buildings</a></h3>
							<p class="g-color-white-darker">Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt.</p>
						</div>
					</div>
				</div>
				<!-- End Owl Carousel v4 -->
			</div>
		</div>
	</section>
	<!--End of Gallery Section-->
*/ ?><?php /** */ ?>
    <!--courses Section-->
<section id="courses">
    <div class="awards-section">
        <div class="container content-md">
            <div class="row">
                <div class="col-md-3 g-heading-v7 text-center">
                    <h2 class="h2 g-mb-30"><em class="block-name">AnSoft Academy </em></h2>
                    <p class="g-mb-30"></p>
                    <p></p>
                </div>

                <!-- courses -->
                <div class="col-md-9 awards-desc">
                    <div class="row">
                        <div class="col-md-4 award-div">
                            <img src="assets/img-temp/aw1.png" alt="">
                            <em>Lecture - Tutorial</em>
                            <h3>Getting Ready for PHP 7</h3>
                            <a href="https://www.digitalocean.com/company/blog/getting-ready-for-php-7/"
                               target="_blank">Link openen</a>
                        </div>

                        <div class="col-md-4 award-div">
                            <img src="assets/img-temp/aw2.png" alt="">
                            <em>Workshop - Development</em>
                            <h3>M.O.M (Machine Object Modeling)</h3>
                            <!--a href="#">View project</a-->
                        </div>

                        <div class="col-md-4 award-div">
                            <img src="assets/img-temp/aw3.png" alt="">
                            <em>Workshop - Scrum </em>
                            <h3>Retrospective</h3>
                            <!--a href="#">View project</a-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php /**
         * <div class="container-fluid bg-color-com content-md">
         * <div class="container">
         * <!-- Clients -->
         * <div class="row">
         * <div class="col-md-9 col-sm-9 clients">
         * <ul class="list-unstyled clients-list">
         * <li class="client-cell first-cell"><a href="#">
         * <img class="img-responsive" src="assets/img-temp/clients/1.png" alt=""></a>
         * </li>
         * <li class="client-cell second-cell"><a href="#">
         * <img class="img-responsive" src="assets/img-temp/clients/2.png" alt=""></a>
         * </li>
         * <li class="client-cell third-cell"><a href="#">
         * <img class="img-responsive" src="assets/img-temp/clients/3.png" alt=""></a>
         * </li>
         * <li class="client-cell fourth-cell"><a href="#">
         * <img class="img-responsive" src="assets/img-temp/clients/4.png" alt=""></a>
         * </li>
         * <li class="client-cell fifth-cell"><a href="#">
         * <img class="img-responsive" src="assets/img-temp/clients/5.png" alt=""></a>
         * </li>
         * <li class="client-cell sixth-cell"><a href="#">
         * <img class="img-responsive" src="assets/img-temp/clients/6.png" alt=""></a>
         * </li>
         * <li class="client-cell seventh-cell"><a href="#">
         * <img class="img-responsive" src="assets/img-temp/clients/7.png" alt=""></a>
         * </li>
         * <li class="client-cell last-cell"><a href="#">
         * <img class="img-responsive" src="assets/img-temp/clients/8.png" alt=""></a>
         * </li>
         * </ul>
         * </div>
         *
         * <div class="col-md-3 col-sm-3 content-md">
         * <!-- Owl Carousel v4 testomonials-->
         * <div class="owl-carousel-v4 owl-theme g-ml-20">
         * <div class="owl-slider-v4-testo">
         * <div class="item">
         * <img src="assets/img-temp/testo1.jpg" alt="">
         * <p>Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt.Nullam quis ante. Etiam sit amet orci.</p>
         * <h3>Vanessa Igrek <em class="g-color-white-darker">Gray consultant corp</em></h3>
         * </div>
         *
         * <div class="item">
         * <img src="assets/img-temp/testo2.jpg" alt="">
         * <p class="owl-p">Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Nullam quis ante. Etiam sit amet orci.</p>
         * <h3>Dorian Grey <em class="g-color-white-darker">Gray consultant corp</em></h3>
         * </div>
         *
         * <div class="item">
         * <img src="assets/img-temp/testo3.jpg" alt="">
         * <p class="owl-p">Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Nullam quis ante. Etiam sit amet orci.</p>
         * <h3>Nick Rush <em class="g-color-white-darker">Gray consultant corp</em></h3>
         * </div>
         * </div>
         * </div>
         * <!-- End Owl Carousel v4 -->
         * </div>
         * </div>
         * </div>
         * </div>
         */ ?>
    </div>
</section>
<!--End of courses Section-->


<!--Team Section-->
    <section id="team">
        <div class="container-fluid team-section bg-color-com">
            <div class="container content-md g-heading-v7 text-center">
                <h2 class="h2 g-color-white g-mb-30"><em class="block-name">Samenwerkende Partners</em> Werken met
                    professionals</h2>

                <!-- Owl Carousel v4 team -->
                <div class="owl-carousel-v4 owl-theme">
                    <div class="owl-slider-v4-team">
                        <div class="item">
                            <img class="img-responsive" src="assets/img-temp/t1.jpg" alt="">
                            <small class="owl-small">Technical Supervisor</small>
                            <span class="owl-span">James Novel</span>
                            <ul class="list-inline owl-list">
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#" class="fb"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>

                        <div class="item">
                            <img class="img-responsive" src="assets/img-temp/t2.jpg" alt="">
                            <small class="owl-small">Technical Director</small>
                            <span class="owl-span">Catrina Wearner</span>
                            <ul class="list-inline owl-list">
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#" class="fb"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>

                        <div class="item">
                            <img class="img-responsive" src="assets/img-temp/t5.jpg" alt="">
                            <small class="owl-small">Technical Manager</small>
                            <span class="owl-span">Fiona Biloti</span>
                            <ul class="list-inline owl-list">
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#" class="fb"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>

                        <div class="item">
                            <img class="img-responsive" src="assets/img-temp/t9.jpg" alt="">
                            <small class="owl-small">Head of Secretory</small>
                            <span class="owl-span">Samuel Calven</span>
                            <ul class="list-inline owl-list">
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#" class="fb"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>

                        <div class="item">
                            <img class="img-responsive" src="assets/img-temp/t4.jpg" alt="">
                            <small class="owl-small">Human Resources Manager</small>
                            <span class="owl-span">George Manuel</span>
                            <ul class="list-inline owl-list">
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#" class="fb"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>

                        <div class="item">
                            <img class="img-responsive" src="assets/img-temp/t6.jpg" alt="">
                            <small class="owl-small">Chief Interior Designer</small>
                            <span class="owl-span">Salma Irek</span>
                            <ul class="list-inline owl-list">
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#" class="fb"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>

                        <div class="item">
                            <img class="img-responsive" src="assets/img-temp/t8.jpg" alt="">
                            <small class="owl-small">Chief Engineer</small>
                            <span class="owl-span">Carl Sanchez</span>
                            <ul class="list-inline owl-list">
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#" class="fb"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>

                        <div class="item">
                            <img class="img-responsive" src="assets/img-temp/t3.jpg" alt="">
                            <small class="owl-small">Finance Manager</small>
                            <span class="owl-span">Julia Dolly</span>
                            <ul class="list-inline owl-list">
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#" class="fb"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- End Owl Carousel v4 -->
            </div>
        </div>
    </section>
    <!--End of Team Section-->


<?php /**/ ?>
<!--Contact Section-->
<section id="contact">
    <div class="container content-md g-heading-v7 text-center">
        <h2 class="h2 g-mb-30"><em class="block-name">Contact </em>Vraag ons </h2>

        <!-- form and contatc information -->
        <div class="row">
            <div class="col-md-9 col-sm-6 form no-side-padding">
                <form action="#" method="post" id="sky-form3" class="sky-form contact-style">
                    <fieldset>
                        <div class="row margin-bottom-30">
                            <div class="col-md-6 col-md-offset-0">
                                <div>
                                    <input type="text" name="name" id="name" class="form-control"
                                           placeholder="Your Name">
                                </div>
                            </div>
                            <div class="col-md-6 col-md-offset-0">
                                <div>
                                    <input type="text" name="phone" id="phone" class="form-control"
                                           placeholder="Your Phone">
                                </div>
                            </div>
                        </div>

                        <div class="row margin-bottom-30">
                            <div class="col-md-6 col-md-offset-0">
                                <div>
                                    <input type="text" name="email" id="email" class="form-control"
                                           placeholder="Email *">
                                </div>
                            </div>

                            <div class="col-md-6 col-md-offset-0">
                                <div>
                                    <input type="text" name="subject" id="subject" class="form-control"
                                           placeholder="Subject">
                                </div>
                            </div>
                        </div>

                        <div class="row margin-bottom-30">
                            <div class="col-md-12 col-md-offset-0">
                                <div>
                                    <textarea rows="4" name="message" id="message"
                                              class="form-control g-textarea-noresize" placeholder="Message"></textarea>
                                </div>
                            </div>
                        </div>

                        <p>
                            <button type="submit" class="btn-u btn-u-lg btn-u-bg-default btn-u-upper">Send Message
                            </button>
                        </p>
                    </fieldset>

                    <div class="message">
                        <i class="rounded-x fa fa-check"></i>
                        <p>Uw bericht is successvol verzonden!</p>
                    </div>
                </form>
            </div>

            <div class="col-md-3 col-sm-6 contact-list">
                <ul class="list-unstyled margin-bottom-30">
                    <li><span aria-hidden="true" class="icon-directions icon"></span></li>
                    <li class="first-item">Adres</li>
                    <li class="second-item">Harpstraat 38<br/> 5642RB Eindhoven</li>
                </ul>

                <ul class="list-unstyled margin-bottom-30">
                    <li><span aria-hidden="true" class="icon-call-in icon"></span></li>
                    <li class="first-item">Telefoon</li>
                    <li class="second-item">+31 6 555 383 93</li>
                </ul>

                <ul class="list-unstyled margin-bottom-30">
                    <li><span aria-hidden="true" class="icon-envelope-open icon"></span></li>
                    <li class="first-item">Email</li>
                    <li class="second-item">info@ansoft.nl</li>
                </ul>

            </div>
        </div>
    </div>

    <div class="container-fluid no-side-padding">
        <!-- google maps -->
        <!-- 			<div class="map-div">
                        <i class="fa fa-map-marker icon"></i>
                        <button class="map-btn show-map" id="MapBtn" data-toggle="collapse" data-target="#map-wrapper">
                        Show map</button>
                    </div>

                    <div class="collapse" id="map-wrapper">
                        <div id="map"></div>
                    </div> -->
        <div id="map-wrapper">
            <div id="map"></div>
        </div>
    </div>

    <!-- copyrights -->
    <div class="copyrights container-fluid bg-color-com page-scroll">
        <div clas="container">
            <a class="footer-logo" href="#intro" title="Self-organizing Software Development Partners">
                <img class="img-responsive" src="assets/img/ansoft-logo-light.png" alt="AnSoft Logo">
            </a>
            <?php /**
             * <ul class="list-inline footer-list">
             * <li><a href="#"><i class="fa fa-twitter"></i></a></li>
             * <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
             * <li><a href="#"><i class="fa fa-facebook"></i></a></li>
             * <li><a href="#"><i class="fa fa-instagram"></i></a></li>
             * <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
             * </ul>
             */ ?>
        </div>
    </div>
</section>
<!--End of Contact Section-->

<!-- JS Global Compulsory -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<script src="assets/plugins/jquery/jquery-migrate.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- JS Implementing Plugins -->
<script src="assets/plugins/smoothScroll.js"></script>
<script src="assets/plugins/jquery.easing.min.js"></script>
<script src="assets/plugins/pace/pace.min.js"></script>
<script src="assets/plugins/owl-carousel2/owl.carousel.min.js"></script>
<script src="assets/plugins/sky-forms-pro/skyforms/js/jquery.form.min.js"></script>
<script src="assets/plugins/sky-forms-pro/skyforms/js/jquery.validate.min.js"></script>
<script src="assets/plugins/cube-portfolio/cubeportfolio/js/jquery.cubeportfolio.min.js"></script>
<script src="assets/plugins/modernizr.js"></script>
<script src="assets/plugins/backstretch/jquery.backstretch.min.js"></script>
<!--script src="https://maps.googleapis.com/maps/api/js?signed_in=true&amp;callback=initMap" async defer></script><script src="assets/js/plugins/gmaps-ini.js"></script-->

<!-- JS Page Level-->
<script src="assets/js/one.app.js"></script>
<script src="assets/js/plugins/pace-loader.js"></script>
<script src="assets/js/plugins/owl-carousel2.js"></script>
<script src="assets/js/plugins/cube-portfolio-lightbox.js"></script>
<script src="assets/js/plugins/promo.js"></script>
<script src="assets/js/forms/contact.js"></script>
<script>
    $(function () {
        App.init();
        OwlCarousel.initOwlCarousel();
        ContactForm.initContactForm();
    });
</script>
<!--[if lt IE 10]>
<script src="assets/plugins/sky-forms-pro/skyforms/js/jquery.placeholder.min.js"></script>
<![endif]-->
</body>
</html>
