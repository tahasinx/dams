<?php

class Admin
{

    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli('localhost', 'root', '', 'dams');
    }

    public function adminData()
    {
        $adminid = $_SESSION['admin_id'];
        $sql = "SELECT *FROM admin WHERE admin_id = '$adminid' AND type='admin'";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function updateAdmin($data)
    {
        $adminid = $_SESSION['admin_id'];
        $directory = '../gallery/propic/admin/';

        if ($_FILES['propic']['name'] == "") {
            $propic = $_SESSION['oldpic'];
        } else {
            $propic = $directory . basename($_FILES['propic']['name']);
            move_uploaded_file($_FILES['propic']['tmp_name'], $propic);
        }

        $sql = "UPDATE `admin` SET "
            . "`first_name`='$data[first_name]',"
            . "`last_name`='$data[last_name]',"
            . "`email`='$data[email]',"
            . "`phone`='$data[phone]',"
            . "`admin_id`='$data[admin_id]',"
            . "`username`='$data[username]',"
            . "`password`='$data[password]',"
            . "`propic`='$propic'"
            . " WHERE admin_id = '$adminid'";

        if ($this->conn->query($sql) === TRUE) {
            echo "<script type='text/javascript'>alert('UPDATED!');document.location='profile.php';</script>";
        } else {
            return $message = 'ERROR:' . $this->conn->error;
        }
    }


    public function create_package($data)
    {

        $sql = "INSERT INTO `packages`(`package_name`, `price_taka`, `price_usd`, `offer_1`, `offer_2`, `offer_3`, `offer_4`, `offer_5`, `offer_6`, `offer_7`, `offer_8`, `offer_9`, `offer_10`, `publication_status`) VALUES "
            . "('$data[package_name]','$data[price_taka]','$data[price_usd]','$data[offer_1]','$data[offer_2]','$data[offer_3]','$data[offer_4]','$data[offer_5]','$data[offer_6]','$data[offer_7]','$data[offer_8]','$data[offer_9]','$data[offer_10]','$data[publication_status]')";
        if ($this->conn->query($sql) === TRUE) {
            return $message = "Package created successfully.";
        } else {
            return $message = "Package exists.";
        }
    }

    public function package_bronze()
    {
        $sql = "SELECT * FROM `packages` WHERE package_name = 'Bronze'";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function package_silver()
    {
        $sql = "SELECT * FROM `packages` WHERE package_name = 'Silver'";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function package_gold()
    {
        $sql = "SELECT * FROM `packages` WHERE package_name = 'Gold'";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function package_platinum()
    {
        $sql = "SELECT * FROM `packages` WHERE package_name = 'Platinum'";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function package_byName()
    {
        $package_name = $_GET['package_name'];
        $sql = "SELECT * FROM `packages` WHERE package_name = '$package_name'";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function update_package($data)
    {

        $package_name = $_GET['package_name'];

        $sql = "UPDATE `packages` SET "
            . "`package_name`='$data[package_name]',"
            . "`price_taka`='$data[price_taka]',"
            . "`price_usd`='$data[price_usd]',"
            . "`offer_1`='$data[offer_1]',"
            . "`offer_2`='$data[offer_2]',"
            . "`offer_3`='$data[offer_3]',"
            . "`offer_4`='$data[offer_4]',"
            . "`offer_5`='$data[offer_5]',"
            . "`offer_6`='$data[offer_6]',"
            . "`offer_7`='$data[offer_7]',"
            . "`offer_8`='$data[offer_8]',"
            . "`offer_9`='$data[offer_9]',"
            . "`offer_10`='$data[offer_10]',"
            . "`publication_status`='$data[publication_status]'"
            . " WHERE `package_name`='$package_name'";
        if ($this->conn->query($sql) === TRUE) {
            echo "<script type='text/javascript'>alert('Updated!');document.location='packages.php';</script>";
        } else {
            return $this->conn->error;
        }
    }

//    verifications

    public function account_requests()
    {

        $sql = "SELECT *FROM `partners` WHERE account_request = 1 AND status = 1";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function location_requests()
    {

        $sql = "SELECT *FROM `partners` WHERE location_request = 1 AND status = 1";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function total_account_requests()
    {
        $query = "SELECT COUNT(id) FROM `partners` WHERE account_request = 1 ";
        $result = mysqli_query($this->conn, $query);
        $rows = mysqli_fetch_row($result);
        $count = $rows[0];
        return $count;
    }

    public function total_location_requests()
    {
        $query = "SELECT COUNT(id) FROM `partners` WHERE location_request = 1 ";
        $result = mysqli_query($this->conn, $query);
        $rows = mysqli_fetch_row($result);
        $count = $rows[0];
        return $count;
    }

    public function verify_account()
    {
        $partner_id = $_GET['partner_id'];
        $verification_type = $_GET['verification_type'];

        $sql = "SELECT * FROM `verification` WHERE partner_id = '$partner_id' AND verification_type = '$verification_type' AND status = 0";
        $result = $this->conn->query($sql);
        return $result;

    }

    public function certificates()
    {
        $partner_id = $_GET['partner_id'];
        $sql = "SELECT * FROM `verification` WHERE partner_id = '$partner_id' ORDER BY id DESC LIMIT 1";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function verify_location()
    {
        $partner_id = $_GET['partner_id'];
        $verification_type = $_GET['verification_type'];

        $sql = "SELECT * FROM `verification` WHERE partner_id = '$partner_id' AND verification_type = '$verification_type' AND status = 0";
        $result = $this->conn->query($sql);
        return $result;

    }

    public function acceptAccount($data)
    {
        date_default_timezone_set('Asia/Dhaka');
        $notification_id = "notification@" . date("Y-m-d") . '?' . date("H:i:s");
        $partner_id = $_GET['partner_id'];
        $verification_type = $_GET['verification_type'];
        $time = date("l ,F j, Y, g:i a");

        $sql = "UPDATE `partners` SET `account_status`= 1 , `account_request`= 0 WHERE partner_id = '$partner_id' ";
        if ($this->conn->query($sql) === TRUE) {
            $sql = "UPDATE `verification` SET `status`=1 WHERE partner_id = '$partner_id' AND verification_type = '$verification_type' ";
            if ($this->conn->query($sql) === TRUE) {
                $sql = "INSERT INTO `notifications`(`notification_id`, `notification_to`, `notification_from`, `notification_type`, `notification_about`, `notification_for`, `notification_time`) VALUES
              ('$notification_id','$partner_id','admin','account','Your account has been verified.','partner','$time')";
                if ($this->conn->query($sql) === TRUE) {
                    echo "<script type='text/javascript'>alert('Accepted!');document.location='account-verification.php';</script>";
                }

            } else {
                return $this->conn->error;
            }
        } else {
            return $this->conn->error;
        }
    }

    public function acceptLocation($data)
    {
        date_default_timezone_set('Asia/Dhaka');
        $notification_id = "notification@" . date("Y-m-d") . '?' . date("H:i:s");
        $partner_id = $_GET['partner_id'];
        $verification_type = $_GET['verification_type'];
        $time = date("l ,F j, Y, g:i a");

        $sql = "UPDATE `partners` SET `location_status`= 1 , `location_request`= 0 WHERE partner_id = '$partner_id' ";
        if ($this->conn->query($sql) === TRUE) {
            $sql = "UPDATE `verification` SET `status`=1 WHERE partner_id = '$partner_id' AND verification_type = '$verification_type' ";

            $sql = "UPDATE `verification` SET `status`=1 WHERE partner_id = '$partner_id' AND verification_type = '$verification_type' ";
            if ($this->conn->query($sql) === TRUE) {
                $sql = "INSERT INTO `notifications`(`notification_id`, `notification_to`, `notification_from`, `notification_type`, `notification_about`, `notification_for`, `notification_time`) VALUES
              ('$notification_id','$partner_id','admin','location','Your location has been verified.','partner','$time')";
                if ($this->conn->query($sql) === TRUE) {
                    echo "<script type='text/javascript'>alert('Accepted!');document.location='location-verification.php';</script>";
                }

            } else {
                return $this->conn->error;
            }
        } else {
            return $this->conn->error;
        }
    }

    public function account_verification_Failed($data)
    {
        $partner_id = $_GET['partner_id'];
        $verification_type = $_GET['verification_type'];

        $sql = "UPDATE `partners` SET `account_failed`= 1 , `account_request`= 0 ,`account_failed`= '$data[failed_cause]' WHERE partner_id = '$partner_id' ";
        if ($this->conn->query($sql) === TRUE) {
            $sql = "DELETE FROM `verification` WHERE partner_id = '$partner_id'AND verification_type = '$verification_type' ";;
            if ($this->conn->query($sql) === TRUE) {
                echo "<script type='text/javascript'>alert('Cancelled!');document.location='account-verification.php';</script>";
            } else {
                return $this->conn->error;
            }
        } else {
            return $this->conn->error;
        }
    }

    public function location_verification_Failed($data)
    {
        $partner_id = $_GET['partner_id'];
        $verification_type = $_GET['verification_type'];

        $sql = "UPDATE `partners` SET `location_failed`= 1 , `location_request`= 0 ,`location_failed`= '$data[failed_cause]' WHERE partner_id = '$partner_id' ";
        if ($this->conn->query($sql) === TRUE) {
            $sql = "DELETE FROM `verification` WHERE partner_id = '$partner_id'AND verification_type = '$verification_type' ";;
            if ($this->conn->query($sql) === TRUE) {
                echo "<script type='text/javascript'>alert('Cancelled!');document.location='location-verification.php';</script>";
            } else {
                return $this->conn->error;
            }
        } else {
            return $this->conn->error;
        }
    }

    //partners

    public function partner_data()
    {

        if (isset($_GET['partner_id'])) {
            $partner_id = $_GET['partner_id'];
        } else {
            $partner_id = '';
        }

        $sql = "SELECT *FROM partners WHERE partner_id = '$partner_id' ";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function partner_profile()
    {

        if (isset($_GET['partner_id'])) {
            $partner_id = $_GET['partner_id'];
        } else {
            $partner_id = '';
        }

        $sql = "SELECT *FROM partners WHERE partner_id = '$partner_id' ";
        $result = $this->conn->query($sql);
        return $result;
    }


    public function view_pharmacies()
    {
        $sql = "SELECT * FROM `partners` WHERE partnership_zone = 'pharmacy' ORDER BY id DESC ";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function view_doctors()
    {
        $sql = "SELECT * FROM `partners` WHERE partnership_zone = 'doctor' ORDER BY id DESC";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function view_labs()
    {
        $sql = "SELECT * FROM `partners` WHERE partnership_zone = 'lab' ORDER BY id DESC";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function view_branches()
    {
        if (isset($_GET['partner_id'])) {
            $partner_id = $_GET['partner_id'];
        } else {
            $partner_id = '';
        }
        $sql = "SELECT * FROM `branches` WHERE partner_id = '$partner_id' ";
        $result = $this->conn->query($sql);
        return $result;
    }


    public function remove_partner($data)
    {
        $sql = "DELETE FROM `partners` WHERE partner_id = '$data[partner_id]'";
        if ($this->conn->query($sql) === TRUE) {
            $sql = "DELETE FROM `branches` WHERE partner_id = '$data[partner_id]'";
            if ($this->conn->query($sql) === TRUE) {

                $sql1 = "DELETE FROM `appointments` WHERE request_to = '$data[partner_id]'";


                $sql2 = "DELETE FROM `available_tests` WHERE partner_id = '$data[partner_id]'";


                $sql3 = "DELETE FROM `drugs` WHERE partner_id = '$data[partner_id]'";

                $sql4 = "DELETE FROM `drugs_ordered` WHERE partner_id = '$data[partner_id]'";

                $sql5 = "DELETE FROM `prescriptions` WHERE partner_id = '$data[partner_id]'";

                if ($this->conn->query($sql1 || $sql2 || $sql3 || $sql4 || $sql5) === TRUE) {

                    return "<script type='text/javascript'>alert('Removed!');document.location='index.php';</script>";

                } else {

                }
                return "<script type='text/javascript'>alert('Removed!');document.location='index.php';</script>";
            } else {

            }
            return "<script type='text/javascript'>alert('Removed!');document.location='index.php';</script>";
        } else {

        }
    }

    public function block_partner($data)
    {

        $id = $data['partner_id'];

        $sql = "UPDATE `partners` SET status = 0 WHERE partner_id = '$data[partner_id]'";

        if ($this->conn->query($sql) === TRUE) {
            $sql = "UPDATE `branches` SET status = 0 WHERE partner_id = '$data[partner_id]'";
            if ($this->conn->query($sql) === TRUE) {

                $sql1 = "UPDATE `appointments` SET status = 0 WHERE request_to = '$data[partner_id]'";


                $sql2 = "UPDATE `available_tests` SET status = 0 WHERE partner_id = '$data[partner_id]'";


                $sql3 = "UPDATE `drugs` SET publication_status = 0 WHERE partner_id = '$data[partner_id]'";

                $sql4 = "UPDATE `drugs_ordered` SET is_cancelled = 1 WHERE partner_id = '$data[partner_id]'";

                $sql5 = "UPDATE `prescriptions` SET is_cancelled = 1 WHERE partner_id = '$data[partner_id]'";

                if ($this->conn->query($sql1 || $sql2 || $sql3 || $sql4 || $sql5) === TRUE) {

                    header('location:partner-profile.php?partner_id=' . $id);
                } else {

                }
                header('location:partner-profile.php?partner_id=' . $id);
            } else {

            }
            header('location:partner-profile.php?partner_id=' . $id);
        } else {

        }
    }

    public function unblock_partner($data)
    {

        $id = $data['partner_id'];

        $sql = "UPDATE `partners` SET status = 1 WHERE partner_id = '$data[partner_id]'";

        if ($this->conn->query($sql) === TRUE) {

            $sql = "UPDATE `branches` SET status = 1 WHERE partner_id = '$data[partner_id]'";

            if ($this->conn->query($sql) === TRUE) {

                $sql1 = "UPDATE `appointments` SET status = 1 WHERE request_to = '$data[partner_id]'";


                $sql2 = "UPDATE `available_tests` SET status = 1 WHERE partner_id = '$data[partner_id]'";


                $sql3 = "UPDATE `drugs` SET publication_status = 1 WHERE partner_id = '$data[partner_id]'";

                $sql4 = "UPDATE `drugs_ordered` SET is_cancelled = 0 WHERE partner_id = '$data[partner_id]'";

                $sql5 = "UPDATE `prescriptions` SET is_cancelled = 0 WHERE partner_id = '$data[partner_id]'";

                if ($this->conn->query($sql1 || $sql2 || $sql3 || $sql4 || $sql5) === TRUE) {

                    header('location:partner-profile.php?partner_id=' . $id);

                } else {

                }
                header('location:partner-profile.php?partner_id=' . $id);
            } else {

            }
            header('location:partner-profile.php?partner_id=' . $id);
        } else {

        }
    }

//clients

    public function view_clients()
    {
        $sql = "SELECT * FROM `clients` ";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function client_data()
    {

        if (isset($_GET['client_id'])) {
            $client_id = $_GET['client_id'];
        } else {
            $client_id = '';
        }

        $sql = "SELECT *FROM `clients` WHERE client_id = '$client_id' ";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function remove_client($data)
    {
        $sql = "DELETE FROM `clients` WHERE client_id = '$data[client_id]'";

        if ($this->conn->query($sql) === TRUE) {

            $sql1 = "DELETE FROM `appointments` WHERE request_from = '$data[client_id]'";

            $sql2 = "DELETE FROM `drugs_ordered` WHERE client_id = '$data[client_id]'";

            $sql3 = "DELETE FROM `prescriptions` WHERE client_id = '$data[client_id]'";

            if ($this->conn->query($sql1 || $sql2 || $sql3) === TRUE) {

                return "<script type='text/javascript'>alert('Removed!');document.location='clients.php';</script>";

            } else {

            }
            return "<script type='text/javascript'>alert('Removed!');document.location='clients.php';</script>";
        } else {

        }
    }

    public function block_client($data)
    {

        $id = $data['client_id'];

        $sql = "UPDATE `clients` SET status = 0 WHERE client_id = '$data[client_id]'";

        if ($this->conn->query($sql) === TRUE) {

            $sql1 = "UPDATE `appointments` SET status = 0 WHERE request_from = '$data[client_id]'";

            $sql2 = "UPDATE `drugs_ordered` SET is_cancelled = 1 WHERE client_id = '$data[client_id]'";

            $sql3 = "UPDATE `prescriptions` SET is_cancelled = 1 WHERE client_id = '$data[client_id]'";

            if ($this->conn->query($sql1 || $sql2 || $sql3) === TRUE) {

                header('location:client-profile.php?client_id=' . $id);

            } else {

            }
            header('location:client-profile.php?client_id=' . $id);
        } else {

        }
    }

    public function unblock_client($data)
    {

        $id = $data['client_id'];

        $sql = "UPDATE `clients` SET status = 1 WHERE client_id = '$data[client_id]'";

        if ($this->conn->query($sql) === TRUE) {

            $sql1 = "UPDATE `appointments` SET status = 1 WHERE request_from = '$data[client_id]'";

            $sql2 = "UPDATE `drugs_ordered` SET is_cancelled = 0 WHERE client_id = '$data[client_id]'";

            $sql3 = "UPDATE `prescriptions` SET is_cancelled = 0 WHERE client_id = '$data[client_id]'";

            if ($this->conn->query($sql1 || $sql2 || $sql3) === TRUE) {

                header('location:client-profile.php?client_id=' . $id);

            } else {

            }
            header('location:client-profile.php?client_id=' . $id);
        } else {

        }
    }


//    totals

    public function total_doctors()
    {
        $sql = "SELECT id FROM partners WHERE partnership_zone = 'Doctor'";
        $result = $this->conn->query($sql);
        $total = $result->num_rows;
        return $total;
    }

    public function total_labs()
    {
        $sql = "SELECT id FROM partners WHERE partnership_zone = 'Lab'";
        $result = $this->conn->query($sql);
        $total = $result->num_rows;
        return $total;
    }

    public function total_pharmacies()
    {
        $sql = "SELECT id FROM partners WHERE partnership_zone = 'Pharmacy'";
        $result = $this->conn->query($sql);
        $total = $result->num_rows;
        return $total;
    }

    public function total_branches()
    {
        if (isset($_GET['partner_id'])) {
            $partner_id = $_GET['partner_id'];
        } else {
            $partner_id = '';
        }
        $sql = "SELECT id FROM `branches` WHERE partner_id = '$partner_id' ";
        $result = $this->conn->query($sql);
        $total = $result->num_rows;
        return $total;
    }


//    Email

    public function send_email($data)
    {
        require("../../mailer/PHPMailer/src/PHPMailer.php");
        require("../../mailer/PHPMailer/src/SMTP.php");

        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->IsSMTP(); // enable SMTP

        $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465; // or 587
        $mail->IsHTML(true);
        $mail->Username = "projectdams291@gmail.com";
        $mail->Password = "diagnosticassistant";
        $mail->SetFrom("admin.dams@project.com");
        $mail->Subject = "$data[subject]";
        $mail->Body = "$data[message]";
        $mail->AddAddress("$data[address]");

        if (!$mail->Send()) {
            return "Mailer Error: " . $mail->ErrorInfo;
        } else {
            date_default_timezone_set('Asia/Dhaka');
            $email_id = "email@" . date("Y-m-d") . '?' . date("H:i:s");
            $time = date("l ,F j, Y, g:i a");

            $sql = "INSERT INTO `emails`(`email_id`, `email_to`, `address`, `cc`, `bcc`, `subject`, `message`, `sent_on`, `is_sent`) VALUES 
              ('$email_id','$data[email_to]','$data[address]','$data[cc]','$data[bcc]','$data[subject]','$data[message]','$time',1)";
            if ($this->conn->query($sql) === TRUE) {
                header('location:email-send.php?partner_id=' . $data['mail_to'] . '&email=' . $data['address'] . '&message=Email has been sent successfully!');
            } else {

            }

        }
    }

    public function view_emails()
    {
        $sql = "SELECT * FROM `emails` WHERE is_sent = 1";
        $result = $this->conn->query($sql);
        return $result;
    }

//    Messages
    public function send_message($data)
    {
        date_default_timezone_set('Asia/Dhaka');
        $message_id = "message@" . date("Y-m-d") . '?' . date("H:i:s");
        $notification_id = "notification@" . date("Y-m-d") . '?' . date("H:i:s");
        $time = date("l ,F j, Y, g:i a");
        $for = $_GET['for'];

        $sql = "INSERT INTO `messages`(`message_id`, `message_from`, `message_to`, `message_for`, `message_body`, `sent_on`) VALUES 
              ('$message_id','admin','$data[message_to]','$for','$data[message_body]','$time')";
        if ($this->conn->query($sql) === TRUE) {
            $sql = "INSERT INTO `notifications`(`notification_id`, `notification_to`, `notification_from`, `notification_type`, `notification_about`, `notification_for`, `notification_time`) VALUES
              ('$notification_id','$data[message_to]','admin','message','Admin sent a new message.','$for','$time')";
            if ($this->conn->query($sql) === TRUE) {
                if ($for == 'partner') {

                    header('location:message-send.php?partner_id=' . $data['message_to'] . '&message=Message has been sent successfully!&for=partner');
                } elseif ($for == 'client') {

                    header('location:message-send.php?client_id=' . $data['message_to'] . '&message=Message has been sent successfully!&for=client');
                }


            } else {

            }
        } else {

        }
    }

    public function view_messages()
    {
        $sql = "SELECT * FROM `messages` WHERE `message_from` = 'admin'";
        $result = $this->conn->query($sql);
        return $result;
    }

//    posts

    public function create_post($data)
    {
        date_default_timezone_set('Asia/Dhaka');
        $post_id = "post@" . date("Y-m-d") . '?' . date("H:i:s");
        $time = date("l ,F j, Y, g:i a");
        $sql = "INSERT INTO `posts`(`post_id`, `posted_by`,`posted_for`, `post_title`, `post_description`, `posted_on`, `publication_status`) VALUES 
              ('$post_id','admin','$data[posted_for]','$data[post_title]','$data[post_description]','$time','$data[publication_status]')";
        if ($this->conn->query($sql) === TRUE) {
            $message = "Post has been created successfully!";
            return $message;
        } else {

        }
    }

    public function view_posts()
    {
        $sql = "SELECT * FROM `posts` WHERE `posted_by` = 'admin' ORDER BY id DESC ";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function delete_post($data)
    {
        $sql = "DELETE FROM `posts` WHERE post_id = '$data[post_id]'";
        if ($this->conn->query($sql) === TRUE) {

            header('location:post-manage.php');

        } else {

        }
    }

    public function change_post_status($data)
    {

        $sql = "UPDATE `posts` SET `publication_status`='$data[publication_status]' WHERE post_id = '$data[post_id]'";
        if ($this->conn->query($sql) === TRUE) {

            header('location:post-manage.php');

        } else {

        }
    }

    public function received_messages()
    {

        $sql = "SELECT * FROM `messages` WHERE `message_for` = 'admin'";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function mark_as_seen($data){
        $sql="UPDATE `messages` SET `is_seen`= 1 WHERE `message_id` = '$data[message_id]'";
        if($this->conn->query($sql) === TRUE){
            header('location:message-inbox.php');
        }else{

        }
    }

    public function get_notifications()
    {
        $sql = "SELECT * FROM `notifications` WHERE notification_to = 'admin' ORDER BY id DESC";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function notification_seen($type)
    {

        $sql = "UPDATE `notifications` SET `is_seen`='1' WHERE notification_to = 'admin' AND notification_type = '$type'";
        if ($this->conn->query($sql) === TRUE) {

        } else {

        }
    }

    //    totals

    public function total_notification()
    {
        $query = "SELECT COUNT(id) FROM `notifications` WHERE notification_to = 'admin' AND is_seen = 0";
        $result = mysqli_query($this->conn, $query);
        $rows = mysqli_fetch_row($result);
        $count = $rows[0];
        return $count;
    }

}
