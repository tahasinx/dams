<?php $url = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']); ?>
<div class="sidebar" id="sidebar" style="background-color: #333333;color:white">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="<?php
                if ($url == 'index.php') {
                    echo 'active';
                }
                ?>">
                    <a href="index.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fa fa-user"></i> <span> Profile </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="profile.php" class="<?php
                            if ($url == 'profile.php') {
                                echo 'active';
                            }
                            ?>">My Profile</a></li>
                        <li><a href="update-profile.php" class="<?php
                            if ($url == 'update-profile.php') {
                                echo 'active';
                            }
                            ?>">Edit Profile</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fa fa-users"></i> <span> Partners </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <?php if ($url == 'partner-profile.php') { ?>
                            <li>
                                <a href="" class="<?php
                                if ($url == 'partner-profile.php') {
                                    echo 'active';
                                }
                                ?>">Partner Profile</a>
                            </li>
                        <?php } ?>
                        <?php if ($url == 'partner-update.php') { ?>
                            <li>
                                <a href="" class="<?php
                                if ($url == 'partner-update.php') {
                                    echo 'active';
                                }
                                ?>">Update Partner</a>
                            </li>
                        <?php } ?>
                        <li>
                            <a href="partner-doctors.php" class="<?php
                            if ($url == 'partner-doctors.php') {
                                echo 'active';
                            }
                            ?>">Doctors</a>
                        </li>
                        <li>
                            <a href="partner-labs.php" class="<?php
                            if ($url == 'partner-labs.php') {
                                echo 'active';
                            }
                            ?>">Labs</a>
                        </li>
                        <li>
                            <a href="partner-pharmacies.php" class="<?php
                            if ($url == 'partner-pharmacies.php') {
                                echo 'active';
                            }
                            ?>">Pharmacies</a>
                        </li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fa fa-users"></i> <span> Clients </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <?php if ($url == 'client-profile.php') { ?>
                            <li>
                                <a href="" class="<?php
                                if ($url == 'client-profile.php') {
                                    echo 'active';
                                }
                                ?>">Client Profile</a>
                            </li>
                        <?php } ?>
                        <li><a href="clients.php" class="<?php
                            if ($url == 'clients.php') {
                                echo 'active';
                            }
                            ?>">Clients All</a>
                        </li>

                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fa fa-cubes"></i> <span>Packages</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="new-package.php" class="<?php
                            if ($url == 'new-package.php') {
                                echo 'active';
                            }
                            ?>">New Package</a></li>
                        <li><a href="packages.php" class="<?php
                            if ($url == 'packages.php') {
                                echo 'active';
                            }
                            ?>">View Packages</a></li>
                        <li><a href="packages.php">Update Packages</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fa fa-paper-plane"></i> <span> Requests </span> <span
                                class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="account-verification.php" class="<?php
                            if ($url == 'account-verification.php') {
                                echo 'active';
                            }
                            ?>">Account Verification</a></li>
                        <li><a href="location-verification.php" class="<?php
                            if ($url == 'location-verification.php') {
                                echo 'active';
                            }
                            ?>">Location Verification</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fa fa-envelope"></i> <span> Messages </span> <span
                                class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <?php if ($url == 'message-send.php') { ?>
                            <li><a href="message-send.php" class="<?php
                                if ($url == 'message-send.php') {
                                    echo 'active';
                                }
                                ?>">Send Message</a></li>
                        <?php } ?>
                        <li><a href="message-sent.php" class="<?php
                            if ($url == 'message-sent.php') {
                                echo 'active';
                            }
                            ?>">Sent Messages</a></li>
                        <li><a href="message-inbox.php" class="<?php
                            if ($url == 'message-inbox.php') {
                                echo 'active';
                            }
                            ?>">Inbox</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fa fa-envelope-square"></i> <span> Emails </span> <span
                                class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <?php if ($url == 'email-send.php') { ?>
                            <li><a href="email-send.php" class="<?php
                                if ($url == 'email-send.php') {
                                    echo 'active';
                                }
                                ?>">Send Email</a></li>
                        <?php } ?>
                        <li><a href="email-sent.php" class="<?php
                            if ($url == 'email-sent.php') {
                                echo 'active';
                            }
                            ?>">Sent Emails</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fa fa-pencil"></i> <span> Post & Events </span> <span
                                class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="post-create.php" class="<?php
                            if ($url == 'post-create.php') {
                                echo 'active';
                            }
                            ?>">Create Post</a></li>
                        <li><a href="post-manage.php" class="<?php
                            if ($url == 'post-manage.php') {
                                echo 'active';
                            }
                            ?>">Manage Posts</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-cog"></i> <span>Settings</span> <span
                            class="menu-arrow"></span></a>
                </li>
            </ul>
        </div>
    </div>
</div>