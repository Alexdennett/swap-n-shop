<?php

class API
{   
    private $host = "ad1045.brighton.domains";
    private $db_name = "ad1045_group_project";
    private $username = "ad1045_test_user";
    private $password = "v3=-nl+SX@nm";
    private $connection;
    private $status;
    public $output = '';

    function __construct()
    {
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->db_name);
    }

    private function __destruct()
    {
        
            $this->connection->close();
       
    }

    public function handle_Request(){

        if ($this->conn->connect_errno) {
            
            $this->status = 500;
            printf("Connect failed why oh why: %s\n", $this->connection->connect_error);
            exit();

        } elseif ($_SERVER['REQUEST_METHOD'] === 'GET'){
            $this->get();

        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $this->post();


        } else{
            $this->status = 400;
        }
        
        http_response_code($this->status);
        echo $this->result;

    }

    private function post(){
        if (isset($_POST['price']) && isset($_POST['name']) && isset($_POST['desc']) && isset($_POST['condition']) && isset($_POST['department'])){
            
            $price = $this->connection->real_escape_string($_POST['price']);
            $name = $this->connection->real_escape_string($_POST['name']);
            $desc = $this->connection->real_escape_string($_POST['desc']);
            $condition = $this->connection->real_escape_string($_POST['condition']);
            $department = $this->connection->real_escape_string($_POST['department']);
            
            $this->connection->query("INSERT INTO `Listings` (`ListingsID`, `UserID`, `ListingsStatus`, `ListingsPrice`, `ListingsName`, `ListingsDescription`, `ListingsCondition`, `ListingsTime`, `Image`, `Department`) VALUES (NULL, '10', 'Sale', '$price', '$name', '$desc', '$condition', '2021-05-04 13:17:32.000000', 'NULL', '$department')");

            $id           = $this->connection->insert_id;
            $input        = $this->connection->query("SELECT ListingsID FROM `Listings` WHERE ListingsID = '$id'");
            $this->status = 201;
            header('content-type: application/json');
            echo json_encode($input->fetch_assoc());
            
            

        } else {
            $this->status = 400;
            
        }
    }
        

    private function get(){
        if (isset($_GET['search']) && isset($_GET['min']) && isset($_GET['max']) && isset($_GET['selected']) && isset($_GET['category'])){


            $search = $this->connection->real_escape_string($_GET['search']);
            $min = $this->connection->real_escape_string($_GET['min']);
            $max = $this->connection->real_escape_string($_GET['max']);
            $selected = $this->connection->real_escape_string($_GET['selected']);
            $category = $this->connection->real_escape_string($_GET['category']);
            $selectedArray = explode(',', $selected);
            
            $imp = "'" . implode( "','", ($selectedArray) ) . "'";
            if ($category == "All"){
               $result = $this->connection->query("SELECT * FROM `Listings` INNER JOIN UserData ON Listings.UserID = UserData.UserID  WHERE ListingsName = '$search' AND ListingsPrice >= $min AND ListingsPrice <= $max AND UserCampus IN ($imp)");
            } else {
                $result = $this->connection->query("SELECT * FROM `Listings` INNER JOIN UserData ON Listings.UserID = UserData.UserID  WHERE ListingsName = '$search' AND Department = '$category' AND ListingsPrice >= $min AND ListingsPrice <= $max AND UserCampus IN ($imp)"); 
                 
            }


            //SELECT * From Listings INNER JOIN UserData ON Listings.UserID = UserData.UserID WHERE UserCampus IN  ('Falmer', 'City') AND ListingsPrice > 100

            $json = array();
            if (mysqli_num_rows($result) > 0) {
                
                while ($row = $result->fetch_assoc()) {
                    $json[] = $row;
                }

                header('content-type: application/json');
                $this->result = json_encode(array('Listings' => $json));
                $this->status = 200;

            } else {
                $this->status = 204;
            }

        } elseif (isset($_GET['all']) && isset($_GET['min']) && isset($_GET['max'])&& isset($_GET['selected']) && isset($_GET['category'])){

            $min = $this->connection->real_escape_string($_GET['min']);
            $max = $this->connection->real_escape_string($_GET['max']);
            $selected = $this->connection->real_escape_string($_GET['selected']);
            $category = $this->connection->real_escape_string($_GET['category']);
            $selectedArray = explode(',', $selected);
            
            $imp = "'" . implode( "','", ($selectedArray) ) . "'";
            if ($category == "All"){
                 $result = $this->connection->query("SELECT * FROM `Listings` INNER JOIN UserData ON Listings.UserID = UserData.UserID WHERE ListingsPrice >= $min AND ListingsPrice <= $max AND UserCampus IN ($imp)");
            } else {
                $result = $this->connection->query("SELECT * FROM `Listings` INNER JOIN UserData ON Listings.UserID = UserData.UserID WHERE ListingsPrice >= $min AND Department = '$category' AND ListingsPrice <= $max AND UserCampus IN ($imp)");
                
               
            }


            $json = array();
                
            while ($row = $result->fetch_assoc()) {
                $json[] = $row;
            }
            
            header('content-type: application/json');
            $this->result = json_encode(array('Listings' => $json));
            $this->status = 200;
            
        } else {
            $this->status = 400;
        }
    }
}
$api = new API();
$api->handle_request();
?>