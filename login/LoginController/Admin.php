<?php

class Admin {
    
    private $conn;

    public function __construct() {
        $this->conn = new mysqli('localhost', 'root', '', 'dams');
    }

    public function adminLogin($data) {

        $sql = "SELECT *FROM `admin` WHERE username = '$data[username]' AND password = '$data[password]'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['status'] == 0) {
                    return $message = '<span style="color:red">Sorry! You are not authorized!</span>';
                } else {
                    $adminid = $row['admin_id'];
                    $_SESSION['admin_id'] = $adminid;
                    header('location:../../dashboard/admin/index.php');
                }
            }
        } else {
            return $message = '<span style="color:red">Incorrect Login Details!</span>';
        }
    }
    
}
