<?php
session_start();

require_once './server/Home.php';

$server = new Home();
$searchError = "";

$category = $server->category_data();
$test = $server->test_data();

if(isset($_POST['submit'])){

    if($_POST['option'] == 'Doctor'){
        header('location:doctors.php');
    }elseif($_POST['option'] == 'Lab'){
        header('location:index.php#modal3');
    }elseif($_POST['option'] == 'Pharmacy'){
        header('location:index.php#modal2');
    }

}

?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <?php include './parts/css-links.php'; ?>
    <style>
        form {
            font-family: 'Titillium Web', sans-serif;
        }
    </style>
</head>

<body>
<header>
    <?php include './parts/header.php'; ?>
</header>
<!-- // Header  -->

<section class="banner padding-tb-200px sm-ptb-80px background-overlay"
         style="background-image: url('assets/img/banner_1.jpg');">
    <div class="container z-index-2 position-relative">
        <div class="title">
            <h1 class="text-title-large text-main-color font-weight-300 margin-bottom-15px">Health Directory</h1>
            <h4 class="font-weight-300 text-main-color text-up-small">A better Doctors , Clinics &amp; Labs . We'll help
                you find it</h4>
            <h4 style="color:red"><?php echo $searchError; ?></h4>
        </div>
        <div class="row margin-tb-60px">
            <div class="col-lg-8">
                <div class="listing-search">
                    <form method="POST" class="row no-gutters">
                        <div class="col-md-8">
                            <div class="keywords">
                                <select class="listing-form first" name="option" style="outline: none" required>
                                    <option selected disabled value=""> Select</option>
                                    <option value="Doctor">Doctors</option>
                                    <option value="Lab">Labs</option>
                                    <option value="Pharmacy">Pharmacies</option>
                                </select>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <?php if (!isset($_SESSION["logged_in"])) { ?>
                                <a class="listing-bottom background-second-color box-shadow" href="#modal">Search
                                    Now</a>
                                <div class="awesome-modal" id="modal"><a class="close-icon" href="#close"></a>
                                    <center>
                                        <h3 class="modal-title text-danger">You are not logged in?</h3>
                                        <br>
                                        <a class="btn btn-success" href="../login/clients/"
                                           style="width: 80px">Login</a>&emsp;||&emsp;<a class="btn btn-dark"
                                                                                         href="#modal1" style="">Sign
                                            up</a>
                                    </center>
                                </div>

                            <?php } else {
                                ?>
                                <button type="submit" name="submit"
                                        class="listing-bottom background-second-color box-shadow" style="outline: none">
                                    Search Now
                                </button>

                            <?php } ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-7">
                <div class="row">
                    <?php if (!isset($_SESSION["logged_in"])) { ?>
                        <div class="col-md-3 col-6 sm-mb-30px wow fadeInUp">
                            <a href="#modal" class="d-block border-radius-15 hvr-float hvr-sh2">
                                <div class="background-main-color text-white border-radius-15 padding-20px text-center opacity-hover-7">
                                    <div class="icon margin-bottom-15px opacity-7">
                                        <img src="assets/img/icon/categorie-1.png" alt="">
                                    </div>
                                    Doctors
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-6 wow fadeInUp" data-wow-delay="0.4s">
                            <a href="#modal" class="d-block border-radius-15 hvr-float hvr-sh2">
                                <div class="background-main-color text-white border-radius-15 padding-20px text-center opacity-hover-7">
                                    <div class="icon margin-bottom-15px">
                                        <img src="assets/img/icon/categorie-3.png" alt="">
                                    </div>
                                    Labs
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-6 wow fadeInUp" data-wow-delay="0.6s">
                            <a href="#modal" class="d-block border-radius-15 hvr-float hvr-sh2">
                                <div class="background-main-color text-white border-radius-15 padding-20px text-center opacity-hover-7">
                                    <div class="icon margin-bottom-15px opacity-7">
                                        <img src="assets/img/icon/categorie-4.png" alt="">
                                    </div>
                                    Pharmacies
                                </div>
                            </a>
                        </div>
                    <?php } else { ?>

                        <div class="col-md-3 col-6 sm-mb-30px wow fadeInUp">
                            <a href="doctors.php" class="d-block border-radius-15 hvr-float hvr-sh2">
                                <div class="background-main-color text-white border-radius-15 padding-20px text-center opacity-hover-7">
                                    <div class="icon margin-bottom-15px opacity-7">
                                        <img src="assets/img/icon/categorie-1.png" alt="">
                                    </div>
                                    Doctors
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-6 wow fadeInUp" data-wow-delay="0.4s">
                            <a href="#modal3" class="d-block border-radius-15 hvr-float hvr-sh2">
                                <div class="background-main-color text-white border-radius-15 padding-20px text-center opacity-hover-7">
                                    <div class="icon margin-bottom-15px">
                                        <img src="assets/img/icon/categorie-3.png" alt="">
                                    </div>
                                    Labs
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-6 wow fadeInUp" data-wow-delay="0.6s">
                            <a href="#modal2" class="d-block border-radius-15 hvr-float hvr-sh2">
                                <div class="background-main-color text-white border-radius-15 padding-20px text-center opacity-hover-7">
                                    <div class="icon margin-bottom-15px opacity-7">
                                        <img src="assets/img/icon/categorie-4.png" alt="">
                                    </div>
                                    Pharmacies
                                </div>
                            </a>
                        </div>


                        <div class="awesome-modal" id="modal2">
                            <a class="close-icon" href="#close"></a>
                            <center>
                                <h3 class="modal-title text-danger">What do you want to search for?</h3>
                                <br>
                                <a class="btn btn-success" href="pharmacy.php" style="width: 100px">Pharmacy</a>&emsp;
                                ||&emsp;
                                <a class="btn btn-dark" href="drugs.php" style="width: 100px">Drugs</a>
                            </center>
                        </div>

                        <div class="awesome-modal" id="modal3">
                            <a class="close-icon" href="#close"></a>
                            <center>
                                <h3 class="modal-title text-danger">What do you want to search for?</h3>
                                <br>
                                <a class="btn btn-success" href="labs.php" style="width: 100px">Labs</a>&emsp;
                                ||&emsp;
                                <a class="btn btn-dark" href="tests.php" style="width: 100px">Tests</a>
                            </center>
                        </div>

                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>




<section class="padding-tb-100px background-grey-1">
    <div class="container">
        <!-- Title -->
        <div class="row justify-content-center margin-bottom-45px">
            <div class="col-lg-10">
                <div class="row">
                    <div class="col-md-3 wow fadeInUp">
                        <h1 class="text-second-color font-weight-300 text-sm-center text-lg-right margin-tb-15px">Our
                            Blog</h1>
                    </div>
                    <div class="col-md-7 wow fadeInUp" data-wow-delay="0.2s">
                        <p class="text-grey-2">Lorem Ipsum is simply dummy text of the printing and typesetting
                            industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                    </div>
                    <div class="col-md-2 wow fadeInUp" data-wow-delay="0.4s">
                        <a href="#" class="text-main-color margin-tb-15px d-inline-block"><span
                                    class="d-block float-left margin-right-10px margin-top-5px">Show All</span> <i
                                    class="far fa-arrow-alt-circle-right text-large margin-top-7px"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- // Title -->

        <div class="row">
            <div class="col-lg-6 sm-mb-45px">
                <div class="background-white thum-hover box-shadow hvr-float full-width wow fadeInUp">
                    <div class="float-md-left margin-right-30px thum-xs">
                        <img src="assets/img/blog-1.jpg" alt="">
                    </div>
                    <div class="padding-25px">
                        <i class="far fa-folder-open text-main-color"></i>
                        <a href="#" class="text-main-color">News </a> ,
                        <a href="#" class="text-main-color">Articles </a>
                        <h3><a href="#" class="d-block text-dark text-capitalize text-medium margin-tb-15px">Long Don’t
                                Spend Time Beating On a Wall, Hoping To Trans ... </a></h3>
                        <span class="margin-right-20px text-extra-small"><i class="far fa-user text-grey-2"></i> By : <a
                                    href="#"> Rabie Elkheir</a></span>
                        <span class="text-extra-small d-block d-sm-none"><i class="far fa-clock text-grey-2"></i> Date :  <a
                                    href="#"> July 15, 2016</a></span>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="col-lg-6 sm-mb-45px">
                <div class="background-white thum-hover box-shadow hvr-float full-width wow fadeInUp">
                    <div class="float-md-left margin-right-30px thum-xs">
                        <img src="assets/img/blog-2.jpg" alt="">
                    </div>
                    <div class="padding-25px">
                        <i class="far fa-folder-open text-main-color"></i>
                        <a href="#" class="text-main-color">News </a> ,
                        <a href="#" class="text-main-color">Articles </a>
                        <h3><a href="#" class="d-block text-dark text-capitalize text-medium margin-tb-15px">Long Don’t
                                Spend Time Beating On a Wall, Hoping To Trans ... </a></h3>
                        <span class="margin-right-20px text-extra-small"><i class="far fa-user text-grey-2"></i> By : <a
                                    href="#"> Rabie Elkheir</a></span>
                        <span class="text-extra-small d-block d-sm-none"><i class="far fa-clock text-grey-2"></i> Date :  <a
                                    href="#"> July 15, 2016</a></span>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

    </div>
</section>

<!--footer-->
<?php include './parts/footer.php'; ?>

<!--scripts-->
<?php include './parts/js-links.php'; ?>
</body>
</html>
