<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {

    $roll = $_POST['issueRoll'];
    $brandId = $_POST['brandId'];

    $sql = "SELECT * FROM issued WHERE rollno='$roll'";
    $query = $hostel->query($sql);

    if($query->num_rows >= 3){
        $valid['success'] = false;
        $valid['messages'] = "Max Items Issued for the Student";      
    }

    else{
        $sql = "INSERT INTO issued values (NULL, '$brandId', '$roll', curdate(), 0, 0)";

        if($hostel->query($sql) === TRUE) {
            $valid['success'] = true;
            $valid['messages'] = "Successfully Changed";
        } else {
            $valid['success'] = false;
            $valid['messages'] = "Error while issuing the Item";
        }
    }

    $hostel->close();

    echo json_encode($valid);
}