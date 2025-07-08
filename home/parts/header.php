<div id="fixed-header-dark" class="header-output fixed-header">
    <div class="container header-in">

        <div class="row">
            <div class="col-lg-2 col-md-12">
                <a id="logo" href="index.php" class="d-inline-block margin-tb-15px"><h1><b>DAMS</b></h1></a>
                <a class="mobile-toggle padding-13px background-main-color" href="#"><i class="fas fa-bars"></i></a>
            </div>
            <div class="col-lg-7 col-md-12 position-inherit">
                <ul id="menu-main" class="nav-menu float-lg-right link-padding-tb-20px">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="about-us.php">About Us</a>
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Events</a>
                    </li>
                    <li>
                        <a href="#">Blogs</a>
                    </li>
                    <li>
                        <a href="contact-us.php">Contact Us</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-12 position-inherit">
                <hr class="margin-bottom-0px d-block d-sm-none">
                <?php
                if (isset($_SESSION["logged_in"])) {
                    ?>
                    <ul id="menu-main" class="nav-menu float-lg-right link-padding-tb-20px" style="margin-left: 20px">
                        <?php $total = $server->total_notification();
                        if ($total > 0) {
                            ?>
                            <li class="has-dropdown"><a href="#notifications"><i
                                            class='fa fa-bell faa-ring animated'></i>&nbsp;[ <span
                                            style="color:orangered"><?= $total ?></span> ]</a>
                            </li>
                        <?php } else { ?>
                            <li class="has-dropdown"><a href="#notifications"><i class='fa fa-bell'></i>&nbsp;[ <span
                                            style="color:orangered"><?= $total ?></span> ]</a>
                            </li>
                        <?php } ?>
                        <li class="has-dropdown"><a href="#"><i class="fa fa-user"></i>&nbsp;PROFILE</a>
                            <ul class="sub-menu">
                                <li><a href="dashboard.php"><i class="fa fa-dashboard"></i>&nbsp;Dashboard </a></li>
                                <li><a href="logout.php"><i class="fa fa-sign-out"></i>&nbsp;Sign out</a></li>
                            </ul>
                        </li>
                    </ul>
                <?php } ?>
                <?php
                if (!isset($_SESSION["logged_in"])) {
                    ?>
                    <a href="#modal1"
                       class="btn btn-sm border-radius-30 margin-tb-15px text-white background-second-color  box-shadow float-right padding-lr-20px margin-left-30px">
                        Sign Up
                    </a>
                    <a href="../login/clients/"
                       class="margin-tb-20px d-inline-block text-up-small float-left float-lg-right">Login</a>
                <?php } ?>
            </div>
        </div>
        <div class="awesome-modal" id="modal1"><a class="close-icon" href="#close"></a>
            <center>
                <h3 class="modal-title">How do you want to sign up with us?</h3>
                <br>
                <a class="btn btn-primary" href="partner-signup.php" style="width:100px">Partner</a>&emsp;||&emsp;<a
                        class="btn btn-dark" href="client-email.php" style="width:100px">Client</a>
            </center>
        </div>
        <?php
        if (isset($_SESSION["logged_in"])) {
            ?>
            <div class="awesome-modal" id="notifications"><a class="close-icon" href="#close"></a>
                <h3 class="modal-title">Notifications</h3>
                <ul>
                    <?php $notifications = $server->notifications();
                    if ($notifications->num_rows > 0) {
                        while ($x = $notifications->fetch_assoc()) {
                            ?>
                            <li style="color:<?php if ($x['is_seen'] == 0) {
                                echo 'orangered';
                            } ?>">
                                <h4><?= $x['notification_about'] ?></h4>
                                <small style=""><?= $x['notification_time'] ?></small>
                            </li>
                        <?php }
                    }
                    ?>

                </ul>

            </div>
        <?php } ?>
    </div>
</div>