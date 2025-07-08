<div class="header" style="background-color: black">
    <div class="header-left">
        <a href="index.html" class="logo">
            <!--<img src="assets/img/logo.png" width="35" height="35" alt=""> <span></span>-->
        </a>
    </div>
    <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
    <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
    <ul class="nav user-menu float-right">

        <li class="nav-item dropdown d-none d-sm-block">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"><i class="fa fa-bell-o"></i> <span
                    class="badge badge-pill bg-danger float-right"><div
                        id="notification_count"><?php echo $server->total_notification(); ?></div></span></a>
            <div class="dropdown-menu notifications">
                <div class="topnav-dropdown-header">
                    <span>Notifications</span>
                </div>
                <div class="drop-scroll" id="notifications">
                    <ul class="notification-list">
                        <?php
                        $notifications = $server->get_notifications();

                        while ($row2 = $notifications->fetch_assoc()) { ?>
                            <?php if ($row2['notification_type'] === 'message') { ?>
                                <li class="notification-message" style="<?php if ($row2['is_seen'] == 0) {
                                    echo 'background-color: #9ba1a8';
                                } ?>">
                                    <a href="message-inbox.php">
                                        <div class="media">
                                    <span class="avatar">
                                        <img alt="Admin" src="assets/img/user.jpg" class="img-fluid">
                                    </span>
                                            <div class="media-body">
                                                <p class="noti-details"><span class="noti-title"></span>&nbsp;<span
                                                        class="noti-title"><?php echo $row2['notification_about'] ?></span>
                                                </p>
                                                <p class="noti-time"><span
                                                        class="notification-time"><?php echo $row2['notification_time'] ?></span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            <?php } ?>

                            <?php if ($row2['notification_type'] === 'location') { ?>
                                <li class="notification-message" style="<?php if ($row2['is_seen'] == 0) {
                                    echo 'background-color: #9ba1a8';
                                } ?>">
                                    <a href="verify-location.php">
                                        <div class="media">
                                    <span class="avatar">
                                        <img alt="Admin" src="assets/img/user.jpg" class="img-fluid">
                                    </span>
                                            <div class="media-body">
                                                <p class="noti-details"><span class="noti-title"></span>&nbsp;<span
                                                        class="noti-title"><?php echo $row2['notification_about'] ?></span>
                                                </p>
                                                <p class="noti-time"><span
                                                        class="notification-time"><?php echo $row2['notification_time'] ?></span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            <?php } ?>

                            <?php if ($row2['notification_type'] === 'account') { ?>
                                <li class="notification-message" style="<?php if ($row2['is_seen'] == 0) {
                                    echo 'background-color: #9ba1a8';
                                } ?>">
                                    <a href="verify-account.php">
                                        <div class="media">
                                    <span class="avatar">
                                        <img alt="Admin" src="assets/img/user.jpg" class="img-fluid">
                                    </span>
                                            <div class="media-body">
                                                <p class="noti-details"><span class="noti-title"></span>&nbsp;<span
                                                        class="noti-title"><?php echo $row2['notification_about'] ?></span>
                                                </p>
                                                <p class="noti-time"><span
                                                        class="notification-time"><?php echo $row2['notification_time'] ?></span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </div>
                <div class="topnav-dropdown-footer">

                </div>
            </div>
        </li>
        <li class="nav-item dropdown has-arrow">
            <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                <span class="user-img">
                    <img class="rounded-circle" style="height: 40px;width: 40px"
                         src="<?php echo $row['institute_logo'] ?>"
                         onerror="this.onerror=null; this.src='assets/img/user.jpg'" width="24" alt="">
                    <span class="status online"></span>
                </span>
                <span></span>
            </a>
            <div class="dropdown-menu">
            <a class="dropdown-item" href="profile-details.php">My Profile</a>
            <a class="dropdown-item" href="profile-update.php">Edit Profile</a>
            <a class="dropdown-item" href="settings.php">Settings</a>
            <a class="dropdown-item" href="logout.php">Logout</a>
      </div>
        </li>
    </ul>
    <div class="dropdown mobile-user-menu float-right">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
                class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
        <a class="dropdown-item" href="profile-details.php">My Profile</a>
            <a class="dropdown-item" href="profile-update.php">Edit Profile</a>
            <a class="dropdown-item" href="settings.php">Settings</a>
            <a class="dropdown-item" href="logout.php">Logout</a>
      </div>
    </div>
</div>