<?php
session_start();
$partner_id = $_SESSION['partner_id'];

if (!isset($_SESSION["partner_id"])) {
    header("location:logout.php");
}

require_once './server/Partner.php';
$result = "";

$server = new Partner();

$result = $server->partner_data();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <?php include './parts/css-links.php'; ?>
        <style>

        </style>
    </head>

    <body>
        <div class="main-wrapper">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="header">
                    <?php include './parts/top-nav.php'; ?>
                </div>
                <div class="sidebar" id="sidebar">
                    <?php include './parts/side-nav.php'; ?>
                </div>

                <?php
                if ($row['status'] == 0) {
                    echo "<script type='text/javascript'>alert('SORRY! YOU ARE BLOCKED!');document.location='logout.php';</script>";
                }
                ?>


                <div class="page-wrapper">
                    <div class="content">
                        <div class="row">
                            <div class="col-sm-6 col-3">
                                <h4 class="page-title"><u>PROFILE</u></h4>
                            </div>
                            <div class="col-sm-6 col-9 text-right m-b-20">
                                <a href="profile-update.php" class="btn btn-primary btn-rounded float-right"><i class="fa fa-pencil"></i> Edit Profile</a>
                            </div>
                        </div>
                        <div class="card-box profile-header">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="profile-view">
                                        <div class="profile-img-wrap" >
                                            <div class="profile-img">
                                                <a href="<?php echo $row['institute_logo'] ?>" target="_blank"><img class="" src="<?php echo $row['institute_logo'] ?>"  onerror="this.onerror=null; this.src='assets/img/hospital.png'" alt=""></a>
                                            </div>
                                        </div>
                                        <div class="profile-basic">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="">
                                                        <h3 class="user-name m-t-0 mb-0">
                                                            <?php echo $row['institute_name'] ?>
                                                        <?php
                                                            if ($row['institute_name'] == "") {
                                                                echo "<h1 style='color:red'>PROFILE INCOMPLETE!</h1>";
                                                            }
                                                            ?>
                                                        </h3>
                                                        <h5><?php echo $row['institute_type'] ?></h5>
                                                        <small class="text-muted"><?php echo $row['city'] ?>,<?php echo $row['country'] ?></small>
                                                    </div>
                                                </div>
                                                <div class="col-md-7">
                                                    <ul class="personal-info">
                                                        <li>
                                                            <span class="title">Email:</span>
                                                            <span class="text"><a href="mailto:<?php echo $row['email'] ?>?Subject=" target="_top"><?php echo $row['email'] ?></a></span>
                                                            <?php
                                                            if ($row['email'] == "") {
                                                                echo "<br>";
                                                            }
                                                            ?>
                                                        </li>
                                                        <li>
                                                            <span class="title">Contact Number1:</span>
                                                            <span class="text"><a href="#"><?php echo $row['contact_no1'] ?></a></span>
                                                            <?php
                                                            if ($row['contact_no1'] == "") {
                                                                echo "<br>";
                                                            }
                                                            ?>
                                                        </li>
                                                        <li>
                                                            <span class="title">Contact Number2:</span>
                                                            <span class="text"><a href="#"><?php echo $row['contact_no2'] ?></a></span>
                                                            <?php
                                                            if ($row['contact_no2'] == "") {
                                                                echo "<br>";
                                                            }
                                                            ?>
                                                        </li>
                                                        <li>
                                                            <span class="title">Contact Number3:</span>
                                                            <span class="text"><a href="#"><?php echo $row['contact_no3'] ?></a></span>
                                                            <?php
                                                            if ($row['contact_no3'] == "") {
                                                                echo "<br>";
                                                            }
                                                            ?>
                                                        </li>
                                                        <li>
                                                            <span class="title">Hotline Number:</span>
                                                            <span class="text"><a href="#"><?php echo $row['hotline_no'] ?></a></span>
                                                            <?php
                                                            if ($row['hotline_no'] == "") {
                                                                echo "<br>";
                                                            }
                                                            ?>
                                                        </li>

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="profile-tabs">
                            <ul class="nav nav-tabs nav-tabs-bottom">
                                <li class="nav-item"><a class="nav-link active" href="#about-cont" data-toggle="tab">About</a></li>
                                <li class="nav-item"><a class="nav-link" href="#bottom-tab2" data-toggle="tab">Address/Location</a></li>
                                <li class="nav-item"><a class="nav-link" href="#bottom-tab3" data-toggle="tab">Links & Authentication</a></li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane show active" id="about-cont">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card-box">
                                                <h3 class="card-title">Short Description</h3>
                                                <?php echo $row['about'] ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card-box">
                                                <h3 class="card-title">Doctor Info</h3>
                                                <ul class="personal-info">

                                                    <li>
                                                        <span class="title">Doctor Title:</span>
                                                        <span class="text"><?php echo $row['doctor_title'] ?></span>
                                                        <?php
                                                        if ($row['doctor_title'] == "") {
                                                            echo "<br>";
                                                        }
                                                        ?>
                                                    </li>
                                                    <li>
                                                        <span class="title">Doctor Type:</span>
                                                        <span class="text"><?php echo $row['doctor_type'] ?></span>
                                                        <?php
                                                        if ($row['doctor_type'] == "") {
                                                            echo "<br>";
                                                        }
                                                        ?>
                                                    </li>
                                                    <li>
                                                        <span class="title">Degrees:</span>
                                                        <span class="text"><?php echo $row['doctor_degree'] ?></span>
                                                        <?php
                                                        if ($row['off_days'] == "") {
                                                            echo "<br>";
                                                        }
                                                        ?>
                                                    </li>
                                                    <li>
                                                        <span class="title">Visiting Payment:</span>
                                                        <span class="text"><?php echo $row['visit_price'] ?> TK</span>
                                                        <?php
                                                        if ($row['visit_price'] == "") {
                                                            echo "<br>";
                                                        }
                                                        ?>
                                                    </li>


                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card-box">
                                                <h3 class="card-title">Other Info</h3>
                                                <ul class="personal-info">

                                                    <li>
                                                        <span class="title">TIN Number:</span>
                                                        <span class="text"><?php echo $row['tin_number'] ?></span>
                                                        <?php
                                                        if ($row['tin_number'] == "") {
                                                            echo "<br>";
                                                        }
                                                        ?>
                                                    </li>
                                                    <li>
                                                        <span class="title">Reg Number:</span>
                                                        <span class="text"><?php echo $row['reg_number'] ?></span>
                                                        <?php
                                                        if ($row['reg_number'] == "") {
                                                            echo "<br>";
                                                        }
                                                        ?>
                                                    </li>
                                                    <li>
                                                        <span class="title">Off Days:</span>
                                                        <span class="text"><?php echo $row['off_days'] ?></span>
                                                        <?php
                                                        if ($row['off_days'] == "") {
                                                            echo "<br>";
                                                        }
                                                        ?>
                                                    </li>
                                                    <li>
                                                        <span class="title">Service Period:</span>
                                                        <span class="text"><?php echo $row['service_period'] ?></span>
                                                        <?php
                                                        if ($row['service_period'] == "") {
                                                            echo "<br>";
                                                        }
                                                        ?>
                                                    </li>


                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="bottom-tab2">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card-box">
                                                <h3 class="card-title">Location</h3>
                                                <ul class="personal-info">

                                                    <li>
                                                        <span class="title">Address:</span>
                                                        <span class="text"><?php echo $row['address'] ?></span>
                                                        <?php
                                                        if ($row['address'] == "") {
                                                            echo "<br>";
                                                        }
                                                        ?>
                                                    </li>
                                                    <li>
                                                        <span class="title">Country:</span>
                                                        <span class="text"><?php echo $row['country'] ?></span>
                                                        <?php
                                                        if ($row['country'] == "") {
                                                            echo "<br>";
                                                        }
                                                        ?>
                                                    </li>
                                                    <li>
                                                        <span class="title">City:</span>
                                                        <span class="text"><?php echo $row['city'] ?></span>
                                                        <?php
                                                        if ($row['city'] == "") {
                                                            echo "<br>";
                                                        }
                                                        ?>
                                                    </li>
                                                    <li>
                                                        <span class="title">Region:</span>
                                                        <span class="text"><?php echo $row['region'] ?></span>
                                                        <?php
                                                        if ($row['region'] == "") {
                                                            echo "<br>";
                                                        }
                                                        ?>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card-box">
                                                <h3 class="card-title">Google Map Info</h3>
                                                <ul class="personal-info">

                                                    <li>
                                                        <span class="title">Searchable Name:</span>
                                                        <span class="text"><?php echo $row['map_name'] ?></span>
                                                        <?php
                                                        if ($row['map_name'] == "") {
                                                            echo "<br>";
                                                        }
                                                        ?>
                                                    </li>
                                                    <li>
                                                        <span class="title">Longitude:</span>
                                                        <span class="text"><?php echo $row['longitude'] ?></span>
                                                        <?php
                                                        if ($row['longitude'] == "") {
                                                            echo "<br>";
                                                        }
                                                        ?>
                                                    </li>
                                                    <li>
                                                        <span class="title">Latitude:</span>
                                                        <span class="text"><?php echo $row['latitude'] ?></span>
                                                        <?php
                                                        if ($row['latitude'] == "") {
                                                            echo "<br>";
                                                        }
                                                        ?>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="bottom-tab3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card-box">
                                                <h3 class="card-title">Online Info</h3>
                                                <ul class="personal-info">
                                                    <li>
                                                        <span class="title">Website Link:</span>
                                                        <span class="text"><?php echo $row['website_link'] ?></span>
                                                        <?php
                                                        if ($row['website_link'] == "") {
                                                            echo "<br>";
                                                        }
                                                        ?>
                                                    </li>
                                                    <li>
                                                        <span class="title">Facebook Page Link:</span>
                                                        <span class="text"><?php echo $row['facebook_link'] ?></span>
                                                        <?php
                                                        if ($row['facebook_link'] == "") {
                                                            echo "<br>";
                                                        }
                                                        ?>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card-box">
                                                <h3 class="card-title">Authentication Data</h3>
                                                <div class="experience-box">
                                                    <ul class="experience-list">
                                                        <li>
                                                            <div class="experience-user">
                                                                <div class="before-circle"></div>
                                                            </div>
                                                            <div class="experience-content">
                                                                <u>Partner ID:</u>&nbsp; <?php echo $row['partner_id'] ?>
                                                            </div>
                                                            <div class="experience-content">
                                                                <u>Password:</u> <input type="password" id="password" value="<?php echo $row['password'] ?>" style="border:none;background: none;outline: none;" readonly/>
                                                                <button class="btn-danger" onclick="if (password.type == 'text')
                                                                                        password.type = 'password';
                                                                                    else
                                                                                        password.type = 'text';"><i class="fa fa-eye"></i></button>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            <?php } ?>
        </div>
        <?php include './parts/js-links.php'; ?>

    </body>
</html>