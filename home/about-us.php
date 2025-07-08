<?php
session_start();
require_once './server/Home.php';

$server = new Home();
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <?php include './parts/css-links.php'; ?>
</head>

<body>
<header>
    <?php include './parts/header.php'; ?>
</header>
<!-- // Header  -->
<br>
<br>
<br>
<br>
<div id="page-title" class="padding-tb-30px gradient-white">
    <div class="container text-center">
        <ol class="breadcrumb opacity-5">
            <li><a href="#">Home</a></li>
            <li class="active">About</li>
        </ol>
        <h1 class="font-weight-300">About</h1>
    </div>
</div>


<section class="margin-tb-100px">
    <div class="container">

        <div class="row">

            <div class="col-lg-3 col-md-6 sm-mb-30px wow fadeInUp">
                <div class="service text-center opacity-hover-7 hvr-bob">
                    <div class="icon margin-bottom-10px">
                        <img src="assets/img/icon/service-1.png" alt="">
                    </div>
                    <h3 class="text-second-color">Reliable Places</h3>
                    <p class="text-grey-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy</p>
                </div>
            </div>


            <div class="col-lg-3 col-md-6 sm-mb-30px wow fadeInUp" data-wow-delay="0.2s">
                <div class="service text-center opacity-hover-7 hvr-bob">
                    <div class="icon margin-bottom-10px">
                        <img src="assets/img/icon/service-2.png" alt="">
                    </div>
                    <h3 class="text-second-color">High Credibility</h3>
                    <p class="text-grey-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy</p>
                </div>
            </div>


            <div class="col-lg-3 col-md-6 sm-mb-30px wow fadeInUp" data-wow-delay="0.4s">
                <div class="service text-center opacity-hover-7 hvr-bob">
                    <div class="icon margin-bottom-10px">
                        <img src="assets/img/icon/service-3.png" alt="">
                    </div>
                    <h3 class="text-second-color">Quick search</h3>
                    <p class="text-grey-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy</p>
                </div>
            </div>


            <div class="col-lg-3 col-md-6 sm-mb-30px wow fadeInUp" data-wow-delay="0.6s">
                <div class="service text-center opacity-hover-7 hvr-bob">
                    <div class="icon margin-bottom-10px">
                        <img src="assets/img/icon/service-4.png" alt="">
                    </div>
                    <h3 class="text-second-color">Know better</h3>
                    <p class="text-grey-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy</p>
                </div>
            </div>

        </div>

    </div>
</section>


<section class="padding-tb-80px background-second-color">
    <div class="container">
        <div class="row">

            <div class="col-lg-3">
                <div class="item text-white opacity-hover-7 hvr-bob border-right-1 wow fadeInUp">
                    <div class="opacity-hover-7 hvr-bob">
                        <div class="title margin-bottom-15px">
                            <h2> Unlimited Colors</h2>
                        </div>
                        <p class="opacity-5">Lorem ipsum dolor sit amet, no movet simul laoreet pri, aperiri fabulas
                            expetenda ei pro.</p>
                    </div>
                </div>
            </div>


            <div class="col-lg-3">
                <div class="item text-white border-right-1 wow fadeInUp">
                    <div class="opacity-hover-7 hvr-bob">
                        <div class="title margin-bottom-15px">
                            <h2>Powerful Website</h2>
                        </div>
                        <p class="opacity-5">Lorem ipsum dolor sit amet, no movet simul laoreet pri, aperiri fabulas
                            expetenda ei pro.</p>
                    </div>
                </div>
            </div>


            <div class="col-lg-3">
                <div class="item text-white border-right-1 wow fadeInUp">
                    <div class="opacity-hover-7 hvr-bob">
                        <div class="title margin-bottom-15px">
                            <h2>Responsive Design</h2>
                        </div>
                        <p class="opacity-5">Lorem ipsum dolor sit amet, no movet simul laoreet pri, aperiri fabulas
                            expetenda ei pro.</p>
                    </div>
                </div>
            </div>


            <div class="col-lg-3">
                <div class="item text-white wow fadeInUp">
                    <div class="opacity-hover-7 hvr-bob">
                        <div class="title margin-bottom-15px">
                            <h2>High Speed</h2>
                        </div>
                        <p class="opacity-5">Lorem ipsum dolor sit amet, no movet simul laoreet pri, aperiri fabulas
                            expetenda ei pro.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


<section class="padding-tb-100px background-white">
    <!-- Section Title -->
    <div class="container padding-bottom-40px">
        <div class="row justify-content-center text-center">
            <div class="col-md-7">
                <h2 class="text-grey-3 text-center">Our Clients</h2>
                <div class="margin-tb-30px text-grey-3 opacity-6">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus deserunt, nobis quae eos
                    provident quidem. Quaerat expedita dignissimos perferendis, nihil quo distinctio eius architecto
                    reprehenderit maiores.
                </div>
            </div>
        </div>
    </div>
    <!-- end Section Title -->

    <div class="container">
        <ul class="row clients-border no-gutters padding-0px margin-0px list-unstyled text-center">
            <li class="col-md-3 col-6 padding-tb-30px wow fadeInUp">
                <a href="#" class="hvr-bounce-out"><img src="assets/img/c1.jpg" alt=""></a>
            </li>
            <li class="col-md-3 col-6 padding-tb-30px wow fadeInUp" data-wow-delay="0.2s">
                <a href="#" class="hvr-bounce-out"><img src="assets/img/c2.jpg" alt=""></a>
            </li>
            <li class="col-md-3 col-6 padding-tb-30px wow fadeInUp" data-wow-delay="0.4s">
                <a href="#" class="hvr-bounce-out"><img src="assets/img/c3.jpg" alt=""></a>
            </li>
            <li class="col-md-3 col-6 padding-tb-30px wow fadeInUp" data-wow-delay="0.6s">
                <a href="#" class="hvr-bounce-out"><img src="assets/img/c4.jpg" alt=""></a>
            </li>
        </ul>
    </div>

</section>

<section class="padding-tb-100px background-main-color">
    <!-- Section Title -->
    <div class="container padding-bottom-40px">
        <div class="row justify-content-center text-center">
            <div class="col-md-7">
                <h2 class="text-white text-center">Get In Touch</h2>
                <div class="margin-tb-30px text-white opacity-6">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus deserunt, nobis quae eos
                    provident quidem. Quaerat expedita dignissimos perferendis, nihil quo distinctio eius architecto
                    reprehenderit maiores.
                </div>
            </div>
        </div>
    </div>
    <!-- end Section Title -->

    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <form class="dark-form">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Full Name</label>
                            <input type="text" class="form-control opacity-6" id="inputName4" placeholder="Name">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Email</label>
                            <input type="email" class="form-control opacity-6" id="inputEmail4" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control opacity-6" id="inputAddress" placeholder="1234 Main St">
                    </div>
                    <div class="form-group">
                        <label>Message</label>
                        <textarea class="form-control opacity-6" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <a href="#"
                       class="btn-sm btn-lg btn-block border-2 border-white text-white text-center font-weight-bold text-uppercase rounded-0 padding-15px">Send</a>
                </form>
            </div>
            <div class="col-lg-6">
                <p class="margin-top-20px text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Doloribus deserunt, nobis quae eos provident quidem. Quaerat expedita dignissimos perferendis, nihil
                    quo distinctio eius architecto reprehenderit maiores.</p>
                <ul class="margin-0px padding-0px list-unstyled opacity-6 text-white">
                    <li class="padding-tb-7px"><i class="far fa-hospital margin-right-10px"></i> Los Angeles - usa</li>
                    <li class="padding-tb-7px"><i class="far fa-map margin-right-10px"></i> 850 Algreef Street</li>
                    <li class="padding-tb-7px"><i class="far fa-bookmark margin-right-10px"></i> Los Angeles, USA 856987
                    </li>
                    <li class="padding-tb-7px"><i class="fas fa-phone margin-right-10px"></i> Tel: 123-456-7890</li>
                    <li class="padding-tb-7px"><i class="far fa-envelope-open margin-right-10px"></i> Info@site-name.com
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>


<!--footer-->
<?php include './parts/footer.php'; ?>

<!--scripts-->
<?php include './parts/js-links.php'; ?>
</body>


<!-- Mirrored from nilethemes.com/html/tabib/page-about.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 07 Nov 2019 12:29:49 GMT -->
</html>
