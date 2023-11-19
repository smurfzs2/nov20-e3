<?php

session_start(); // Start the session
include "../jovit_connection.php";


// insert data
if (isset($_POST['saveBtn'])) {
    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $birthDate = mysqli_real_escape_string($conn, $_POST['birthDate']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);


    $query = "INSERT INTO tbl_jovit (firstName, lastName, gender, birthDate, address ) 
                  VALUES ('$firstName', '$lastName', '$gender', '$birthDate', '$address' )";

    $query = $conn->query($query);

    if ($query) {
        $_SESSION['status'] = "Data Inserted Successfully";
        header('location: jovit_index.php');
    } else {
        $_SESSION['status'] = "Data Failed!";
        header('location: jovit_index.php');
    }
}

// edit data
// Edit data
if (isset($_POST['editBtn'])) {
    $id = $_POST['userId'];
    $arrayResult = [];

    $fetchQuery = "SELECT * FROM tbl_jovit WHERE id='$id'";
    $queryRun = mysqli_query($conn, $fetchQuery);

    if (mysqli_num_rows($queryRun) > 0) {
        while ($row = mysqli_fetch_array($queryRun)) {
            array_push($arrayResult, $row);
        }
        header('Content-Type: application/json');
        echo json_encode($arrayResult);
        exit(); // Ensure to exit after sending the response
    }
}

//update data
if(isset($_POST['updateBtn']))
{
    $id = $_POST['id'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $gender = $_POST['gender'];
    $birthDate = $_POST['birthDate'];
    $address = $_POST['address'];

    $tblUpdate = "UPDATE tbl_jovit SET firstName='$firstName', lastName='$lastName', birthDate='$birthDate', address='$address', gender='$gender' WHERE id='$id' ";

        $tblUpdateQuery = mysqli_query($conn, $tblUpdate);

        if($tblUpdateQuery)
        {
            $_SESSION['status'] = "Data Updated Successfully";
            header('location: jovit_index.php');
        }else{
            $_SESSION['status'] = "Data Failed!";
            header('location: jovit_index.php');
        }
}

if(isset($_POST['deleteBtn'])) {
    $id = $_POST['userId']; // Change 'user_id' to 'userId' to match the AJAX call
    $deleteQuery = "DELETE FROM tbl_jovit WHERE id='$id'";
    $deleteQueryRun = mysqli_query($conn, $deleteQuery);

    if($deleteQueryRun) {
        echo json_encode(array("message" => "Deleted Successfully"));
    } else {
        echo json_encode(array("message" => "Deletion failed"));
    }
}
