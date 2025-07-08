<?php
session_start();
$adminid = $_SESSION['admin_id'];

if (!isset($_SESSION["admin_id"])) {
    header("location:logout.php");
}

require_once './server/Admin.php';
$result = "";
$removed = "";
$blocked = "";
$unblocked = "";

$server = new Admin();
$result = $server->adminData();

$partner = $server->partner_data();
$vdata = $server->certificates();
$x = $server->view_branches();

if (isset($_POST['remove'])) {
    $removed = $server->remove_partner($_POST);
}

if (isset($_POST['block'])) {
    $blocked = $server->block_partner($_POST);
}
if (isset($_POST['unblock'])) {
    $unblocked = $server->unblock_partner($_POST);
}
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
                <?php if ($partner->num_rows > 0) {
                    while ($row = $partner->fetch_assoc()) {
                        ?>

                        <div class="row">
                            <div class="col-sm-6 col-3">
                                <h4 class="page-title"><u>PROFILE</u><?= $removed;
                                    $blocked;
                                    $unblocked; ?></h4>
                            </div>
                            <div class="col-sm-6 col-9 text-right m-b-20">
                                <a href="partner-update.php?partner_id=<?= $_GET['partner_id'] ?>&partnership_zone=<?= $_GET['partnership_zone'] ?>"
                                   class="btn btn-primary btn-rounded float-right"><i class="fa fa-pencil"></i> Edit
                                    Profile</a>
                            </div>
                        </div>
                        <div class="card-box profile-header">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="profile-view">
                                        <div class="profile-img-wrap">
                                            <div class="profile-img">
                                                <a href="<?php echo substr($row['institute_logo'], 3) ?>"
                                                   target="_blank">
                                                    <img class="" src="<?php echo substr($row['institute_logo'], 3) ?>"
                                                         onerror="this.onerror=null; this.src='assets/img/user.jpg'"
                                                         alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="profile-basic">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="">
                                                        <h3 class="user-name m-t-0 mb-0">
                                                            <?php if ($row['partnership_zone'] === 'doctor') {
                                                                echo $row['doctor_title'];
                                                            } ?>
                                                            <h4><?php echo $row['institute_name'] ?></h4>
                                                            <?php
                                                            if ($row['profile_status'] == 0) {
                                                                echo "<h1 style='color:red'>PROFILE INCOMPLETE!</h1>";
                                                            }
                                                            ?>
                                                        </h3>
                                                        <h5><?php echo $row['institute_type'] ?></h5>
                                                        <small class="text-muted"><?php echo $row['city'] ?>
                                                            ,<?php echo $row['country'] ?></small>
                                                    </div>
                                                    <br>
                                                    <div>
                                                        <form method="POST">
                                                            <input type="hidden" name="partner_id"
                                                                   value="<?= $row['partner_id'] ?>">
                                                            <button name="remove" class="btn btn-outline-danger"
                                                                    style="width: 100px"
                                                                    onclick="return confirm('Are you really sure to remove?')">
                                                                <i class="fa fa-remove"></i> Remove
                                                            </button>
                                                            <?php if ($row['status'] === '1') { ?>
                                                                <button name="block" class="btn btn-outline-dark"
                                                                        style="width: 100px"
                                                                        onclick="return confirm('Are you really sure to block?')">
                                                                    <i class="fa fa-ban"></i> Block
                                                                </button>
                                                            <?php } else { ?>
                                                                <button name="unblock" class="btn btn-outline-success"
                                                                        style="width: 100px"
                                                                        onclick="return confirm('Are you really sure to unblock?')">
                                                                    <i class="fa fa-ban"></i> Unblock
                                                                </button>
                                                            <?php } ?>
                                                            <a href="#modal" class="btn btn-outline-primary"
                                                               style="width: 100px">
                                                                <i class="fa fa-envelope"></i> Mail
                                                            </a>
                                                        </form>
                                                    </div>
                                                    <div class="awesome-modal" id="modal">
                                                        <a class="close-icon" href="#close"></a>
                                                        <center>
                                                            <h3 class="modal-title text-danger">What do you want to
                                                                send?</h3>
                                                            <br>
                                                            <a class="btn btn-success"
                                                               href="message-send.php?partner_id=<?= $_GET['partner_id'] ?>&for=partner"
                                                               style="width: 100px">Message</a>&emsp;
                                                            ||&emsp;
                                                            <a class="btn btn-dark"
                                                               href="email-send.php?partner_id=<?= $row['partner_id'] ?>&email=<?= $row['email'] ?>"
                                                               style="width: 100px">Email</a>
                                                        </center>
                                                    </div>
                                                </div>
                                                <div class="col-md-7">
                                                    <ul class="personal-info">
                                                        <li>
                                                            <span class="title">Email:</span>
                                                            <span class="text"><a
                                                                        href="mailto:<?php echo $row['email'] ?>?Subject="
                                                                        target="_top"><?php echo $row['email'] ?></a></span>
                                                            <?php
                                                            if ($row['email'] == "") {
                                                                echo "<br>";
                                                            }
                                                            ?>
                                                        </li>
                                                        <li>
                                                            <span class="title">Contact Number1:</span>
                                                            <span class="text"><a
                                                                        href="#"><?php echo $row['contact_no1'] ?></a></span>
                                                            <?php
                                                            if ($row['contact_no1'] == "") {
                                                                echo "<br>";
                                                            }
                                                            ?>
                                                        </li>
                                                        <li>
                                                            <span class="title">Contact Number2:</span>
                                                            <span class="text"><a
                                                                        href="#"><?php echo $row['contact_no2'] ?></a></span>
                                                            <?php
                                                            if ($row['contact_no2'] == "") {
                                                                echo "<br>";
                                                            }
                                                            ?>
                                                        </li>
                                                        <li>
                                                            <span class="title">Contact Number3:</span>
                                                            <span class="text"><a
                                                                        href="#"><?php echo $row['contact_no3'] ?></a></span>
                                                            <?php
                                                            if ($row['contact_no3'] == "") {
                                                                echo "<br>";
                                                            }
                                                            ?>
                                                        </li>
                                                        <li>
                                                            <span class="title">Hotline Number:</span>
                                                            <span class="text"><a
                                                                        href="#"><?php echo $row['hotline_no'] ?></a></span>
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
                                <li class="nav-item"><a class="nav-link active" href="#about-cont" data-toggle="tab">About</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#bottom-tab2" data-toggle="tab">Address/Location</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#bottom-tab3"
                                                        data-toggle="tab">Branches</a></li>
                                <li class="nav-item"><a class="nav-link" href="#bottom-tab4"
                                                        data-toggle="tab">Packages</a></li>
                                <li class="nav-item"><a class="nav-link" href="#bottom-tab5" data-toggle="tab">Links &
                                        Authentication</a></li>
                                <li class="nav-item"><a class="nav-link" href="#bottom-tab6" data-toggle="tab">Certificates</a>
                                </li>
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
                                        <?php if ($row['partnership_zone'] === 'doctor') { ?>
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
                                                            if ($row['doctor_degree'] == "") {
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
                                        <?php } ?>
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
                                        <div class="col-md-12">
                                            <div class="card-box">
                                                <h3 class="card-title">Branches</h3>
                                                <div class="row">
                                                    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <input id="myInput" type="text"
                                                                       placeholder="Search ...."
                                                                       style="height: 35px;width: 40%;border: 1px solid;text-align: center">
                                                                <a href="#" class="btn btn-outline-dark float-right">Total
                                                                    Branch:
                                                                    <span style="color: orangered"><?= $server->total_branches() ?></span>
                                                                </a>
                                                            </div>
                                                            <div class="card-body p-0">
                                                                <div class="table-responsive">
                                                                    <table class="table mb-0">

                                                                        <tbody id="myTable">
                                                                        <?php
                                                                        $i = 1;

                                                                        if ($x->num_rows > 0) {
                                                                            while ($data = $x->fetch_assoc()) {
                                                                                ?>

                                                                                <tr>
                                                                                    <td>
                                                                                        <h5 class="time-title p-0">
                                                                                            Branch Name</h5>
                                                                                        <p><?= $data['institute_name'] ?></p>
                                                                                    </td>
                                                                                    <td>
                                                                                        <h5 class="time-title p-0">
                                                                                            Country</h5>
                                                                                        <p><?= $data['country'] ?></p>
                                                                                    </td>
                                                                                    <td>
                                                                                        <h5 class="time-title p-0">
                                                                                            City</h5>
                                                                                        <p><?= $data['city'] ?></p>
                                                                                    </td>
                                                                                    <td>
                                                                                        <h5 class="time-title p-0">
                                                                                            Region</h5>
                                                                                        <p><?= $data['region'] ?></p>
                                                                                    </td>
                                                                                    <td>
                                                                                        <h5 class="time-title p-0">
                                                                                            Address</h5>
                                                                                        <p><?= $data['address'] ?></p>
                                                                                    </td>
                                                                                    <td>
                                                                                        <h5 class="time-title p-0">
                                                                                            Status</h5>
                                                                                        <?php if ($data['status'] === '1') { ?>
                                                                                            <p class="text-success">
                                                                                                Published</p>
                                                                                        <?php } else { ?>
                                                                                            <p class="text-danger">
                                                                                                Unpublished</p>
                                                                                        <?php } ?>
                                                                                    </td>
                                                                                </tr>
                                                                                <?php
                                                                            }
                                                                        } else { ?>
                                                                            <tr>
                                                                                <td colspan="">
                                                                                    <center>
                                                   <span class="text-danger">
                                                       This repository is empty.
                                                   </span>
                                                                                    </center>
                                                                                </td>
                                                                            </tr>
                                                                        <?php }
                                                                        ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="bottom-tab4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card-box">
                                                <h3 class="card-title">Online Info</h3>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="bottom-tab5">
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
                                                                <u>Partner
                                                                    ID:</u>&nbsp; <?php echo $row['partner_id'] ?>
                                                            </div>
                                                            <div class="experience-content">
                                                                <u>Password:</u> <input type="password" id="password"
                                                                                        value="<?php echo $row['password'] ?>"
                                                                                        style="border:none;background: none;outline: none;"
                                                                                        readonly/>
                                                                <button class="btn-danger" onclick="if (password.type == 'text')
                                                                                        password.type = 'password';
                                                                                    else
                                                                                        password.type = 'text';"><i
                                                                            class="fa fa-eye"></i></button>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane" id="bottom-tab6">
                                    <div class="row">
                                        <?php while ($data = $vdata->fetch_assoc()) { ?>

                                            <div class="col-sm-6 card-box">
                                                <a href="<?php echo substr($data['tin_certificate'], 3) ?>" target="_blank">
                                                    <center>
                                                        <h4 class="modal-title">TIN Certificate</h4>
                                                        <div style="min-height: 400px;width: 300px;border:1px solid;border-radius: 5px">
                                                            <img alt="" style="height: 398px;width:297px "
                                                                 src="<?php echo substr($data['tin_certificate'], 3) ?>"
                                                                 onerror="this.onerror=null; this.src='../gallery/tin-example.jpg'"/>
                                                        </div>
                                                    </center>
                                                </a>
                                            </div>


                                            <div class="col-sm-6 card-box">
                                                <a href="<?php echo substr($data['tin_certificate'], 3) ?>" target="_blank">
                                                    <center>
                                                        <h4 class="modal-title">License Certificate</h4>
                                                        <div style="min-height: 400px;width: 300px;border:1px solid;border-radius: 5px">
                                                            <img alt="" style="height: 398px;width:297px "
                                                                 src="<?php echo substr($data['license_certificate'], 3) ?>"
                                                                 onerror="this.onerror=null; this.src='../gallery/license-example.jpg'"/>
                                                        </div>
                                                    </center>
                                                </a>
                                            </div>

                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo 'No Data Found!';
                } ?>
            </div>

        </div>
    <?php } ?>
</div>
<?php include './parts/js-links.php'; ?>

</body>
</html>