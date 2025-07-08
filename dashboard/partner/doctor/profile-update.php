<?php
session_start();
$partner_id = $_SESSION['partner_id'];

if (!isset($_SESSION["partner_id"])) {
    header("location:logout.php");
}

require_once './server/Partner.php';
$result = "";
$updateError = "";

$server = new Partner();

$result = $server->partner_data();

if(isset($_POST['update'])){
    $updateError = $server->update_profile($_POST);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
        <title>DAMS</title>
        <?php include './parts/css-links.php'; ?>
        <style>
            .content{
                text-transform: uppercase;
            }
            label,h3{

            }
            form input{
                border:1px solid !important
            }
        </style>
    </head>

    <body>
        <div class="main-wrapper">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <!--topnav-->
                <?php include './parts/top-nav.php'; ?>

                <!--sidenav-->
                <?php include './parts/side-nav.php'; ?>

                <div class="page-wrapper">
                    <div class="content">
                        <?php
                        if ($row['account_status'] == 1){?>

                            <h4 style="text-transform: none">
                                Your account has been verified.You can't make any change in your profile details anymore.<br>
                                To change password please go to  <a href="settings.php"><i class="fa fa-cog fa-spin"></i>&nbsp;Settings</a>

                            </h4>

                        <?php }else{
                        ?>
                        <div class="row">
                            <div class="col-sm-8">
                                <h4 class="page-title"><u>Edit Profile</u>&emsp;<span style="color:orangered"><?php echo $updateError; ?></span></h4>
                            </div>
                            <div class="col-sm-4">
                                <a href="profile-details.php" class="btn btn-primary btn-rounded float-right"><i class="fa fa-file"></i>&nbsp;Profile</a>
                            </div>
                        </div>
                        <form method="POST" action = "" enctype="multipart/form-data">
                            <div class="card-box">
                                <h3 class="card-title">Basic Informations</h3>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="profile-img-wrap">
                                            <img class="inline-block" src="<?php echo $row['institute_logo'] ?>" onerror="this.onerror=null; this.src='assets/img/user.jpg'"  id="output">
                                            <div class="fileupload btn">
                                                <span class="btn-text">Profile Image</span>
                                                <input class="upload" type="file" onchange="loadFile(event)" name="institute_logo">
                                            </div>
                                        </div>
                                        <script>
                                            var loadFile = function (event) {
                                                var output = document.getElementById('output');
                                                output.src = URL.createObjectURL(event.target.files[0]);
                                            };
                                        </script>
                                        <?php
                                        $oldpic = $row['institute_logo'];
                                        $_SESSION['institute_logo'] = $oldpic;
                                        ?>
                                        <div class="profile-basic">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus">
                                                        <label class="focus-label">Institute Name/Chamber Name<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control floating" name="institute_name" value="<?php echo $row['institute_name'] ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus">
                                                        <label class="focus-label">Short Name</label>
                                                        <input type="text" class="form-control floating" name="short_form" value="<?php echo $row['short_form'] ?>" >
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-focus" >
                                                        <label class="focus-label">Partnership Type<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control floating" name="institute_type" value="Doctor" readonly required>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-box">
                                <h3 class="card-title">Contact Information</h3>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-focus">
                                            <label class="focus-label">Address<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control floating" value="<?php echo $row['address'] ?>" name = "address" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <label class="focus-label">Country<span class="text-danger">*</span></label>
                                            <select type="text" class="form-control floating"  name="country"
                                                    required style="border: 1px solid">
                                                <?php include '../../countries.php'?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <label class="focus-label">City<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control floating" value="<?php echo $row['city'] ?>" name="city" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <label class="focus-label">Region<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control floating" value="<?php echo $row['region'] ?>" name="region" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <label class="focus-label">Email Address<span class="text-danger">*</span></label>
                                            <input type="email" class="form-control floating" name="email" value="<?php echo $row['email'] ?>" readonly required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <label class="focus-label">Contact Number1<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control floating" value="<?php echo $row['contact_no1'] ?>" name="contact_no1" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <label class="focus-label">Contact Number2</label>
                                            <input type="text" class="form-control floating" value="<?php echo $row['contact_no2'] ?>" name="contact_no2">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <label class="focus-label">Contact Number3</label>
                                            <input type="text" class="form-control floating" value="<?php echo $row['contact_no3'] ?>" name="contact_no3">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <label class="focus-label">Hotline Number</label>
                                            <input type="text" class="form-control floating" value="<?php echo $row['hotline_no'] ?>" name="hotline_no">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card-box">
                                <h3 class="card-title">Doctor Information</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <label class="focus-label">Doctor Title/Name<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control floating" value="<?php echo $row['doctor_title'] ?>" name="doctor_title" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <label class="focus-label">Doctor Type<span class="text-danger">*</span></label>
                                            <select type="text" class="form-control floating"  name="doctor_type"
                                                    required style="border: 1px solid">
                                               <option value="<?= $row['doctor_type'] ?>" selected><?= $row['doctor_type'] ?></option>
                                               <?php include '../../doctor-types.php'?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <label class="focus-label">Degrees<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control floating" value="<?php echo $row['doctor_degree'] ?>" name="doctor_degree" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <label class="focus-label">Doctor Payment [ In Taka ]<span class="text-danger">*</span></label>
                                            <input type="number" min="1" class="form-control floating" value="<?php echo $row['visit_price'] ?>" name="visit_price" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-box">
                                <h3 class="card-title">Other Information</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <label class="focus-label">Off Days<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control floating" value="<?php echo $row['off_days'] ?>" name="off_days" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <label class="focus-label">Service Period<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control floating" value="<?php echo $row['service_period'] ?>" name="service_period" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <label class="focus-label">Website Link</label>
                                            <input type="text" class="form-control floating" value="<?php echo $row['website_link'] ?>" name="website_link">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <label class="focus-label">Facebook Page LInk</label>
                                            <input type="text" class="form-control floating" value="<?php echo $row['facebook_link'] ?>" name="facebook_link" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-box">
                                <h3 class="card-title">License Info</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <label class="focus-label">TIN Number<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control floating" value="<?php echo $row['tin_number'] ?>" name="tin_number" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <label class="focus-label">License Number/Reg Number<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control floating" value="<?php echo $row['reg_number'] ?>" name="reg_number" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-box" style="min-height:300px">
                                <h3 class="card-title">Short Description/ Experience</h3>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-focus">
                                            <label class="focus-label">Description<span class="text-danger">*</span></label>
                                            <textarea class="form-control floating" style="min-height: 200px;resize: none;border: 1px solid"
                                                      cols="30" name="about"
                                                      required><?php echo $row['about'] ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-box">
                                <h3 class="card-title">Authentication Data</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <label class="focus-label">Partner ID<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control floating" value="<?php echo $row['partner_id'] ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <label class="focus-label">Password<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control floating" value="<?php echo $row['password'] ?>" name="password" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center m-t-20">
                                <button class="btn btn-primary submit-btn" type="submit" name="update" >Update</button>
                            </div>
                        </form>
                        <?php } ?>
                    </div>
                    <?php include './parts/messages.php'; ?>
                </div>
            <?php } ?>
        </div>
        <div class="sidebar-overlay" data-reff=""></div>
        <script src="assets/js/jquery-3.2.1.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/select2.min.js"></script>
        <script src="assets/js/moment.min.js"></script>
        <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
        <script src="assets/js/app.js"></script>
    </body>

</html>