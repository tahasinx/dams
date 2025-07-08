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

                <?php if ($row['premium_status'] === '0') { ?>
                    <li class="submenu">
                        <a href="#"><i class="fa fa-money"></i> <span> Get Premium </span> <span
                                    class="menu-arrow"></span></a>
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
                <?php } ?>

                <li class="submenu">
                    <a href="#"><i class="fa fa-tags"></i> <span> Verification </span> <span
                                class="menu-arrow"></span></a>
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
                    <a href="#"><i class="fa fa-hospital-o"></i>
                        <span>My Pharmacy</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul style="display: none;">
                        <li>
                            <a href="drug-add.php" class="<?php
                            if ($url == 'drug-add.php') {
                                echo 'active';
                            }
                            ?>">Add Drug
                            </a>
                        </li>
                        <li>
                            <a href="drug-repo.php" class="<?php
                            if ($url == 'drug-repo.php') {
                                echo 'active';
                            }
                            ?>">Repository
                            </a>
                        </li>
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
                    <a href="#"><i class="fa fa-book"></i> <span> Orders </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="orders-pending.php" class="<?php
                            if ($url == 'orders-pending.php') {
                                echo 'active';
                            }
                            ?>">Pending</a>
                        </li>
                        <li><a href="orders-in-process.php" class="<?php
                            if ($url == 'orders-in-process.php') {
                                echo 'active';
                            }
                            ?>">In progress</a>
                        </li>
                        <li><a href="orders-delivered.php" class="<?php
                            if ($url == 'orders-delivered.php') {
                                echo 'active';
                            }
                            ?>">Delivered</a>
                        </li>
                        <li><a href="orders-cancelled.php" class="<?php
                            if ($url == 'orders-cancelled.php') {
                                echo 'active';
                            }
                            ?>">Cancelled</a>
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
                <li class="<?php if ($url == 'settings.php') { echo 'active';}?>">
                    <a href="settings.php" "><i class="fa fa-cog"></i> <span>Settings</span></a>
                </li>


            </ul>
        </div>
    </div>
</div>