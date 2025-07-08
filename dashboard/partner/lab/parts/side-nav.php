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
                        <li><a href="profile-details.php" class="<?php
                            if ($url == 'profile-details.php') {
                                echo 'active';
                            }
                            ?>">My Profile</a></li>
                        <li><a href="profile-update.php" class="<?php
                            if ($url == 'profile-update.php') {
                                echo 'active';
                            }
                            ?>">Edit Profile</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fa fa-home"></i>
                        <span>My Branches</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul style="display: none;">
                        <li>
                            <a href="branch-create.php" class="<?php
                            if ($url == 'branch-create.php') {
                                echo 'active';
                            }
                            ?>">New Branch
                            </a>
                        </li>
                        <li>
                            <a href="branch-list.php" class="<?php
                            if ($url == 'branch-list.php') {
                                echo 'active';
                            }
                            ?>">Branch List
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fa fa-hospital-o"></i><span>Test Category</span> <span
                                class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="new-category.php" class="<?php
                            if ($url == 'new-category.php') {
                                echo 'active';
                            }
                            ?>">Create Category</a></li>
                        <li><a href="manage-category.php" class="<?php
                            if ($url == 'manage-category.php') {
                                echo 'active';
                            }
                            ?>">Manage Category</a></li>
                    </ul>
                </li>
                <?php if ($row['partnership_zone'] == "lab") { ?>
                    <li class="submenu">
                        <a href="#"><i class="fa fa-hospital-o"></i><span>Diagnostic Test</span> <span
                                    class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="select-category.php" class="<?php
                                if ($url == 'select-category.php' || $url == 'create-test.php') {
                                    echo 'active';
                                }
                                ?>">Create New</a></li>
                            <li><a href="test-repository.php" class="<?php
                                if ($url == 'test-repository.php' || $url == 'test-by-category.php' || $url == 'test-by-category.php' || $url == 'test-details.php') {
                                    echo 'active';
                                }
                                ?>">Repository</a></li>
                        </ul>
                    </li>
                <?php } elseif ($row['partnership_zone'] == "lab") { ?>

                    <li class="submenu">
                        <a href="#"><i class="fa fa-hospital-o"></i><span>Diagnostic Test</span> <span
                                    class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="select-category.php" class="<?php
                                if ($url == 'select-category.php' || $url == 'select-test.php' || $url == 'create-test.php') {
                                    echo 'active';
                                }
                                ?>">Create New</a></li>
                            <li><a href="test-repository.php" class="<?php
                                if ($url == 'test-repository.php' || $url == 'test-by-category.php' || $url == 'test-by-category.php' || $url == 'test-details.php') {
                                    echo 'active';
                                }
                                ?>">Repository</a></li>
                        </ul>
                    </li>

                <?php } ?>
                <li class="submenu">
                    <a href="#"><i class="fa fa-money"></i> <span> Get Premium </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="premium-packages.php" class="<?php
                            if ($url == 'premium-packages.php') {
                                echo 'active';
                            }
                            ?>">Premium Packages</a></li>
                        <li><a href="#" class="<?php
                            if ($url == '') {
                                echo 'active';
                            }
                            ?>">Premium History</a></li>

                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fa fa-tags"></i> <span> Verification </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="verify-account.php" class="<?php
                            if ($url == 'verify-account.php') {
                                echo 'active';
                            }
                            ?>">Verify Account</a></li>
                        <li><a href="verify-location.php" class="<?php
                            if ($url == 'verify-location.php') {
                                echo 'active';
                            }
                            ?>">Verify Location</a></li>

                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fa fa-book"></i> <span> Appointments </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="appointments.php" class="<?php
                            if ($url == 'appointments.php') {
                                echo 'active';
                            }
                            ?>">Requests</a>
                        </li>
                        <li><a href="upcoming-appointments.php" class="<?php
                            if ($url == 'upcoming-appointments.php') {
                                echo 'active';
                            }
                            ?>">Upcoming</a>
                        </li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fa fa-envelope"></i> <span> Messages </span> <span
                                class="menu-arrow"></span></a>
                    <ul style="display: none;">

                        <li><a href="message-send.php" class="<?php
                            if ($url == 'message-send.php') {
                                echo 'active';
                            }
                            ?>">Send Message</a></li>

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
                <li>
                    <a href="settings.php"><i class="fa fa-cog"></i> <span>Settings</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>