<?php

class Client {
    
    private $conn;

    public function __construct() {
        $this->conn = new mysqli('localhost', 'root', '', 'dams');
    }

    public function clientLogin($data) {

        $sql = "SELECT *FROM `clients` WHERE username = '$data[username]' AND password = '$data[password]'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['status'] == 0) {
                    return $message = '<span style="color:red">Sorry! You are not authorized!</span>';
                } else {
                    $client_id = $row['client_id'];
                    $_SESSION['client_id'] = $client_id;
                    $_SESSION['logged_in'] = 'logged_in';
                    header('location:../../home/index.php');
                }
            }
        } else {
            return $message = '<span style="color:red">Incorrect Login Details!</span>';
        }
    }
}
