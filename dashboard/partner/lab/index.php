<?php
session_start();
$partner_id = $_SESSION['partner_id'];

if (!isset($_SESSION["partner_id"]) && !isset($_SESSION["zone"])) {
    header("location:logout.php");
}

require_once './server/Partner.php';
$result = "";

$server = new Partner();

$result = $server->partner_data();
$posts = $server->view_posts();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>DAMS</title>

    <?php
    include './parts/css-links.php';
    ?>

</head>

<body>

<div class="main-wrapper">
    <?php while ($row = $result->fetch_assoc()) {
        $profile_status = $row['profile_status']
        ?>
        <!--topnav-->
        <?php include './parts/top-nav.php'; ?>

        <!--sidenav-->
        <?php include './parts/side-nav.php'; ?>

    <?php } ?>
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <a href="branch-list.php">
                        <div class="dash-widget">
                            <span class="dash-widget-bg1"><i class="fa fa-home" aria-hidden="true"></i></span>
                            <div class="dash-widget-info text-right">
                                <h3><?= $server->total_branch() ?></h3>
                                <span class="widget-title1">Branches <i class="fa fa-check"
                                                                        aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <a href="appointments.php">
                        <div class="dash-widget">
                            <span class="dash-widget-bg2"><i class="fa fa-cubes"></i></span>
                            <div class="dash-widget-info text-right">
                                <h3><?= $server->pending_appointments() ?></h3>
                                <span class="widget-title2">Pending<i class="fa fa-check" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <a href="appointments-upcoming.php">
                        <div class="dash-widget">
                            <span class="dash-widget-bg3"><i class="fa fa-paper-plane" aria-hidden="true"></i></span>
                            <div class="dash-widget-info text-right">
                                <h3><?= $server->upcoming_appointments() ?></h3>
                                <span class="widget-title3">Upcoming <i class="fa fa-check"
                                                                        aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <a href="appointments.php">
                        <div class="dash-widget">
                            <span class="dash-widget-bg4"><i class="fa fa-heartbeat" aria-hidden="true"></i></span>
                            <div class="dash-widget-info text-right">
                                <h3><?= $server->pending_appointments() ?></h3>
                                <span class="widget-title4">Pending <i class="fa fa-check"
                                                                       aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title d-inline-block">Posts & Events</h4>
                        </div>
                        <div class="card-body p-0">
                            <div class="row">
                                <?php if ($posts->num_rows > 0) {
                                    while ($row = $posts->fetch_assoc()) {
                                        ?>

                                        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
                                            <div class="dash-widget">
                                                <div style="padding: 3%">

                                                    <h3><?= $row['post_title'] ?></h3>

                                                    <br>
                                                    <br>
                                                    <?= $row['post_description'] ?>
                                                    <br>
                                                    <br>
                                                    <table>
                                                        <tr>
                                                            <td style="color:blueviolet">Posted By:</td>
                                                            <td><?= $row['posted_by'] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="color:blueviolet">Posted For:</td>
                                                            <td><?= $row['posted_for'] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="color:blueviolet">Posted On:</td>
                                                            <td><?= $row['posted_on'] ?></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                    <?php }
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
<div class="sidebar-overlay" data-reff=""></div>

<!--scripts-->
<?php include './parts/js-links.php'; ?>

</body>


</html>