<?php
session_start();
$adminid = $_SESSION['admin_id'];

if (!isset($_SESSION["admin_id"])) {
    header("location:logout.php");
}

require_once './server/Admin.php';
$result = "";
$removed = "";

$server = new Admin();
$result = $server->adminData();

$client = $server->client_data();

if (isset($_POST['remove'])) {
    $removed = $server->remove_client($_POST);
}

if (isset($_POST['block'])) {
    $blocked = $server->block_client($_POST);
}
if (isset($_POST['unblock'])) {
    $unblocked = $server->unblock_client($_POST);
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
        }
        ?>


        <div class="page-wrapper">
            <div class="content">
                <?php if ($client->num_rows > 0) {
                    while ($row = $client->fetch_assoc()) {
                        ?>

                        <div class="row">
                            <div class="col-sm-6 col-3">
                                <h4 class="page-title"><u>PROFILE</u><?= $removed; ?></h4>
                            </div>
                        </div>
                        <div class="card-box profile-header">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="profile-view">
                                        <div class="profile-img-wrap">
                                            <div class="profile-img">
                                                <a href="../<?php echo $row['propic'] ?>"
                                                   target="_blank">
                                                    <img class="" src="../<?php echo $row['propic']?>"
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
                                                            <h4><?= $row['first_name'] . '' . $row['last_name'] ?></h4>
                                                        </h3>
                                                        <br>
                                                        <br>
                                                    </div>
                                                    <br>
                                                    <div>
                                                        <div>
                                                            <form method="POST">
                                                                <input type="hidden" name="client_id"
                                                                       value="<?= $row['client_id'] ?>">
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
                                                                <a class="btn btn-success" href="message-send.php?client_id=<?= $_GET['client_id'] ?>&for=client"
                                                                   style="width: 100px">Message</a>&emsp;
                                                                ||&emsp;
                                                                <a class="btn btn-dark"
                                                                   href="email-send.php?client_id=<?= $row['client_id'] ?>&email=<?= $row['email'] ?>"
                                                                   style="width: 100px">Email</a>
                                                            </center>
                                                        </div>
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
                                                            <span class="title">Contact Number:</span>
                                                            <span class="text"><a
                                                                        href="#"><?php echo $row['phone'] ?></a></span>
                                                            <?php
                                                            if ($row['phone'] == "") {
                                                                echo "<br>";
                                                            }
                                                            ?>
                                                        </li>
                                                        <li>
                                                            <span class="title">Country:</span>
                                                            <span class="text"><a
                                                                        href="#"><?php echo $row['country'] ?></a></span>
                                                            <?php
                                                            if ($row['country'] == "") {
                                                                echo "<br>";
                                                            }
                                                            ?>
                                                        </li>
                                                        <li>
                                                            <span class="title">City:</span>
                                                            <span class="text"><a
                                                                        href="#"><?php echo $row['city'] ?></a></span>
                                                            <?php
                                                            if ($row['city'] == "") {
                                                                echo "<br>";
                                                            }
                                                            ?>
                                                        </li>
                                                        <li>
                                                            <span class="title">Address:</span>
                                                            <span class="text"><a
                                                                        href="#"><?php echo $row['address'] ?></a></span>
                                                            <?php
                                                            if ($row['address'] == "") {
                                                                echo "<br>";
                                                            }
                                                            ?>
                                                        </li>
                                                        <li>
                                                            <span class="title">Joining Date:</span>
                                                            <span class="text"><a
                                                                        href="#"><?php echo $row['joining_date'] ?></a></span>
                                                            <?php
                                                            if ($row['joining_date'] == "") {
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
                                <li class="nav-item"><a class="nav-link" href="#bottom-tab2"
                                                        data-toggle="tab">Address/Location</a></li>
                                <li class="nav-item"><a class="nav-link" href="#bottom-tab3" data-toggle="tab">Links &
                                        Authentication</a></li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane show active" id="about-cont">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card-box">
                                                <h3 class="card-title">Short Description</h3>

                                            </div>
                                        </div>
                                    <div class="col-md-6">
                                            <div class="card-box">
                                                <h3 class="card-title">Other Info</h3>
                                                <ul class="personal-info">

                                                    <li>
                                                        <span class="title">TIN Number:</span>
                                                        <span class="text"></span>

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
                                                        <span class="text"></span>

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
                                                        <span class="text">

                                                        </span>

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
                                                <h3 class="card-title">Authentication Data</h3>
                                                <div class="experience-box">
                                                    <ul class="experience-list">
                                                        <li>
                                                            <div class="experience-user">
                                                                <div class="before-circle"></div>
                                                            </div>
                                                            <div class="experience-content">
                                                                <u>Client ID:</u>&nbsp; <?php echo $row['client_id'] ?>
                                                            </div>
                                                            <div class="experience-content">
                                                                <u>Username:</u>&nbsp; <?php echo $row['username'] ?>
                                                            </div>
                                                            <div class="experience-content">
                                                                <u>Password:</u> <input type="password" id="password"
                                                                                        value="<?php echo $row['password'] ?>"
                                                                                        style="border:none;background: none;outline: none;"
                                                                                        readonly/>
                                                                <button class="btn-outline-danger" onclick="if (password.type == 'text')
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
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo 'No Data Found!';
                } ?>
            </div>

        </div>

</div>
<?php include './parts/js-links.php'; ?>

</body>
</html>